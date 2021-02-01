@extends('admin.layouts.app')
@section('title','Edit Home Page Section')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Edit Home Page Section</li>
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
                            <a href="{{route('homePage.index')}}" class="btn btn-sm btn-dark">View All</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{route('homePage.update',$homePage->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="title" name="name" value="{{(isset($homePage->name))?$homePage->name:old('name')}}">
                                                <div class="text-danger">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row align-items-center">
                                            <label class="col-sm-4 form-control-label">Position</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="position" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="1" @if($homePage->position == 1) selected @endif>1</option>
                                                    <option value="2" @if($homePage->position == 2) selected @endif>2</option>
                                                    <option value="3" @if($homePage->position == 3) selected @endif>3</option>
                                                    <option value="4" @if($homePage->position == 4) selected @endif>4</option>
                                                    <option value="5" @if($homePage->position == 5) selected @endif>5</option>
                                                    <option value="6" @if($homePage->position == 6) selected @endif>6</option>
                                                </select>
                                                <div class="text-danger">
                                                    {{ $errors->first('position') }}
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
