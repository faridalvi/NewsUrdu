
<!DOCTYPE html>
<html>
<head>
    @include('admin.layouts.head')
</head>
<body>
<!-- Side Navbar -->
@include('admin.layouts.sidebar')
<div class="page">
    <!-- navbar-->
    @include('admin.layouts.navbar')
        @yield('content')
    @include('admin.layouts.footer')
</div>
@include('admin.layouts.scripts')
@stack('js')
</body>
</html>
