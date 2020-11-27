<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{asset("front/style.css")}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('back/plugins/fontawesome-free/css/all.min.css')}}">

    @yield('stylesheet')

</head>
<body>

<div id="preloader">
    <div class="loader"></div>
</div>

@yield('content')

<footer class="footer-area section-padding-80-0">

</footer>
<!-- Footer Area End -->

<!-- **** All JS Files ***** -->
<!-- jQuery 2.2.4 -->
<script src="{{asset("front/js/jquery.min.js")}}"></script>
<!-- Popper -->
<script src="{{asset("front/js/popper.min.js")}}"></script>
<!-- Bootstrap -->
<script src="{{asset("front/js/bootstrap.min.js")}}"></script>
<!-- All Plugins -->
<script src="{{asset("front/js/hami.bundle.js")}}"></script>
<!-- Active -->
<script src="{{asset("front/js/default-assets/active.js")}}"></script>

</body>

</html>
