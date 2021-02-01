<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Show;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\ShowDetails;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ShowDetailsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:show-details-list');
        $this->middleware('permission:show-details-create', ['only' => ['create','store']]);
        $this->middleware('permission:show-details-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:show-details-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ShowDetails::orderBy('id','desc')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.show-details.actions')
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
                ->rawColumns(['action','homepage'])
                ->make(true);
        }
        return view('admin.show-details.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shows = Show::orderBy('id','desc')->get();
        return view('admin.show-details.create',compact('shows'));
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
            'slug' => 'required|unique:show_details,slug',
            'url'=>'required',
            'show_id'=>'required'
        ]);
        $show = new ShowDetails();
        $show->name = $request->name;
        $show->slug = $request->slug;
        $show->url = $request->url;
        $show->show_id = $request->show_id;
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
     * @param  \App\Admin\ShowDetails  $showDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ShowDetails $showDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\ShowDetails  $showDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(ShowDetails $showDetails,$id)
    {
        $showDetails = ShowDetails::find($id);
        $shows = Show::orderBy('id','desc')->get();
        return view('admin.show-details.edit',compact('shows','showDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\ShowDetails  $showDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShowDetails $showDetails,$id)
    {
        $this->validate($request,[
            'name'=>'required',
            'slug' => 'required|unique:show_details,slug,'.$id,
            'url'=>'required',
            'show_id'=>'required'
        ]);
        $show = ShowDetails::find($id);
        $show->name = $request->name;
        $show->slug = $request->slug;
        $show->url = $request->url;
        $show->show_id = $request->show_id;
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
     * @param  \App\Admin\ShowDetails  $showDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShowDetails $showDetails,$id)
    {
        $delete = ShowDetails::find($id)->delete();
        if($delete){
            return redirect()->back()->with('success','Deleted Successfully');
        }
    }
}
