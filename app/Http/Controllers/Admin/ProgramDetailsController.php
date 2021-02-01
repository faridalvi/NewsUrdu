<?php

namespace App\Http\Controllers\Admin;

use App\Admin\FocusKeyword;
use App\Admin\Program;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\ProgramDetails;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProgramDetailsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:program-details-list');
        $this->middleware('permission:program-details-create', ['only' => ['create','store']]);
        $this->middleware('permission:program-details-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:program-details-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ProgramDetails::orderBy('id','desc')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.program-details.actions')
                ->editColumn('created_by',function ($created){
                    return $created->user->full_name;
                })
                ->editColumn('programs',function ($details){
                    $program = '';
                    if ($details->programs) {
                        $program .= '<td>'.$details->programs->name.'</td>';
                    }
                    return $program;
                })
                ->editColumn('status',function ($details){
                    if($details->status){
                        return '<span class="btn btn-success btn-sm btn-block">Publish</span>';
                    }
                    else{
                        return '<span class="btn btn-warning btn-sm btn-block">Draft</span>';
                    }
                })
                ->editColumn('featured_image',function ($details){
                    if(isset($details->featured_image)){
                        return '<img src="'.asset('storage/posts/feature/'.$details->featured_image).'" alt="'.$details->title.'">';
                    }
                    else{
                        return '<img src="'.asset('backend/img/no-image.png').'" alt="No Image">';
                    }
                })
                ->rawColumns(['action','programs','status','featured_image'])
                ->make(true);
        }
        return view('admin.program-details.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programs = Program::orderBy('id','desc')->get();
        $keywords = FocusKeyword::orderBy('id','desc')->get();
        return view('admin.program-details.create',compact('programs','keywords'));
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
            'title'=>'required',
            'slug' => 'required|unique:program_details,slug',
            'status'=>'required',
            'program_id'=>'required',
            'focus_keywords'=>'required',
            'meta_description'=>'required',
            'meta_title'=>'required',
            'featured_image'=>'required|mimes:jpeg,jpg,png|max:512',
            'full_image'=>'required|mimes:jpeg,jpg,png|max:512',
            'description'=>'required',
            'sub_content'=>'required',
        ]);
        //Feature Image
        if($request->slug){
            if($request->hasFile('featured_image')){
                $image_ext = $request->file('featured_image')->getClientOriginalExtension();
                $storeFeatured = 'featured-'.$request->slug.'-'.time().'.'.$image_ext;
                $path =  $request->file('featured_image')->storeAs('public/posts/feature',$storeFeatured);
            }
        }
        //Full Image
        if($request->slug){
            if($request->hasFile('full_image')){
                $image_ext = $request->file('full_image')->getClientOriginalExtension();
                $storeFullImage = 'full-'.$request->slug.'-'.time().'.'.$image_ext;
                $path =  $request->file('full_image')->storeAs('public/posts/full_image',$storeFullImage);
            }
        }
        if(!empty($request->published_at)) {
            $published_at = date('Y-m-d h:i:s a', strtotime($request->published_at));
        }else{
            $published_at = date('Y-m-d h:i:s a', strtotime(now()));
        }
        $post = new ProgramDetails();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->status = $request->status;
        $post->meta_description = $request->meta_description;
        $post->meta_title = $request->meta_title;
        $post->program_id  = $request->program_id;
        $post->description  = $request->description;
        $post->sub_content  = $request->sub_content;
        $post->featured_image = $storeFeatured;
        $post->full_image = $storeFullImage;
        $post->created_by  = Auth::user()->id;
        $post->updated_by  = Auth::user()->id;
        $post->published_at  = $published_at;
        $save = $post->save();
        $post->focusKeyWords()->sync($request->focus_keywords);
        if($save){
            return redirect()->back()->with('success','Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\ProgramDetails  $programDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramDetails $programDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\ProgramDetails  $programDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramDetails $programDetails,$id)
    {
        $post = ProgramDetails::find($id);
        $programs = Program::orderBy('id','desc')->get();
        $keywords = FocusKeyword::orderBy('id','desc')->get();
        return view('admin.program-details.edit',compact('post','programs','keywords'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\ProgramDetails  $programDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramDetails $programDetails,$id)
    {
        $post = ProgramDetails::find($id);
        $this->validate($request,[
            'title'=>'required',
            'slug' => 'required|unique:program_details,slug,'.$id,
            'status'=>'required',
            'program_id'=>'required',
            'focus_keywords'=>'required',
            'meta_description'=>'required',
            'meta_title'=>'required',
            'featured_image'=>'mimes:jpeg,jpg,png|max:512',
            'full_image'=>'mimes:jpeg,jpg,png|max:512',
            'description'=>'required',
            'sub_content'=>'required',
        ]);
        //Feature Image
        if($request->slug){
            if($request->hasFile('featured_image')){
                if(isset($post->featured_image)) {
                    $preFeatured = public_path('storage/posts/feature/' . $post->featured_image);
                    if (File::exists($preFeatured)) { // unlink or remove previous image from folder
                        unlink($preFeatured);
                    }
                }
                $image_ext = $request->file('featured_image')->getClientOriginalExtension();
                $storeFeatured = 'featured-'.$request->slug.'-'.time().'.'.$image_ext;
                $path =  $request->file('featured_image')->storeAs('public/posts/feature',$storeFeatured);
            }
            else{
                $storeFeatured = $post->featured_image;
            }
        }
        //Full Image
        if($request->slug){
            if($request->hasFile('full_image')){
                if(isset($post->full_image)) {
                    $preFullImage = public_path('storage/posts/full_image/' . $post->full_image);
                    if (File::exists($preFullImage)) { // unlink or remove previous image from folder
                        unlink($preFullImage);
                    }
                }
                $image_ext = $request->file('full_image')->getClientOriginalExtension();
                $storeFullImage = 'full-'.$request->slug.'-'.time().'.'.$image_ext;
                $path =  $request->file('full_image')->storeAs('public/posts/full_image',$storeFullImage);
            }
            else{
                $storeFullImage = $post->full_image;
            }
        }
        if(!empty($request->published_at)) {
            $published_at = date('Y-m-d h:i:s a', strtotime($request->published_at));
        }else{
            $published_at = date('Y-m-d h:i:s a', strtotime(now()));
        }
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->status = $request->status;
        $post->meta_description = $request->meta_description;
        $post->meta_title = $request->meta_title;
        $post->program_id  = $request->program_id;
        $post->description  = $request->description;
        $post->sub_content  = $request->sub_content;
        $post->featured_image = $storeFeatured;
        $post->full_image = $storeFullImage;
        $post->updated_by  = Auth::user()->id;
        $post->published_at  = $published_at;
        $post->focusKeyWords()->sync($request->focus_keywords);
        $save = $post->save();
        if($save){
            return redirect()->back()->with('success','Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\ProgramDetails  $programDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramDetails $programDetails,$id)
    {

        $post = ProgramDetails::find($id);
        $preFeatured = public_path('storage/posts/feature/'.$post->featured_image);
        $preFull = public_path('storage/posts/full_image/'.$post->full_image);
        $delete = ProgramDetails::find($id)->delete();
        if($delete){
            File::delete($preFeatured,$preFull);
            return redirect()->back()->with('success','Deleted Successfully');
        }
    }
}
