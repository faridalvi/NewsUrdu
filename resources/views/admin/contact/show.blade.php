@extends('admin.layouts.app')
@section('title','Edit Home Page Section')
@section('content')
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Contact Details</li>
            </ul>
        </div>
    </div>
    <section class="forms mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4>Detail</h4>
                            <a href="{{route('contact.index')}}" class="btn btn-sm btn-dark">View All</a>
                        </div>
                        <div class="card-body">
                            <h3 class="mb-2 text-info">Name: {{$contact->name}}</h3>
                            <h5 class="mb-2">Email: {{$contact->email}}</h5>
                            <h6 class="mb-2 text-danger">Subject: {{$contact->subject}}</h6>
                            <p class="text-dark">{{$contact->message}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
@endpush
