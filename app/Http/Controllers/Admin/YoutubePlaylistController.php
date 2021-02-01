<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\YoutubePlaylist;
use Yajra\DataTables\DataTables;

class YoutubePlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = YoutubePlaylist::orderBy('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.playlist.actions')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.playlist.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.playlist.create');
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
            'name'=>'required|unique:youtube_playlists,name',
            'playlist_id'=>'required',
            'max_results'=>'required',
            'position'=>'required',
        ]);
        $playlist = new YoutubePlaylist();
        $playlist->name = $request->name;
        $playlist->snippet = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status';
        $playlist->api_key = 'AIzaSyDyuBcljnu1_BfsYRhx6iS_gIlSjXC-xcI';
        $playlist->playlist_id = $request->playlist_id;
        $playlist->max_results = $request->max_results;
        $playlist->embed_url = 'https://www.youtube.com/embed/';
        $playlist->position = $request->position;
        $save = $playlist->save();
        if($save){
            return redirect()->back()->with('success','Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\YoutubePlaylist  $youtubePlaylist
     * @return \Illuminate\Http\Response
     */
    public function show(YoutubePlaylist $youtubePlaylist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\YoutubePlaylist  $youtubePlaylist
     * @return \Illuminate\Http\Response
     */
    public function edit(YoutubePlaylist $youtubePlaylist,$id)
    {
        $playlist = YoutubePlaylist::find($id);
        return view('admin.playlist.edit',compact('playlist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\YoutubePlaylist  $youtubePlaylist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, YoutubePlaylist $youtubePlaylist,$id)
    {
        $this->validate($request,[
            'name'=>'required|unique:youtube_playlists,name,'.$id,
            'playlist_id'=>'required',
            'max_results'=>'required',
            'position'=>'required',
        ]);
        $playlist = YoutubePlaylist::find($id);
        $playlist->name = $request->name;
        $playlist->playlist_id = $request->playlist_id;
        $playlist->max_results = $request->max_results;
        $playlist->position = $request->position;
        $save = $playlist->save();
        if($save){
            return redirect()->back()->with('success','Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\YoutubePlaylist  $youtubePlaylist
     * @return \Illuminate\Http\Response
     */
    public function destroy(YoutubePlaylist $youtubePlaylist,$id)
    {
        YoutubePlaylist::find($id)->delete();
        return redirect()->route('playlist.index')->with('success','Playlist deleted successfully');
    }
}
