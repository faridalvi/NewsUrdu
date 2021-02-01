<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Show;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ShowController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:show-list');
        $this->middleware('permission:show-create', ['only' => ['create','store']]);
        $this->middleware('permission:show-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:show-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Show::orderBy('id','desc')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.show.actions')
                ->editColumn('created_by',function ($created){
                    return $created->user->full_name;
                })
                ->editColumn('homepage',function ($show){
                    $homepage = '';
                    if ($show->homePageSection) {
                        $homepage .= '<td>'.$show->homePageSection->name.'</td>';
                    }
                    return $homepage;
                })
                ->editColumn('image',function ($show){
                    if(isset($show->image)){
                        return '<img src="'.asset('storage/posts/shows/'.$show->image).'" alt="'.$show->title.'">';
                    }
                    else{
                        return '<img src="'.asset('backend/img/no-image.png').'" alt="No Image">';
                    }
                })
                ->rawColumns(['action','homepage','image'])
                ->make(true);
        }
        return view('admin.show.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.show.create');
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
            'slug' => 'required|unique:shows,slug',
            'image'=>'required|mimes:jpeg,jpg,png|max:512',
            'description'=>'required'
        ]);
        //Feature Image
        if($request->slug){
            if($request->hasFile('image')){
                $image_ext = $request->file('image')->getClientOriginalExtension();
                $storeImage = $request->slug.'-'.time().'.'.$image_ext;
                $path =  $request->file('image')->storeAs('public/posts/shows',$storeImage);
            }
        }
        $show = new Show();
        $show->name = $request->name;
        $show->slug = $request->slug;
        $show->description  = $request->description;
        $show->image = $storeImage;
        $show->home_page_section_id  = $request->home_page_section_id;
        $show->created_by  = Auth::user()->id;
        $show->updated_by  = Auth::user()->id;
        $save = $show->save();
        if($save){
            return redirect()->back()->with('success','Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function show(Show $show)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function edit(Show $show)
    {
        return view('admin.show.edit',compact('show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Show $show)
    {
        $this->validate($request,[
            'name'=>'required',
            'slug' => 'required|unique:shows,slug,'.$show->id,
            'image'=>'mimes:jpeg,jpg,png|max:512',
            'description'=>'required'
        ]);

        //Feature Image
        if($request->slug){
            if($request->hasFile('image')){
                if(isset($show->image)) {
                    $preImage = public_path('storage/posts/shows/' . $show->image);
                    if (File::exists($preImage)) { // unlink or remove previous image from folder
                        unlink($preImage);
                    }
                }
                $image_ext = $request->file('image')->getClientOriginalExtension();
                $storeImage = $request->slug.'-'.time().'.'.$image_ext;
                $path =  $request->file('image')->storeAs('public/posts/shows',$storeImage);
            }
            else{
                $storeImage = $show->image;
            }
        }
        $show = Show::find($show->id);
        $show->name = $request->name;
        $show->slug = $request->slug;
        $show->description  = $request->description;
        $show->image = $storeImage;
        $show->home_page_section_id  = $request->home_page_section_id;
        $show->created_by  = Auth::user()->id;
        $show->updated_by  = Auth::user()->id;
        $save = $show->save();
        if($save){
            return redirect()->back()->with('success','Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function destroy(Show $show)
    {
        $preShow = public_path('storage/posts/shows/'.$show->image);
        $delete = Show::find($show->id)->delete();
        if($delete){
            File::delete($preShow);
            return redirect()->back()->with('success','Deleted Successfully');
        }
    }
}
