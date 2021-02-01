@extends('front.layouts.app')
@section('title', $category->name)
@section('content')
    <div class="container my-4">
        {{--        Single Post--}}
        <div class="row flex-row-reverse text-end">
            <div class="col-md-9">
                @if(count($posts))
                    <div class="row flex-row-reverse">
                        @foreach($posts as $post)
                            <div class="col-lg-6 col-md-6 left-side-border border-bottom">
                                <a href="{{route('post',$post->slug)}}" class="row flex-row-reverse my-2">
                                    <div class="col-md-12 mb-2">
                                        <h5>{{$post->title}}</h5>
                                    </div>
                                    <div class="col-lg-5 row-wise mb-2">
                                        <img src="{{asset('storage/posts/feature/'.$post->featured_image)}}" alt="{{$post->slug}}">
                                    </div>
                                    <div class="col-lg-7">
                                        <p>{{substr($post->sub_content,0,300)}}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <div class="row mt-3">
                            {{$posts->links()}}
                        </div>
                    </div>
                @endif
            </div>
            {{--            Sidebar--}}
            <div class="col-md-3">
                <div class="main-random mb-2 ps-lg-0">
                    <div class="owl-carousel owl-theme video-slider">
                        @foreach($data['videos'] as $key => $video)
                            <div class="item main-videos-section category-videos-section">
                                <div class="row align-items-center video-modal mb-2 " data-bs-video="{{$video['video_url']}}" data-bs-toggle="modal" data-bs-target="#videoModal" style="cursor: pointer">
                                    <div class="col-sm-12 col-md-12 position-relative">
                                        <img src="{{$video['image_url']}}" alt="" class="youtube-sub-videos">
                                        <a href="" class="video-modal" data-bs-video="{{$video['video_url']}}" data-bs-toggle="modal" data-bs-target="#videoModal">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if(count($latestPosts))
                    <h2 class="my-4 border-bottom pb-2">تازہ ترین خبریں </h2>
                    @foreach($latestPosts as $latest)
                        <a href="#" class="row flex-row-reverse my-2 latest-news-border single-post-border">
                            <div class="col-lg-3 pr-0 row-wise editor-choice">
                                <img src="{{asset('storage/posts/feature/'.$latest->featured_image)}}" alt="{{$latest->slug}}">
                            </div>
                            <div class="col-lg-9 pr-0">
                                <h5>{{$latest->title}}</h5>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
