@php
    $parents = \App\Admin\Category::with('children')->whereNull('parent_id')->where('show_in_top_nav',1)->whereNotNull('position')->take(5)->orderBy('position','asc')->get();
    $playlists = \App\Admin\YoutubePlaylist::take(5)->orderBy('position','asc')->get();
@endphp
<nav class="navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container position-relative">
        <a class="navbar-brand" href="{{route('main')}}">
            <img src="{{asset('front/img/logo.png')}}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse me-auto" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-100">
                @if(count($parents))
                    @foreach($parents as $parent)
                        <li class="nav-item">
                            <a class="nav-link"  href="{{route('category',$parent->slug)}}">{{ucwords($parent->name)}}</a>
                        </li>
                    @endforeach
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="videos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ویڈیوز
                    </a>
                    <ul class="dropdown-menu video-dropdown" aria-labelledby="videos">
                        @foreach($playlists as $playlist)
                            <li><a class="dropdown-item" href="#">{{$playlist->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <a href="#" class="english-link d-none d-md-block">English</a>
    </div>
</nav>
{{--Scrolling News--}}
<div class="news-marquee my-2">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-1 col ps-0 dark-bg text-center">
                <h3>تازہ ترین</h3>
            </div>
            <div class="col-lg-11 col pe-lg-0">
                <marquee scrollamount="12"><a href="#"><h3>اب ڈرامہ نہیں چلے گا، لاپتا افراد واپس لائیں: سندھ ہائیکورٹ</h3></a></marquee>
            </div>
        </div>
    </div>
</div>
