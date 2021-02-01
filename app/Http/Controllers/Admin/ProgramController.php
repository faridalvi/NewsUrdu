<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Program;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProgramController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:program-list');
        $this->middleware('permission:program-create', ['only' => ['create','store']]);
        $this->middleware('permission:program-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:program-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Program::orderBy('id','desc')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.program.actions')
                ->editColumn('created_by',function ($created){
                    return $created->user->full_name;
                })
                ->editColumn('image',function ($program){
                    if(isset($program->image)){
                        return '<img src="'.asset('storage/posts/programs/'.$program->image).'" alt="'.$program->title.'">';
                    }
                    else{
                        return '<img src="'.asset('backend/img/no-image.png').'" alt="No Image">';
                    }
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }
        return view('admin.program.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.program.create');
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
            'slug' => 'required|unique:programs,slug',
            'image'=>'required|mimes:jpeg,jpg,png|max:512',
        ]);
        //Feature Image
        if($request->slug){
            if($request->hasFile('image')){
                $image_ext = $request->file('image')->getClientOriginalExtension();
                $storeImage = $request->slug.'-'.time().'.'.$image_ext;
                $path =  $request->file('image')->storeAs('public/posts/programs',$storeImage);
            }
        }
        $program = new Program();
        $program->name = $request->name;
        $program->slug = $request->slug;
        $program->image = $storeImage;
        $program->created_by  = Auth::user()->id;
        $program->updated_by  = Auth::user()->id;
        $save = $program->save();
        if($save){
            return redirect()->back()->with('success','Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        return view('admin.program.edit',compact('program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $this->validate($request,[
            'name'=>'required',
            'slug' => 'required|unique:programs,slug,'.$program->id,
            'image'=>'mimes:jpeg,jpg,png|max:512'
        ]);

        //Feature Image
        if($request->slug){
            if($request->hasFile('image')){
                if(isset($program->image)) {
                    $preImage = public_path('storage/posts/programs/' . $program->image);
                    if (File::exists($preImage)) { // unlink or remove previous image from folder
                        unlink($preImage);
                    }
                }
                $image_ext = $request->file('image')->getClientOriginalExtension();
                $storeImage = $request->slug.'-'.time().'.'.$image_ext;
                $path =  $request->file('image')->storeAs('public/posts/programs',$storeImage);
            }
            else{
                $storeImage = $program->image;
            }
        }
        $program = Program::find($program->id);
        $program->name = $request->name;
        $program->slug = $request->slug;
        $program->image = $storeImage;
        $program->created_by  = Auth::user()->id;
        $program->updated_by  = Auth::user()->id;
        $save = $program->save();
        if($save){
            return redirect()->back()->with('success','Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $preShow = public_path('storage/posts/programs/'.$program->image);
        $delete = Program::find($program->id)->delete();
        if($delete){
            File::delete($preShow);
            return redirect()->back()->with('success','Deleted Successfully');
        }
    }
}
