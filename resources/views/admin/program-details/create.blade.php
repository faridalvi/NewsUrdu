@extends('admin.layouts.app')
@section('title','Create Program Details')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Create Program Details</li>
            </ul>
        </div>
    </div>
    <section class="forms mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4>Add New</h4>
                            <a href="{{route('program-details.index')}}" class="btn btn-sm btn-dark">View All</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{route('program-details.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                                        <div class="text-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Slug</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')}}">
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
                                                    <option value="0">Draft</option>
                                                    <option value="1">Publish</option>
                                                </select>
                                                <div class="text-danger">
                                                    {{ $errors->first('status') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row align-items-center">
                                            <label class="col-sm-4 form-control-label">Program</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="program_id" class="form-control">
                                                    <option value="">Please Select</option>
                                                    @foreach($programs as $program)
                                                        <option value="{{$program->id}}">{{ucwords($program->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Focus Keywords</label>
                                    <div class="col-sm-10">
                                        <select name="focus_keywords[]" class="keyword-selection form-control" multiple="multiple">
                                        </select>
                                        <div class="text-danger">
                                            {{ $errors->first('focus_keywords') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Meta Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="meta_description" value="{{old('meta_description')}}">
                                        <div class="text-danger">
                                            {{ $errors->first('meta_description') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Meta Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="meta_title" value="{{old('meta_title')}}">
                                        <div class="text-danger">
                                            {{ $errors->first('meta_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Featured Image</label>
                                            <div class="col-sm-8 mb-3">
                                                <input type='file' id="feature" name="featured_image"/>
                                                <img id="feature-image" src="{{asset('backend/img/no-image.png')}}" alt="your image" class="post-image"/>
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
                                                <img id="full-image" src="{{asset('backend/img/no-image.png')}}" alt="your image" class="post-image"/>
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
                                        <input type="text" name="sub_content" class="form-control" value="{{old('sub_content')}}">
                                        <div class="text-danger">
                                            {{ $errors->first('sub_content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Program Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                                        <div class="text-danger">
                                            {{ $errors->first('description') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Publish Time</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="published_at" class="form-control published_at" value="{{old('published_at')}}">
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
        var tag='';
        $('.keyword-selection').select2({
            width : '100%',
            maximumSelectionLength:5,
            tags: true,
            delay:500,
            ajax: {
                url: '{{route('get-keywords')}}',
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
            },
            createTag: function (params) {
                var term = $.trim(params.term);
                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    tag: true // add additional parameters
                }
            },
            insertTag: function (data, tag) {
                data.push(tag);
            },
            placeholder:"Search Keywords"
        }).
        on("select2:select", function(e) {
            var _token = $("input[name='_token']").val();
            var selectList=$('.keyword-selection').find('option:selected');
            if(e.params.data.text !=''){
                $.ajax({
                    type:'post',
                    url:'{{route('new-keywords')}}',
                    data:{'name':e.params.data.text,'_token':_token},
                    success:function (response){
                        if($.isEmptyObject(response.error)){
                            $(selectList).attr('value',response);
                        }else {
                            printErrorMsg(response.error);
                        }
                    },
                    error:function (err){
                        console.log(err);
                    }
                });
            }
        });
        // Ck Editor
        var editor = CKEDITOR.replace('description',{
            filebrowserUploadUrl: "{{route('uploadhandler', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
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
