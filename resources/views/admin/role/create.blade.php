@extends('admin.layouts.app')
@section('title','Create Role')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Create Role</li>
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
                            <a href="{{route('role.index')}}" class="btn btn-sm btn-dark">View All</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{route('role.store')}}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name">
                                        <div class="text-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Permissions</label>
                                    <div class="col-sm-10 mb-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h6>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" id="checkAdmin">
                                                    </label>
                                                    <span>Admin</span>
                                                </h6>
                                            </div>
                                            @foreach($adminsPermissions as $value)
                                                <div class="col-sm-2">
                                                    <label class="checkbox-inline adminPermission">
                                                        <input type="checkbox" value="{{$value->id}}" name="permission[]">
                                                        {{$value->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                            <div class="col-sm-12">
                                                <h6>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" id="checkEditor">
                                                    </label>
                                                    <span>Editor</span>
                                                </h6>
                                            </div>
                                            @foreach($editorPermissions as $value)
                                                <div class="col-sm-2">
                                                    <label class="checkbox-inline editorPermission">
                                                        <input type="checkbox" value="{{$value->id}}" name="permission[]">
                                                        {{$value->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                            <div class="col-sm-12">
                                                <h6>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" id="checkSEO">
                                                    </label>
                                                    <span>SEO</span>
                                                </h6>
                                            </div>
                                            @foreach($seoPermissions as $value)
                                                <div class="col-sm-2">
                                                    <label class="checkbox-inline seoPermission">
                                                        <input type="checkbox" value="{{$value->id}}" name="permission[]">
                                                        {{$value->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="text-danger">
                                            {{ $errors->first('permission') }}
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
        $(document).ready(function() {
            $('#checkAdmin').click(function() {
                var checked = $(this).prop('checked');
                $('.adminPermission').find('input:checkbox').prop('checked', checked);
            });
            $('#checkEditor').click(function() {
                var checked = $(this).prop('checked');
                $('.editorPermission').find('input:checkbox').prop('checked', checked);
            });
            $('#checkSEO').click(function() {
                var checked = $(this).prop('checked');
                $('.seoPermission').find('input:checkbox').prop('checked', checked);
            });
        })
    </script>
@endpush
