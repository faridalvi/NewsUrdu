<?php

namespace App\Http\Controllers;

use App\Admin\Category;
use App\Admin\FocusKeyword;
use App\Admin\Post;
use App\Admin\Tag;
use App\Traits\AdminTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    use AdminTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $keywords = FocusKeyword::count();
        $allUsers = User::take(5)->orderBy('id','desc')->get();
        if($this->isAdmin()){
            $categories = Category::count();
            $tags = Tag::count();
            $posts = Post::count();
            $allCategories = Category::take(5)->orderBy('id','desc')->get();
            $allPosts = Post::take(5)->orderBy('id','desc')->get();
            $allTags = Tag::take(5)->orderBy('id','desc')->get();
        }
        else{
            $categories = Category::where('created_by',Auth::id())->count();
            $tags = Tag::where('created_by',Auth::id())->count();
            $posts = Post::where('created_by',Auth::id())->count();
            $allCategories = Category::where('created_by',Auth::id())->take(5)->orderBy('id','desc')->get();
            $allPosts = Post::where('created_by',Auth::id())->take(5)->orderBy('id','desc')->get();
            $allTags = Tag::where('created_by',Auth::id())->take(5)->orderBy('id','desc')->get();
        }
        return view('admin.dashboard',compact('users','categories','tags','keywords',
            'posts','allUsers','allCategories','allPosts','allTags'));
    }
}
