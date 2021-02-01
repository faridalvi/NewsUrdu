<?php

namespace App\Http\Controllers\Front;

use App\Admin\Category;
use App\Admin\HomePageSection;
use App\Admin\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(){
        //Covid Web Scrap
        $curl = curl_init('https://covid.gov.pk/');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $page = curl_exec($curl);
        if(curl_errno($curl)) // check for execution errors
        {
            echo 'Scraper error: ' . curl_error($curl);
            exit;
        }
        curl_close($curl);
        $regex = '/<ul class="top-statistics block-separator without-activecases print-in-dashboard ">(.*?)<\/ul>/s';
        if ( preg_match($regex, $page, $list) ){
            $data['covid'] = $list[0];
        }
        else {
            print "Not found";
        }

        //Youtube Videos
        $yt_snippet_url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status';
        $yt_key = 'AIzaSyDyuBcljnu1_BfsYRhx6iS_gIlSjXC-xcI';
        //Popular Videos
        $response = Http::get($yt_snippet_url.'&playlistId=UUAiq04b9vvKobdRiGNgugtA&maxResults=10&key='.$yt_key);
        $res_json = $response->json();
        $data['videos'] = $this->process_yt_data($res_json, 'https://www.youtube.com/embed/');
        //Yaad E Ilahi
        $response1 = Http::get($yt_snippet_url.'&playlistId=PLcSXWm3yuT9ZYWIRkfbefMU0A8AaNd8Vf&maxResults=1&key='.$yt_key);
        $res_json1 = $response1->json();
        $data['Yaad_E_Ilahi'] = $this->process_yt_data($res_json1, 'https://www.youtube.com/embed/');
        //Reporter Diary
        $response2 = Http::get($yt_snippet_url.'&playlistId=PLGZP1Oryg6VNToOlqDC7wuv7WiyQqb1l_&maxResults=1&key='.$yt_key);
        $res_json2 = $response2->json();
        $data['reporter_diary'] = $this->process_yt_data($res_json2, 'https://www.youtube.com/embed/');
        //Sitaron Ki Batain
        $response3 = Http::get($yt_snippet_url.'&playlistId=PLGZP1Oryg6VMuCaRG6O2w_JbxcP8eMsJT&maxResults=1&key='.$yt_key);
        $res_json3 = $response3->json();
        $data['sitaron_ki_batain'] = $this->process_yt_data($res_json3, 'https://www.youtube.com/embed/');
        //Entertainment
        $response4 = Http::get($yt_snippet_url.'&playlistId=PLGZP1Oryg6VNDeuuR_RtRl9UiDeQvuxoo&maxResults=1&key='.$yt_key);
        $res_json4 = $response4->json();
        $data['entertainment'] = $this->process_yt_data($res_json4, 'https://www.youtube.com/embed/');

        //Important News
        $data['important'] = HomePageSection::with(['posts'=>function($q){
            $q->where('status',1)->where(function ($pub){
                $pub->where('published_at','<=',now())
                    ->orWhereNull('published_at');
            })->take(5)->orderBy('id','desc');
        }])->where('position',1)->get();
        //Latest News
        $data['latest'] = HomePageSection::with(['posts'=>function($q){
            $q->where('status',1)->where(function ($pub){
                $pub->where('published_at','<=',now())
                    ->orWhereNull('published_at');
            })->take(5)->orderBy('id','desc');
        }])->where('position',2)->get();
        //Editor Choice News
        $data['editor'] = HomePageSection::with(['posts'=>function($q){
            $q->where('status',1)->where(function ($pub){
                $pub->where('published_at','<=',now())
                    ->orWhereNull('published_at');
            })->take(8)->orderBy('id','desc');
        }])->where('position',3)->get();
        //Most Read
        $data['most'] = HomePageSection::with(['posts'=>function($q){
            $q->where('status',1)->where(function ($pub){
                $pub->where('published_at','<=',now())
                    ->orWhereNull('published_at');
            })->take(3)->orderBy('id','desc');
        }])->where('position',4)->get();
        //Must Read
        $data['must'] = HomePageSection::with(['posts'=>function($q){
            $q->where('status',1)->where(function ($pub){
                $pub->where('published_at','<=',now())
                    ->orWhereNull('published_at');
            })->take(3)->orderBy('id','desc');
        }])->where('position',5)->get();
        return view('front.index',compact('data'));
    }
    //Single Category
    public function category($slug){
        $yt_snippet_url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status';
        $yt_key = 'AIzaSyDyuBcljnu1_BfsYRhx6iS_gIlSjXC-xcI';
        //Popular Videos
        $response = Http::get($yt_snippet_url.'&playlistId=UUAiq04b9vvKobdRiGNgugtA&maxResults=10&key='.$yt_key);
        $res_json = $response->json();
        $data['videos'] = $this->process_yt_data($res_json, 'https://www.youtube.com/embed/');
        //Category
        $category = Category::where('slug',$slug)->orderBy('id','desc')->first();
        $posts = $category->posts()->where('status',1)->where(function ($pub){
            $pub->where('published_at','<=',now())
                ->orWhereNull('published_at');
        })->orderBy('id','desc')->take(1000)->paginate(32);
        $latestPosts = Post::where('status',1)->where(function ($pub){
            $pub->where('published_at','<=',now())
                ->orWhereNull('published_at');
        })->orderBy('id','desc')->take(8)->get();
        return view('front.category',compact('data','category','posts','latestPosts'));
    }
    //Single Post
    public function post($slug){
        $post = Post::with('categories','tags','user')->where(['status'=> 1,'slug' => $slug])->first();
        $latestNews = Post::where('status',1)->where('slug','!=',$slug)->where(function ($pub){
            $pub->where('published_at','<=',now())
                ->orWhereNull('published_at');
        })->take(5)->orderBy('id','desc')->get();
        $viewedPosts = Post::where('status',1)->where('slug','!=',$slug)->where(function ($pub){
            $pub->where('published_at','<=',now())
                ->orWhereNull('published_at');
        })->take(8)->orderBy('view_count','desc')->get();
        //Increment View
        $increment = 'post/' . $slug;
        if($increment){
            $post->view_count++;
            $post->save();
        }
        return view('front.post',compact('post','viewedPosts','latestNews'));
    }
    //Youtube Process Videos
    function process_yt_data($yt_data, $url_base){
        $items = [];
        foreach($yt_data['items'] as $item)
        {
            if(isset($item['snippet']) && $item['status']['privacyStatus'] == 'public')
            {
                $video_url = $url_base . $item['snippet']['resourceId']['videoId'];
                $processed_item = ['video_url'=> $video_url];
                $processed_item['title'] = $item['snippet']['title'];
                if(isset($item['snippet']['thumbnails']))
                {
                    $image_url = $item['snippet']['thumbnails']['high']['url'];
                    $processed_item['image_url'] = $image_url;
                }
                array_push($items, $processed_item);
            }
        }
        return $items;
    }
}
