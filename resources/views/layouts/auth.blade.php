<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<!-- Alpine Js -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Webpixels">
    <script src="{{asset('assets/js/countries.js')}}"></script>
    <title>{{config('app.name')}} - @yield('title')@yield('title2')</title>
    <!-- Preloader -->
    <style>
        @keyframes hidePreloader {
            0% {
                width: 100%;
                height: 100%;
            }

            100% {
                width: 0;
                height: 0;
            }
        }

        body>div.preloader {
            position: fixed;
            background: white;
            width: 100%;
            height: 100%;
            z-index: 1071;
            opacity: 0;
            transition: opacity .5s ease;
            overflow: hidden;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body:not(.loaded)>div.preloader {
            opacity: 1;
        }

        body:not(.loaded) {
            overflow: hidden;
        }

        body.loaded>div.preloader {
            animation: hidePreloader .5s linear .5s forwards;
        }
    </style>
    <script>
        window.addEventListener("load", function() {
            setTimeout(function() {
                document.querySelector('body').classList.add('loaded');
            }, 300);
        });
    </script>
    <!-- Favicon -->
    <link rel="icon" href="{{asset ('img/favicon.png')}}" type="image/png"><!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/fonts/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <!-- Quick CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/quick-website.css')}}" id="stylesheet">
</head>

<body>
@yield('content')

{!! NoCaptcha::renderJs() !!}
    <!-- Core JS  -->
    <script src="{{asset('assets/plugins/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/plugins/svg-injector/dist/svg-injector.min.js')}}"></script>
    <script src="{{asset ('assets/plugins/feather-icons/dist/feather.min.js')}}"></script>
    <!-- Quick JS -->
    <script src="{{asset ('assets/js/quick-website.js')}}"></script>
    <!-- Feather Icons -->
    <script>
        feather.replace({
            'width': '1em',
            'height': '1em'
        })
    </script>
</body>

</html>
