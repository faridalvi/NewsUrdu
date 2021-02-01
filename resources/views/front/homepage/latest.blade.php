@foreach($data['latest'] as $latest)
    <div class="col-md-4 left-side-border">
        {{--                News with Image--}}
        <div class="important-news border-bottom pb-3">
            <h2>{{$latest->name}}<i class="fas fa-caret-down"></i></h2>
            @if(count($latest->posts))
                @foreach($latest->posts as $key => $post)
                    @if($key == 0)
                        <a href="{{route('post',$post->slug)}}" class="important-main-news mt-3">
                            <img src="{{asset('storage/posts/feature/'.$post->featured_image)}}" alt="{{$post->slug}}">
                            <h5 class="p-2">{{substr($post->title,0,300)}}</h5>
                        </a>
                    @endif
                @endforeach
            @endif
        </div>
        @if(count($latest->posts))
            @foreach($latest->posts as $key => $post)
                @if($key > 0 && $key <= 2)
                    <a href="{{route('post',$post->slug)}}" class="row flex-row-reverse my-2 pt-2 latest-news-border">
                        <div class="col-lg-6 pr-0 row-wise latest-news">
                            <img src="{{asset('storage/posts/feature/'.$post->featured_image)}}" alt="{{$post->slug}}">
                        </div>
                        <div class="col-lg-6 pr-0">
                            <h5>{{$post->title}}</h5>
                            <p>{{substr($post->sub_content,0,130)}}</p>
                        </div>
                    </a>
                @endif
            @endforeach
            @foreach($latest->posts as $key => $post)
                @if($key > 2)
                    <a href="{{route('post',$post->slug)}}" class="row flex-row-reverse my-2 latest-news-border">
                        <div class="col-lg-5 pr-0 row-wise">
                            <img src="{{asset('storage/posts/feature/'.$post->featured_image)}}" alt="{{$post->slug}}">
                        </div>
                        <div class="col-lg-7 pr-0">
                            <h5>{{$post->title}}</h5>
                            <p>{{substr($post->sub_content,0,130)}}</p>
                        </div>
                    </a>
                @endif
            @endforeach
            <a href="#" class="btn-more-border">
                <span class="btn btn-sm btn-more">مزید</span>
            </a>
        @endif
    </div>
@endforeach
