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
    <link rel="shortcut icon" href="{{ asset('assets/img/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/img/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Codebase framework -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ asset('assets/css/themes/pulse.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('css')
    <!-- END Stylesheets -->

    <title>@yield('title') | {{ config('app.name') }}</title>
</head>
<body>
    <div id="page-container" class="side-scroll page-header-modern page-header-inverse page-header-fixed main-content-boxed">
        <header id="page-header">
            <div class="content-header">
                <div class="content-header-section">
                    <div class="content-header-logo">
                        <a href="{{ route('home') }}" class="">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="" style="height: 40px">
                        </a>
                    </div>
                </div>
                <div class="content-header-section">
                    <ul class="nav-main-header">
                        <li><a href="#">Южные земли</a></li>
                        <li><a href="#">Магистраль</a></li>
                        <li><a href="#">Северные земли</a></li>
                    </ul>
                </div>
                <div class="content-header-section">
                    @guest
                        <ul class="nav-main-header">
                            <li><a href="#"><i class="si si-user mr-5"></i>Войти</a></li>
                            <li><a href="#"><i class="si si-key"></i>Регистрация</a></li>
                        </ul>
                    @endguest
                    @auth
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="si si-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block">{{ Auth::user()->nickname }}</span>
                                <i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                                <a href="#" class="dropdown-item"><i class="si si-user mr-5"></i>Профиль</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="si si-logout mr-5">Выйти</i>
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </header>
        <main id="main-container">
            <div class="bg-primary-darker text-body-color-light">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            <div class="block block-rounded text-body-color-light bg-primary-dark-op js-appear-enabled animated fadeInLeft" data-toggle="appear">
                                <div class="block-header">
                                    <h3 class="block-title text-body-color-light">Свежие посты</h3>
                                </div>
                                <div class="block-content bg-primary-dark">
                                    <ul class="list-group list-group-flush mb-20">
                                        <li class="list-group-item bg-primary-dark clearfix">
                                            <div class="float-left">
                                                <div class="d-flex">
                                                    <i class="fa fa-comments-o fa-2x"></i>
                                                    <div class="d-flex flex-column ml-10">
                                                        <a href="#" class="text-body-color-light font-w600 font-size-md">Кордон - Бункер Сидоровича</a>
                                                        <a href="#" class=" text-body-color-light font-size-sm">Кордон</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="float-right">
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-body-color-light font-w600 font-size-md text-center">Нулевой</a>
                                                    <span class="font-size-sm text-body-color-light"><span class="font-w600">23:08</span> | 20.12.2019</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item bg-primary-dark clearfix">
                                            <div class="float-left">
                                                <div class="d-flex">
                                                    <i class="fa fa-comments-o fa-2x"></i>
                                                    <div class="d-flex flex-column ml-10">
                                                        <a href="#" class="text-body-color-light font-w600 font-size-md">Кордон - Бункер Сидоровича</a>
                                                        <a href="#" class=" text-body-color-light font-size-sm">Кордон</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="float-right">
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-body-color-light font-w600 font-size-md text-center">Нулевой</a>
                                                    <span class="font-size-sm text-body-color-light"><span class="font-w600">23:08</span> | 20.12.2019</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item bg-primary-dark clearfix">
                                            <div class="float-left">
                                                <div class="d-flex">
                                                    <i class="fa fa-comments-o fa-2x"></i>
                                                    <div class="d-flex flex-column ml-10">
                                                        <a href="#" class="text-body-color-light font-w600 font-size-md">Кордон - Бункер Сидоровича</a>
                                                        <a href="#" class=" text-body-color-light font-size-sm">Кордон</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="float-right">
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-body-color-light font-w600 font-size-md text-center">Нулевой</a>
                                                    <span class="font-size-sm text-body-color-light"><span class="font-w600">23:08</span> | 20.12.2019</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item bg-primary-dark clearfix">
                                            <div class="float-left">
                                                <div class="d-flex">
                                                    <i class="fa fa-comments-o fa-2x"></i>
                                                    <div class="d-flex flex-column ml-10">
                                                        <a href="#" class="text-body-color-light font-w600 font-size-md">Кордон - Бункер Сидоровича</a>
                                                        <a href="#" class=" text-body-color-light font-size-sm">Кордон</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="float-right">
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-body-color-light font-w600 font-size-md text-center">Нулевой</a>
                                                    <span class="font-size-sm text-body-color-light"><span class="font-w600">23:08</span> | 20.12.2019</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item bg-primary-dark clearfix">
                                            <div class="float-left">
                                                <div class="d-flex">
                                                    <i class="fa fa-comments-o fa-2x"></i>
                                                    <div class="d-flex flex-column ml-10">
                                                        <a href="#" class="text-body-color-light font-w600 font-size-md">Кордон - Бункер Сидоровича</a>
                                                        <a href="#" class=" text-body-color-light font-size-sm">Кордон</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="float-right">
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-body-color-light font-w600 font-size-md text-center">Нулевой</a>
                                                    <span class="font-size-sm text-body-color-light"><span class="font-w600">23:08</span> | 20.12.2019</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-5">
                            <div class="block block-rounded text-body-color-light bg-primary-dark-op js-appear-enabled animated fadeInRight" style="height: 420px" data-toggle="appear">
                                <div class="block-header">
                                    <h3 class="block-title text-body-color-light fresh-posts text-right">Новые игроки</h3>
                                </div>
                                <div class="block-content bg-primary-dark"></div>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </main>
        <footer id="page-footer">
            <div class="content py-20 font-size-xs clearfix">

            </div>
        </footer>
    </div>
</body>

<!-- Codebase Core JS -->
<script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/core/jquery.appear.min.js') }}"></script>
<script src="{{ asset('assets/js/codebase.min.js') }}"></script>

</html>
