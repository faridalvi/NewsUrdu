<?php

namespace App\Http\Controllers\Admin;

use App\Admin\HomePageSection;
use App\Http\Controllers\Controller;
use App\Traits\AdminTrait;
use Illuminate\Http\Request;
use App\Admin\Category;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    use AdminTrait;
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:category-list');
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($this->isAdmin()){
            $data = Category::orderBy('id','desc')->get();
        }
        else{
            $data = Category::where('created_by',Auth::id())->orderBy('id','desc')->get();
        }

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.category.actions')
                ->editColumn('home_page_section_id',function ($home){
                    if($home->homePageSection){
                        return $home->homePageSection->name;
                    }
                    else{
                        return '';
                    }

                })
                ->editColumn('parent',function ($parent){
                    if($parent->parent){
                        return $parent->parent->name;
                    }
                    else{
                        return 'Parent Category';
                    }
                })
                ->editColumn('show_in_top_nav',function ($nav){
                    if($nav->show_in_top_nav == 1){
                        return '<span class="btn btn-success btn-sm btn-block">Yes</span>';
                    }
                    else{
                        return '<span class="btn btn-warning btn-sm btn-block">Not</span>';
                    }
                })
                ->editColumn('created_by',function ($created){
                    return $created->user->full_name;
                })
                ->rawColumns(['action','parent','show_in_top_nav','created_by'])
                ->make(true);
        }
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id','desc')->get();
        $homePageSections = HomePageSection::orderBy('id','desc')->get();
        return view('admin.category.create',compact('categories','homePageSections'));
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
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent_id;
        $category->home_page_section_id = $request->home_page_section_id;
        $category->show_in_top_nav = $request->show_in_top_nav;
        $category->position = $request->position;
        $category->created_by = Auth::user()->id;
        $category->updated_by = Auth::user()->id;
        $save = $category->save();
        if($save){
            return redirect()->back()->with('success','Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if(!$this->isAdmin()){
            $category = Category::where('created_by',Auth::id())->find($category->id);
        }
        $categories = Category::orderBy('id','desc')->get();
        $homePageSections = HomePageSection::orderBy('id','desc')->get();
        return view('admin.category.edit',compact('category','categories','homePageSections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id,
        ]);
        $category = Category::find($category->id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent_id;
        $category->home_page_section_id = $request->home_page_section_id;
        $category->show_in_top_nav = $request->show_in_top_nav;
        $category->position = $request->position;
        $category->updated_by = Auth::user()->id;
        $save = $category->save();
        if($save){
            return redirect()->back()->with('success','Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(!$this->isAdmin()){
            $category = Category::where('created_by',Auth::id())->find($category->id);
        }
        Category::find($category->id)->delete();
        return redirect()->route('category.index')->with('success','Category deleted successfully');
    }
}
