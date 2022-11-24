
<!DOCTYPE html>
<html lang="en">
<head>
    @yield('tittle')
    @include('DashboardViews.Includes.Head')
</head>
<body>
@include('DashboardViews.Includes.Navbar')
@yield('body')
@include('DashboardViews.Includes.Footer')
@include('DashboardViews.Includes.Scripts')

</body>
</html>

