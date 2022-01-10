<!DOCTYPE html>
<html lang="en">
<head>

    @include('layouts_login.header')

</head>

<body class="login-page" style="background:#17a2b8; min-height: 496.391px;" >

    @yield('content')
    @include('layouts_login.script')
    @yield('script')
    
</body>
</html>