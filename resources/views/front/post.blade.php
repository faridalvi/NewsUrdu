@extends('front.layouts.app')
@section('title', 'Post')
@section('content')
    <div class="container my-4">
        {{--        Single Post--}}
        <div class="row flex-row-reverse text-end single">
            <div class="col-md-9">
                <h2 class="mb-4">{{$post->title}}</h2>
                <img src="{{asset('storage/posts/full_image/'.$post->full_image)}}" alt="" class="w-100 mb-2">
                <h4 class="mt-3">{{$post->sub_content}}</h4>
                <div class="mt-3">
                    {!! $post->description !!}
                </div>
            </div>
            {{--            Sidebar--}}
            <div class="col-md-3">
                <a href="#" class="ads">
                    <img src="http://127.0.0.1:8000/front/img/6.png" alt="">
                </a>
                @if(count($latestNews))
                    <h2 class="my-4 border-bottom pb-2">تازہ ترین خبریں </h2>
                    @foreach($latestNews as $latest)
                        <a href="{{route('post',$latest->slug)}}" class="row flex-row-reverse my-2 latest-news-border single-post-border">
                            <div class="col-lg-3 pr-0 row-wise editor-choice">
                                <img src="{{asset('storage/posts/feature/'.$post->featured_image)}}" alt="{{$latest->slug}}">
                            </div>
                            <div class="col-lg-9 pr-0">
                                <h5>{!! $latest->title !!}</h5>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
        @if(count($viewedPosts))
        <!-- More News -->
            <div class="row mt-3 text-end">
                <h2 class="border-bottom cat-title">زیادہ پڑھی جانےوالی خبریں</h2>
            </div>
            <div class="row ml-minus">
                <div class="owl-carousel owl-theme post-slider">
                    @foreach($viewedPosts as $viewed)
                        <div class="item left-side-border last-single-post border-bottom">
                            <div class="important-news pb-3">
                                <a href="{{route('post',$viewed->slug)}}" class="important-main-news mt-3 most-read category-post bg-transparent">
                                    <div class="position-relative">
                                        <img src="{{asset('storage/posts/feature/'.$post->featured_image)}}" alt="">
                                        <h5 class="p-2">{{$viewed->title}}</h5>
                                    </div>
                                    <p class="border-top mt-3 pt-3 px-2">{{$viewed->sub_content}}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
