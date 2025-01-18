<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/logo/favicon.png">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all-fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">

    <link rel="alternate" type="application/atom+xml" title="News" href="/feed">
    @yield('header')
    <title>@yield('title')</title>
    <script>
        ! function(e, t, n) {
            e.yektanetAnalyticsObject = n, e[n] = e[n] || function() {
                e[n].q.push(arguments)
            }, e[n].q = e[n].q || [];
            var a = t.getElementsByTagName("head")[0],
                r = new Date,
                c = "https://cdn.yektanet.com/superscript/rRqp4fP7/native-no-data-40613/yn_pub.js?v=" + r.getFullYear()
                .toString() + "0" + r.getMonth() + "0" + r.getDate() + "0" + r.getHours(),
                s = t.createElement("link");
            s.rel = "preload", s.as = "script", s.href = c, a.appendChild(s);
            var l = t.createElement("script");
            l.async = !0, l.src = c, a.appendChild(l)
        }(window, document, "yektanet");
    </script>
</head>

<body class="home-9">
    {{-- <div class="preloader">
        <div class="loader-ripple">
            <div></div>
            <div></div>
        </div>
    </div> --}}
    @include('layouts.header')
    @if ($errors->any())
        <div class="error-mes">
            {{ $errors->first() }}
        </div>
    @endif
    @if (session('message'))
        <div class="error-mes">
            {{ session('message') }}
        </div>
    @endif
    @yield('content')
    @include('layouts.footer')

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter-up.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
