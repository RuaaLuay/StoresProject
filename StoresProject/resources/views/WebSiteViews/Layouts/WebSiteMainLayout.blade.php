<!DOCTYPE html>
<html lang="en">

<head>
    @yield('tittle')
    @include('WebSiteViews.includes.head')

</head>

<body>
<!-- Start Top Nav -->
@include('WebSiteViews.includes.nav')
<!-- Close Top Nav -->

<!-- Header -->
@include('WebSiteViews.includes.header')
<!-- Close Header -->

@yield('body')


<!-- Start Footer -->
@include('WebSiteViews.includes.footer')
<!-- End Footer -->

<!-- Start Script -->
@include('WebSiteViews.includes.scripts')
<!-- End Script -->

@yield('Slider_Script')


</body>
