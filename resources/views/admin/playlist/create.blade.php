@extends('admin.layouts.app')
@section('title','Create Playlist')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Create Playlist</li>
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
                            <a href="{{route('playlist.index')}}" class="btn btn-sm btn-dark">View All</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{route('playlist.store')}}">
                                @csrf
                                <div class="form-group row">
                                   <div class="col-sm-12">
                                       <div class="row">
                                           <div class="col-md-6">
                                               <div class="row">
                                                   <label class="col-sm-3 form-control-label">Name</label>
                                                   <div class="col-sm-9">
                                                       <input type="text" class="form-control"  name="name" value="{{old('name')}}">
                                                       <div class="text-danger">
                                                           {{ $errors->first('name') }}
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="row">
                                                   <label class="col-sm-3 form-control-label">Playlist Id</label>
                                                   <div class="col-sm-9">
                                                       <input type="text" class="form-control" name="playlist_id" value="{{old('playlist_id')}}">
                                                       <div class="text-danger">
                                                           {{ $errors->first('playlist_id') }}
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="row">
                                                   <label class="col-sm-3 form-control-label">Max Results</label>
                                                   <div class="col-sm-9">
                                                       <input type="number" min="1" class="form-control" name="max_results" value="{{old('max_results')}}">
                                                       <div class="text-danger">
                                                           {{ $errors->first('max_results') }}
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="row">
                                                   <label class="col-sm-3 form-control-label">Position</label>
                                                   <div class="col-sm-9">
                                                       <select name="position" class="form-control">
                                                           <option value="">Please Select</option>
                                                           <option value="1">1</option>
                                                           <option value="2">2</option>
                                                           <option value="3">3</option>
                                                           <option value="4">4</option>
                                                           <option value="5">5</option>
                                                       </select>
                                                       <div class="text-danger">
                                                           {{ $errors->first('position') }}
                                                       </div>
                                                   </div>
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
