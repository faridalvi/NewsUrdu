@foreach($data['must'] as $must)
    <div class="col-md-4 left-side-border">
        {{--                News with Image--}}
        <div class="important-news border-bottom pb-3">
            <h2>{{$must->name}}<i class="fas fa-caret-down"></i></h2>
            @if(count($must->posts))
                @foreach($must->posts as $key => $post)
                    @if($key == 0)
                        <a href="{{route('post',$post->slug)}}" class="important-main-news mt-3 most-read min-height">
                            <img src="{{asset('storage/posts/feature/'.$post->featured_image)}}" alt="{{$post->slug}}">
                            <h5 class="p-2">{{substr($post->title,0,300)}}</h5>
                        </a>
                    @endif
                @endforeach
            @endif
        </div>
        {{--                News Sectios--}}
        <div class="row flex-row-reverse mb-4">
            @if(count($must->posts))
                @foreach($must->posts as $key => $post)
                    @if($key > 0)
                        <a href="{{route('post',$post->slug)}}" class="col-lg-6 pr-0">
                            <div class="important-news">
                                <div class="important-sub-news must-read mt-3">
                                    <img src="{{asset('storage/posts/feature/'.$post->featured_image)}}" alt="{{$post->slug}}">
                                    <h5 class="p-2">{{$post->title}}</h5>
                                    <p>{{substr($post->sub_content,0,120)}}</p>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            @endif
        </div>
        <a href="#" class="btn-more-border">
            <span class="btn btn-sm btn-more">مزید</span>
        </a>
    </div>
@endforeach
