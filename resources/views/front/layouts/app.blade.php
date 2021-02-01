<!doctype html>
<html lang="en">
<head>
    @include('front.layouts.head')
</head>
<body>
@include('front.layouts.topbar')
@include('front.layouts.navbar')
@yield('content')
@include('front.layouts.footer')
@include('front.layouts.scripts')
@stack('js')
</body>
</html>
