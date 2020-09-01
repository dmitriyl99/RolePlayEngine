<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{ config('app.name') }} role play project">
    <meta name="author" content="skaydi">

    <meta property="og:title" content="{{ config('app.name') }} role play project">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ config('app.name') }} role play project">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/img/favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/img/favicons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/favicons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/favicons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/favicons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/favicons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/favicons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/favicons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/img/favicons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#383838">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#383838">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Codebase framework -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ asset('assets/css/themes/pulse.min.css') }}">
@yield('styles')
<!-- END Stylesheets -->

    <title>Бан | {{ config('app.name') }}</title>
</head>
<body>
<div id="page-container" class="main-content-boxed">
    <main id="main-container" class="bg-primary-darker text-body-color-light">
        <div class="hero bg-primary-darker">
            <div class="hero-inner">
                <div class="content content-full">
                    <div class="py-30 text-center">
                        <div class="display-3 text-warning">Вы забанены!</div>
                        <h1 class="h2 font-w700 mt-30 mb-10 text-body-color-light">Добро пожаловать на банановые острова!</h1>
                        <h2 class="h3 font-w400 text-muted mb-50 text-body-color-light">{{ $ban->reason }}</h2>
                        <h2 class="h3 font-w400 text-muted mb-50 text-body-color-light">Срок истечения: <span class="js-utc-to-local">{{ $ban->expired_at }}</span></h2>
                        <a href="{{ route('home') }}" class="btn btn-hero btn-rounded btn-alt-primary"><i class="fa fa-arrow-left mr-10"></i> Вернуться на главную</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>

<!-- Codebase Core JS -->
<script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/codebase.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
@yield('js')

</html>
