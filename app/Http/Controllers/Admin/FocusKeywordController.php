<?php

namespace App\Http\Controllers\Admin;

use App\Admin\FocusKeyword;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FocusKeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FocusKeyword::orderBy('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.keyword.actions')
                ->rawColumns(['action','trending','created_by'])
                ->make(true);
        }
        return view('admin.keyword.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.keyword.create');
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
            'name'=>'required|unique:focus_keywords,name'
        ]);
        $keyword = new FocusKeyword();
        $keyword->name = $request->name;
        $save = $keyword->save();
        if($save){
            return redirect()->back()->with('success','Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keyword = FocusKeyword::find($id);
        return view('admin.keyword.edit',compact('keyword'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|unique:focus_keywords,name,'.$id
        ]);
        $keyword = FocusKeyword::find($id);
        $keyword->name = $request->name;
        $save = $keyword->save();
        if($save){
            return redirect()->back()->with('success','Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FocusKeyword::find($id)->delete();
        return redirect()->route('keyword.index')->with('success','Keyword deleted successfully');
    }
    public function getKeywords(Request $request){
        $data=[];
        if($request->has('q')){
            $search = $request->q;
            $data = FocusKeyword::select('id','name')->where('name','LIKE','%'.$search.'%')->get();
        }
        else{
            $data = FocusKeyword::all();
        }
        return response()->json($data);
    }
    public function newKeywords(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:focus_keywords,name'
        ]);
        $keyword = FocusKeyword::updateOrCreate([
            'name'=>$request->name
        ],[
                'name'=>$request->name
            ]
        );
        return response()->json($keyword->id);
    }
}
