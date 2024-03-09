<!doctype html>
<html lang="zxx">

<head>
@include('blockhome.head')
</head>

<body>
    <!--::header part start::-->
    @include('blockhome.header_part')
    <!-- Header part end-->
    @yield('content')

    @include('blockhome.alljs')
</body>

</html>