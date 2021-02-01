@extends('front.layouts.app')
@section('title', 'Home Page')
@section('content')
    {{--Covid Alert--}}
    @if($data['covid'])
        <div class="covid-alert">
            <div class="container ps-sm-0">
                <div class="covid-stats">
                    <div class="row">
                        <div class="col-lg-3 d-none d-lg-block">
                            <img src="{{asset('front/img/covid-alert.png')}}" alt="Covid Alert">
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-6 daily-preview">
                                    {!! $data['covid'] !!}
                                </div>
                                <div class="col-6 total-preview">
                                    {!! $data['covid'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{--Top Videos Section--}}
    @include('front.homepage.top-videos-section')
    {{--    Main Section--}}
    <div class="container ">
        {{--News Section--}}
        <div class="row flex-row-reverse">
            @include('front.homepage.important')
            @include('front.homepage.latest')
            @include('front.homepage.editor-choice')
        </div>
    </div>
    <div class="container ">
        {{--News Section--}}
        <div class="row flex-row-reverse">
            @include('front.homepage.most-read')
            @include('front.homepage.must-read')
            @include('front.homepage.most-viewed-videos')
        </div>
    </div>
    <div class="container ps-0 pe-0">
        {{--News Section--}}
        <div class="row my-3">
            <img src="{{asset('front/img/7.png')}}" alt="" class="w-100">
        </div>
    </div>
    <div class="container text-end">
        <div class="row">
            <h2 class="border-bottom cat-title">کیٹیگریز</h2>
        </div>
        @include('front.homepage.categories')
    </div>
@endsection
@push('js')
@endpush
