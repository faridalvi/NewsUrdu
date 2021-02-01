<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\AdminTrait;
use Illuminate\Http\Request;
use App\Admin\Tag;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TagController extends Controller
{
    use AdminTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($this->isAdmin()){
            $data = Tag::orderBy('id','desc')->get();
        }
        else{
            $data = Tag::where('created_by',Auth::id())->orderBy('id','desc')->get();
        }
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.tag.actions')
                ->editColumn('trending',function ($tag){
                    if($tag->trending == 1){
                        return '<span class="btn btn-success btn-sm btn-block">Yes</span>';
                    }
                    else{
                        return '<span class="btn btn-warning btn-sm btn-block">Not</span>';
                    }
                })
                ->editColumn('created_by',function ($created){
                    return $created->user->full_name;
                })
                ->rawColumns(['action','trending','created_by'])
                ->make(true);
        }
        return view('admin.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'slug'=>'required|unique:tags,slug'
        ]);
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = $request->slug;
        $tag->trending = $request->trending;
        $tag->created_by = Auth::user()->id;
        $tag->updated_by = Auth::user()->id;
        $save = $tag->save();
        if($save){
            return redirect()->back()->with('success','Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        if(!$this->isAdmin()){
            $tag = Tag::where('created_by',Auth::id())->find($tag->id);
        }
        return view('admin.tag.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $this->validate($request,[
            'name'=>'required',
            'slug'=>'required|unique:tags,slug,'.$tag->id
        ]);
        $tag = Tag::find($tag->id);
        $tag->name = $request->name;
        $tag->slug = $request->slug;
        $tag->trending = $request->trending;
        $tag->updated_by = Auth::user()->id;
        $save = $tag->save();
        if($save){
            return redirect()->back()->with('success','Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if(!$this->isAdmin()){
            $tag = Tag::where('created_by',Auth::id())->find($tag->id);
        }
        Tag::find($tag->id)->delete();
        return redirect()->route('tag.index')->with('success','Category deleted successfully');
    }
}
