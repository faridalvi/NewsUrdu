@extends('admin.layouts.app')
@section('title','Edit Tag')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Edit Tag</li>
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
                            <a href="{{route('tag.index')}}" class="btn btn-sm btn-dark">View All</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{route('tag.update',$tag->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="title" name="name" value="{{(isset($tag->name))?$tag->name:old('name')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Slug</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="slug" name="slug" value="{{(isset($tag->slug))?$tag->slug:old('slug')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row align-items-center">
                                            <label class="col-sm-4 form-control-label">Trending</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="trending" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="0" @if($tag->trending == 0) selected @endif>No</option>
                                                    <option value="1" @if($tag->trending == 1) selected @endif>yes</option>
                                                </select>
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
