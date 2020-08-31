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
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/img/favicons/android-icon-192x192.png')}}">
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
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/ckeditor/plugins/include/spoiler.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@yield('css')
<!-- END Stylesheets -->

    <title>@yield('title') | {{ config('app.name') }}</title>
</head>
<body>
<div id="page-container"
     class="side-scroll page-header-modern page-header-inverse page-header-fixed main-content-boxed">
    @include('layouts.components.sidebar')
    <header id="page-header">
        <div class="content-header">
            <div class="content-header-section d-lg-none">
                <!-- Toggle Sidebar -->
                <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout"
                        data-action="sidebar_toggle">
                    <i class="fa fa-navicon"></i>
                </button>
                <!-- END Toggle Sidebar -->
            </div>
            <div class="content-header-section">
                <div class="content-header-logo">
                    <a href="{{ route('home') }}" class="">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" style="height: 40px">
                    </a>
                </div>
            </div>
            <div class="content-header-section">
                <ul class="nav-main-header">
                    @foreach($areas as $area)
                        <li><a @if (request()->is($area->slug . '*')) class="active" @endif href="{{ route('area', $area->slug) }}">{{ $area->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="content-header-section">
                @guest
                    <ul class="nav-main-header">
                        <li><a href="{{ route('login') }}"><i class="si si-user mr-5"></i>Войти</a></li>
                        <li><a href="{{ route('register') }}"><i class="si si-key"></i>Регистрация</a></li>
                    </ul>
                @endguest
                @auth
                    @include('layouts.components.notifications')
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="si si-user d-sm-none"></i>
                            <img src="@if (auth()->user()->hasImage()) {{ auth()->user()->getImage() }} @else {{ asset('assets/img/avatars/avatar0.jpg') }} @endif" alt="" class=" img img-avatar img-avatar24 mr-5">
                            <span class="d-none d-sm-inline-block">{{ Auth::user()->nickname }}</span>
                            <i class="fa fa-angle-down ml-5"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-200"
                             aria-labelledby="page-header-user-dropdown" x-placement="bottom-end">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="si si-user mr-5"></i> Профиль
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="si si-logout mr-5"></i>Выйти
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </header>
    <main id="main-container" class="bg-primary-darker text-body-color-light">
        <div class="content">
            @include('layouts.components.alerts')
            @yield('content')
        </div>
    </main>
    <footer id="page-footer" class="bg-primary-dark text-body-color-light">
        <div class="content py-20 font-size-xs clearfix">
            <div class="float-left">
                <img src="{{ asset('assets/img/logo.png') }}" alt="" style="height: 40px"> <span class="ml-10">Все права защищены.</span>
                <i class="fa fa-copyright"></i> {{ now()->year }}
            </div>
            <div class="float-right pt-10">
                Powered by <span class="text-primary">skaydi</span>
            </div>
        </div>
    </footer>
</div>
</body>

<!-- Codebase Core JS -->
<script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/core/jquery.appear.min.js') }}"></script>
<script src="{{ asset('assets/js/core/jquery.scrollLock.min.js') }}"></script>
<script src="{{ asset('assets/js/core/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/js/codebase.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/ckeditor/plugins/include/spoiler.js') }}"></script>
<script src="{{ asset('assets/js/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/js/ckeditorInitialScript.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
@yield('js')

</html>
