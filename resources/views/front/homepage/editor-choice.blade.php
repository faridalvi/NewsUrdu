@foreach($data['editor'] as $editor)
    <div class="col-md-4 left-side-border">
        {{--                News with Image--}}
        <div class="important-news">
            <h2>{{$editor->name}}<i class="fas fa-caret-down"></i></h2>
        </div>
        @if(count($editor->posts))
            @foreach($editor->posts as $post)
                <a href="{{route('post',$post->slug)}}" class="row flex-row-reverse my-2 latest-news-border">
                    <div class="col-lg-3 pr-0 row-wise editor-choice">
                        <img src="{{asset('storage/posts/feature/'.$post->featured_image)}}" alt="{{$post->slug}}">
                    </div>
                    <div class="col-lg-9 pr-0">
                        <h5 class="p-2">{{$post->title}}</h5>
                    </div>
                </a>
            @endforeach
            <a href="#" class="ads mt-2">
                <img src="{{asset('front/img/6.png')}}" alt="">
            </a>
            <a href="#" class="btn-more-border">
                <span class="btn btn-sm btn-more">مزید</span>
            </a>
        @endif
    </div>
@endforeach
