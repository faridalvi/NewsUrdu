@extends('front.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 my-5">
            <div class="card">
                <div class="card-header"><h3>{{ __('Verify Your Email Address') }}</h3></div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <h5>{{ __('Before proceeding, please check your email for a verification link.') }}{{ __('If you did not receive the email') }},</h5>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success align-baseline">Verify Your Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
