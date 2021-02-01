@if(isset($data['videos']) && count($data['videos']))
    <div class="container my-2">
        <div class="row random-news">
            <div class="col-md-6 main-random mb-2 ps-lg-0">
                <div class="owl-carousel owl-theme video-slider">
                    @foreach($data['videos'] as $key => $video)
                        <div class="item main-videos-section">
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
            <div class="col-md-6 mb-2 pe-lg-0">
                <div class="row sub-random">
                    <div class="col-md-6 ">
                        @foreach($data['Yaad_E_Ilahi'] as $key => $video)
                            <div class="row align-items-center video-modal mb-2 " data-bs-video="{{$video['video_url']}}" data-bs-toggle="modal" data-bs-target="#videoModal" style="cursor: pointer">
                                <div class="col-sm-12 col-md-12 position-relative">
                                    <img src="{{$video['image_url']}}" alt="" class="youtube-sub-videos">
                                    <a href="" class="video-modal" data-bs-video="{{$video['video_url']}}" data-bs-toggle="modal" data-bs-target="#videoModal">
                                        <i class="fa fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-6 ">
                        @foreach($data['reporter_diary'] as $key => $video)
                            <div class="row align-items-center video-modal mb-2 " data-bs-video="{{$video['video_url']}}" data-bs-toggle="modal" data-bs-target="#videoModal" style="cursor: pointer">
                                <div class="col-sm-12 col-md-12 position-relative">
                                    <img src="{{$video['image_url']}}" alt="" class="youtube-sub-videos">
                                    <a href="" class="video-modal" data-bs-video="{{$video['video_url']}}" data-bs-toggle="modal" data-bs-target="#videoModal">
                                        <i class="fa fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-6 ">
                        @foreach($data['sitaron_ki_batain'] as $key => $video)
                            <div class="row align-items-center video-modal mb-2 " data-bs-video="{{$video['video_url']}}" data-bs-toggle="modal" data-bs-target="#videoModal" style="cursor: pointer">
                                <div class="col-sm-12 col-md-12 position-relative">
                                    <img src="{{$video['image_url']}}" alt="" class="youtube-sub-videos">
                                    <a href="" class="video-modal" data-bs-video="{{$video['video_url']}}" data-bs-toggle="modal" data-bs-target="#videoModal">
                                        <i class="fa fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-6 ">
                        @foreach($data['entertainment'] as $key => $video)
                            <div class="row align-items-center video-modal mb-2 " data-bs-video="{{$video['video_url']}}" data-bs-toggle="modal" data-bs-target="#videoModal" style="cursor: pointer">
                                <div class="col-sm-12 col-md-12 position-relative">
                                    <img src="{{$video['image_url']}}" alt="" class="youtube-sub-videos">
                                    <a href="" class="video-modal" data-bs-video="{{$video['video_url']}}" data-bs-toggle="modal" data-bs-target="#videoModal">
                                        <i class="fa fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
