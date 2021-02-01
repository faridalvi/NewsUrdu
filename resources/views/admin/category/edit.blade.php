@extends('admin.layouts.app')
@section('title','Edit Category')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Edit Category</li>
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
                            <a href="{{route('category.index')}}" class="btn btn-sm btn-dark">View All</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{route('category.update',$category->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="title" name="name" value="{{(isset($category->name))?$category->name:old('name')}}">
                                                <div class="text-danger">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Slug</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="slug" name="slug" value="{{(isset($category->slug))?$category->slug:old('slug')}}">
                                                <div class="text-danger">
                                                    {{ $errors->first('slug') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row align-items-center">
                                            <label class="col-sm-4 form-control-label">Parent</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="parent_id" class="form-control">
                                                    <option value="">Please Select</option>
                                                    @foreach($categories as $cat)
                                                        <option value="{{$cat->id}}"
                                                                @if($category->parent_id == $cat->id)
                                                                    selected
                                                                @endif
                                                        >{{ucwords($cat->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row align-items-center">
                                            <label class="col-sm-4 form-control-label">Home Page Section</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="home_page_section_id" class="form-control">
                                                    <option value="">Please Select</option>
                                                    @foreach($homePageSections as $homePageSection)
                                                        <option value="{{$homePageSection->id}}"
                                                            @if($category->home_page_section_id  == $homePageSection->id)
                                                                selected
                                                            @endif
                                                        >{{ucwords($homePageSection->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row align-items-center">
                                            <label class="col-sm-4 form-control-label">Show In Top Menu</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="show_in_top_nav" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="0" @if($category->show_in_top_nav == 0) selected @endif>No</option>
                                                    <option value="1" @if($category->show_in_top_nav == 1) selected @endif>Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row align-items-center">
                                            <label class="col-sm-4 form-control-label">Position</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="position" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="1" @if($category->position == 1) selected @endif>1</option>
                                                    <option value="2" @if($category->position == 2) selected @endif>2</option>
                                                    <option value="3" @if($category->position == 3) selected @endif>3</option>
                                                    <option value="4" @if($category->position == 4) selected @endif>4</option>
                                                    <option value="5" @if($category->position == 5) selected @endif>5</option>
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
