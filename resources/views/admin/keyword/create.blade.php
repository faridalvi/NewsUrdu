@extends('admin.layouts.app')
@section('title','Create Keyword')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Create Keyword</li>
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
                            <a href="{{route('keyword.index')}}" class="btn btn-sm btn-dark">View All</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{route('keyword.store')}}">
                                @csrf
                                <div class="form-group row">
                                   <div class="col-sm-6">
                                       <div class="row">
                                           <label class="col-sm-4 form-control-label">Name</label>
                                           <div class="col-sm-8">
                                               <input type="text" class="form-control" id="title" name="name" value="{{old('name')}}">
                                               <div class="text-danger">
                                                   {{ $errors->first('name') }}
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                    <div class="col-sm-4">
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
