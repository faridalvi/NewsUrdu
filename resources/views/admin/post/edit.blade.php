@extends('admin.layouts.app')
@section('title','Edit Post')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Edit Post</li>
            </ul>
        </div>
    </div>
    <section class="forms mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4>Edit</h4>
                            <a href="{{route('post.index')}}" class="btn btn-sm btn-dark">View All</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title" value="{{(isset($post->title)?$post->title:old('title'))}}">
                                        <div class="text-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Slug</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{(isset($post->slug)?$post->slug:old('slug'))}}">
                                        <div class="text-danger">
                                            {{ $errors->first('slug') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row align-items-center">
                                            <label class="col-sm-4 form-control-label">Status</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="status" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="0" @if($post->status == 0) selected @endif>Draft</option>
                                                    <option value="1"  @if($post->status == 1) selected @endif>Publish</option>
                                                </select>
                                                <div class="text-danger">
                                                    {{ $errors->first('status') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row align-items-center">
                                            <label class="col-sm-4 form-control-label">Home Page Section</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="home_page_section_id" class="form-control">
                                                    <option value="">Please Select</option>
                                                    @foreach($homePages as $homepage)
                                                        <option value="{{$homepage->id}}"
                                                            @if($post->home_page_section_id == $homepage->id) selected @endif
                                                        >{{ucwords($homepage->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Focus Keywords</label>
                                    <div class="col-sm-10">
                                        <select name="focus_keywords[]" class="tag-selection form-control" multiple="multiple">
                                            @foreach($keywords as $keyword)
                                                <option value="{{$keyword->id}}"
                                                @foreach($post->focusKeyWords as $focus)
                                                    @if($focus->id == $keyword->id) selected @endif
                                                @endforeach
                                                >{{ucwords($keyword->name)}}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger">
                                            {{ $errors->first('focus_keywords') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Meta Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="meta_description" value="{{(isset($post->meta_description)?$post->meta_description:old('meta_description'))}}">
                                        <div class="text-danger">
                                            {{ $errors->first('meta_description') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Meta Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="meta_title" value="{{(isset($post->meta_title)?$post->meta_title:old('meta_title'))}}">
                                        <div class="text-danger">
                                            {{ $errors->first('meta_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Categories</label>
                                    <div class="col-sm-10">
                                        <select name="category[]" class="categories form-control" multiple="multiple">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"
                                                    @foreach($post->categories as $postCategory)
                                                        @if($postCategory->id == $category->id) selected @endif
                                                    @endforeach
                                                >{{ucwords($category->name)}}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger">
                                            {{ $errors->first('category') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Tags</label>
                                    <div class="col-sm-10">
                                        <select name="tags[]" class="tag-selection form-control" multiple="multiple">
                                            @foreach($tags as $tag)
                                                <option value="{{$tag->id}}"
                                                    @foreach($post->tags as $postTags)
                                                        @if($postTags->id == $tag->id) selected @endif
                                                    @endforeach
                                                >{{ucwords($tag->name)}}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger">
                                            {{ $errors->first('tags') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Featured Image</label>
                                            <div class="col-sm-8 mb-3">
                                                <input type='file' id="feature" name="featured_image"/>
                                                @if(isset($post->featured_image))
                                                    <img id="feature-image" src="{{asset('storage/posts/feature/'.$post->featured_image)}}" alt="{{$post->slug}}" class="post-image"/>
                                                @else
                                                    <img id="feature-image" src="{{asset('backend/img/no-image.png')}}" alt="your image" class="post-image"/>
                                                @endif
                                                <div class="text-danger">
                                                    {{ $errors->first('featured_image') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Full Image</label>
                                            <div class="col-sm-8 mb-3">
                                                <input type='file' id="full" name="full_image" />
                                                @if(isset($post->full_image))
                                                    <img id="full-image" src="{{asset('storage/posts/full_image/'.$post->full_image)}}" alt="{{$post->slug}}" class="post-image"/>
                                                @else
                                                    <img id="full-image" src="{{asset('backend/img/no-image.png')}}" alt="your image" class="post-image"/>
                                                @endif
                                                <div class="text-danger">
                                                    {{ $errors->first('full_image') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Sub Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sub_content" class="form-control" value="{{(isset($post->sub_content)?$post->sub_content:old('sub_content'))}}">
                                        <div class="text-danger">
                                            {{ $errors->first('sub_content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Post Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" id="description" class="form-control">{{(isset($post->description)?$post->description:old('description'))}}</textarea>
                                        <div class="text-danger">
                                            {{ $errors->first('description') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Publish Time</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="published_at" class="form-control published_at" value="{{isset($post->published_at)?date('H:i m/d/Y',strtotime($post->published_at)):old('published_at')}}">
                                        <div class="text-danger">
                                            {{ $errors->first('published_at') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        // Select2
        $('.categories,.tag-selection').select2({
            width : '100%',
            maximumSelectionLength:5
        });
        // Ck Editor
        var editor = CKEDITOR.replace('description',{
            filebrowserUploadUrl: "{{route('uploadhandler', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKFinder.setupCKEditor( editor );
        //Featured Image
        $('#feature').change(function(){
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#feature-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });
        $('#full').change(function(){
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#full-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });
        //Datepicker
        $('.published_at').datetimepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            modal: true,
            footer: true,
            datepicker: {
                disableDates:  function (date) {
                    const today = new Date()
                    const yesterday = new Date(today)
                    yesterday.setDate(yesterday.getDate() - 1)
                    return date > yesterday ? true : false;
                }
            }
        });
    </script>
@endpush
