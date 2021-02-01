<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Category;
use App\Admin\FocusKeyword;
use App\Admin\HomePageSection;
use App\Admin\Tag;
use App\Http\Controllers\Controller;
use App\Traits\AdminTrait;
use Illuminate\Http\Request;
use App\Admin\Post;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use File;
class PostController extends Controller
{
    use AdminTrait;
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:post-list');
        $this->middleware('permission:post-create', ['only' => ['create','store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($this->isAdmin()){
            $data = Post::orderBy('id','desc')->take(1000)->get();
        }
        else{
            $data = Post::where('created_by',Auth::id())->orderBy('id','desc')->get();
        }

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.post.actions')
                ->editColumn('created_by',function ($created){
                    return $created->user->name;
                })
                ->editColumn('categories',function ($post){
                    $category = '';
                    foreach ($post->categories as $postCategory) {
                        $category .= '<td>'.$postCategory->name.',</td>';
                    }
                    return $category;
                })
                ->editColumn('homepage',function ($post){
                    $homepage = '';
                    if ($post->homePageSection) {
                        $homepage .= '<td>'.$post->homePageSection->name.'</td>';
                    }
                    return $homepage;
                })
                ->editColumn('status',function ($post){
                    if($post->status){
                        return '<span class="btn btn-success btn-sm btn-block">Publish</span>';
                    }
                    else{
                        return '<span class="btn btn-warning btn-sm btn-block">Draft</span>';
                    }
                })
                ->editColumn('featured_image',function ($post){
                    if(isset($post->featured_image)){
                        return '<img src="'.asset('storage/posts/feature/'.$post->featured_image).'" alt="'.$post->title.'">';
                    }
                    else{
                        return '<img src="'.asset('backend/img/no-image.png').'" alt="No Image">';
                    }
                })
                ->rawColumns(['action','homepage','categories','status','featured_image'])
                ->make(true);
        }
        return view('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $homePages = HomePageSection::orderBy('id','desc')->get();
        $keywords = FocusKeyword::orderBy('id','desc')->get();
        $categories = Category::orderBy('id','desc')->get();
        $tags = Tag::orderBy('id','desc')->get();
        return view('admin.post.create',compact('homePages','keywords','categories','tags'));
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
            'slug' => 'required|unique:posts,slug',
            'status'=>'required',
            'focus_keywords'=>'required',
            'meta_description'=>'required',
            'meta_title'=>'required',
            'category'=>'required',
            'tags'=>'required',
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
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->status = $request->status;
        $post->meta_description = $request->meta_description;
        $post->meta_title = $request->meta_title;
        $post->home_page_section_id  = $request->home_page_section_id;
        $post->description  = $request->description;
        $post->sub_content  = $request->sub_content;
        $post->featured_image = $storeFeatured;
        $post->full_image = $storeFullImage;
        $post->created_by  = Auth::user()->id;
        $post->updated_by  = Auth::user()->id;
        $post->published_at  = $published_at;
        $save = $post->save();
        $post->focusKeyWords()->sync($request->focus_keywords);
        $post->categories()->sync($request->category);
        $post->tags()->sync($request->tags);
        if($save){
            return redirect()->back()->with('success','Added Successfully');
        }
    }

    public function uploadhandler(Request $request){
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('storage/posts/editor'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/posts/editor/'.$fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!$this->isAdmin()){
            $post = Post::where('created_by',Auth::id())->find($post->id);
        }
        $homePages = HomePageSection::orderBy('id','desc')->get();
        $keywords = FocusKeyword::orderBy('id','desc')->get();
        $categories = Category::orderBy('id','desc')->get();
        $tags = Tag::orderBy('id','desc')->get();
        return view('admin.post.edit',compact('post','homePages','keywords','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title'=>'required',
            'slug' => 'required|unique:posts,slug,'.$post->id,
            'status'=>'required',
            'focus_keywords'=>'required',
            'meta_description'=>'required',
            'meta_title'=>'required',
            'category'=>'required',
            'tags'=>'required',
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
        $post = Post::find($post->id);
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->status = $request->status;
        $post->meta_description = $request->meta_description;
        $post->meta_title = $request->meta_title;
        $post->home_page_section_id  = $request->home_page_section_id;
        $post->description  = $request->description;
        $post->sub_content  = $request->sub_content;
        $post->featured_image = $storeFeatured;
        $post->full_image = $storeFullImage;
        $post->updated_by  = Auth::user()->id;
        $post->published_at  = $published_at;
        $post->focusKeyWords()->sync($request->focus_keywords);
        $post->categories()->sync($request->category);
        $post->tags()->sync($request->tags);
        $save = $post->save();
        if($save){
            return redirect()->back()->with('success','Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(!$this->isAdmin()){
            $post = Post::where('created_by',Auth::id())->find($post->id);
        }
        $preFeatured = public_path('storage/posts/feature/'.$post->featured_image);
        $preFull = public_path('storage/posts/full_image/'.$post->full_image);
        $delete = Post::find($post->id)->delete();
        if($delete){
            File::delete($preFeatured,$preFull);
            return redirect()->back()->with('success','Deleted Successfully');
        }
    }
}
