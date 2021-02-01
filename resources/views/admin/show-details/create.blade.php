@extends('admin.layouts.app')
@section('title','Create Show')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Create Show</li>
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
                            <a href="{{route('show-details.index')}}" class="btn btn-sm btn-dark">View All</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{route('show-details.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="name" value="{{old('name')}}">
                                        <div class="text-danger">
                                            {{ $errors->first('name') }}
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
                                    <label class="col-sm-2 form-control-label">URL</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="url" value="{{old('url')}}">
                                        <div class="text-danger">
                                            {{ $errors->first('url') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row align-items-center">
                                            <label class="col-sm-4 form-control-label">Home Page Section</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="home_page_section_id" class="form-control">
                                                    <option value="6">Podcast</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row align-items-center">
                                            <label class="col-sm-4 form-control-label">Show Name</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="show_id" class="form-control">
                                                    <option value="">Please Select</option>
                                                    @if(count($shows))
                                                        @foreach($shows as $show)
                                                            <option value="{{$show->id}}">{{$show->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="text-danger">
                                                    {{ $errors->first('show_id') }}
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
@endpush
