@extends('admin.layouts.app')
@section('title','Edit Program')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Edit Program</li>
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
                            <a href="{{route('program.index')}}" class="btn btn-sm btn-dark">View All</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{route('program.update',$program->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="name" value="{{(isset($program->name))?$program->name:old('name')}}">
                                        <div class="text-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Slug</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{(isset($program->slug ))?$program->slug:old('slug')}}">
                                        <div class="text-danger">
                                            {{ $errors->first('slug') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Image</label>
                                            <div class="col-sm-8 mb-3">
                                                <input type='file' id="image" name="image"/>
                                                @if(isset($program->image))
                                                    <img id="check-image" src="{{asset('storage/posts/programs/'.$program->image)}}" alt="{{$program->image}}" class="post-image"/>
                                                @else
                                                    <img id="feature-image" src="{{asset('backend/img/no-image.png')}}" alt="your image" class="post-image"/>
                                                @endif
                                                <div class="text-danger">
                                                    {{ $errors->first('image') }}
                                                </div>
                                            </div>
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
        // Ck Editor
        var editor = CKEDITOR.replace('description',{
            filebrowserUploadUrl: "{{route('uploadhandler', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
        CKFinder.setupCKEditor( editor );
        //Featured Image
        $('#image').change(function(){
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#check-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });
    </script>
@endpush
