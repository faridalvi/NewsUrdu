@extends('admin.layouts.app')
@section('title','Edit User')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Edit User</li>
            </ul>
        </div>
    </div>
    <section class="forms mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if(Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4>Edit</h4>
                            <a href="{{route('user.index')}}" class="btn btn-sm btn-dark">View All</a>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ route('user.update',$user->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{Auth::user()->id}}" name="updated_by">
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" value="{{(isset($user->name))?$user->name:old('name')}}">
                                        <div class="text-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" value="{{(isset($user->email))?$user->email:old('email')}}">
                                        <div class="text-danger">
                                            {{ $errors->first('email') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" name="password">
                                                <div class="text-danger">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Confirm Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Status</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="is_active" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="0" @if($user->is_active == 0) selected @endif>Not Active</option>
                                                    <option value="1" @if($user->is_active == 1) selected @endif>Active</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Role</label>
                                            <div class="col-sm-8 mb-3">
                                                <select name="roles" class="form-control">
                                                    <option value="">Please Select</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{$role}}" @if($user->roles[0]->name == $role) selected @endif>{{$role}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="text-danger">
                                                    {{ $errors->first('roles') }}
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
