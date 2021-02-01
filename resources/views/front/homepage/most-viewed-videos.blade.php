<div class="col-md-4  left-side-border">
    {{--                News with Image--}}
    <div class="important-news border-bottom pb-3">
        <h2>مقبول ویڈیوز <i class="fas fa-caret-down"></i></h2>
        <div class="owl-carousel owl-theme video-slider">
            @foreach($data['videos'] as $key => $video)
                <div class="item mt-3">
                    <div class="row align-items-center video-modal mb-2 " data-bs-video="{{$video['video_url']}}" data-bs-toggle="modal" data-bs-target="#videoModal" style="cursor: pointer">
                        <div class="col-sm-12 col-md-12 position-relative sub-videos-section">
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
    <a href="#" class="row flex-row-reverse my-2 latest-news-border">
        <div class="col-lg-5 pr-0 row-wise">
            <img src="{{asset('front/img/4.png')}}" alt="">
        </div>
        <div class="col-lg-7 pr-0">
            <h5>جوبائیڈن نے امریکہ کے 46 ویں صدر کی حیثیت سے حلف اٹھا لیا</h5>
            <p>واشنگٹن(این این آئی)امریکا کے نو منتخب صدر جوبائیڈن کے نامزد وزیرخارجہ انتھونی بلنکن</p>
        </div>
    </a>
    <a href="#" class="row flex-row-reverse my-2 latest-news-border">
        <div class="col-lg-5 pr-0 row-wise">
            <img src="{{asset('front/img/5.png')}}" alt="">
        </div>
        <div class="col-lg-7 pr-0">
            <h5>جوبائیڈن نے امریکہ کے 46 ویں صدر کی حیثیت سے حلف اٹھا لیا</h5>
            <p>واشنگٹن(این این آئی)امریکا کے نو منتخب صدر جوبائیڈن کے نامزد وزیرخارجہ انتھونی بلنکن</p>
        </div>
    </a>
    <a href="#" class="btn-more-border">
        <span class="btn btn-sm btn-more">مزید</span>
    </a>
</div>
