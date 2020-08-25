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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@yield('css')
<!-- END Stylesheets -->

    <title>@yield('title') | {{ config('app.name') }}</title>
</head>
<body>
<div id="page-container"
     class="side-scroll page-header-modern page-header-inverse page-header-fixed main-content-boxed">
    <nav id="sidebar">
        <!-- Sidebar Scroll Container -->
        <div id="sidebar-scroll">
            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow px-15">
                    <!-- Mini Mode -->
                    <div class="content-header-section sidebar-mini-visible-b">
                        <!-- Logo -->
                        <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                                </span>
                        <!-- END Logo -->
                    </div>
                    <!-- END Mini Mode -->

                    <!-- Normal Mode -->
                    <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Sidebar -->

                        <!-- Logo -->
                        <div class="content-header-item">
                            <a href="{{ route('home') }}" class="">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="" style="height: 40px">
                            </a>
                        </div>
                        <!-- END Logo -->
                    </div>
                    <!-- END Normal Mode -->
                </div>
                <!-- END Side Header -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main text-body-color-light">
                        @guest
                            <li class="nav-main-heading">
                                Авторизация
                            </li>
                            <li><a href="{{ route('login') }}"><i class="si si-user mr-5"></i>Войти</a></li>
                            <li><a href="{{ route('register') }}"><i class="si si-key"></i>Регистрация</a></li>
                        @endguest
                        <li class="nav-main-heading">Локации</li>
                        @foreach($areas as $area)
                            <li><a href="{{ route('area', $area->slug) }}"><i class="si si-compass"></i>{{ $area->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </div>
            <!-- Sidebar Content -->
        </div>
        <!-- END Sidebar Scroll Container -->
    </nav>
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
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-notifications"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="si si-bell"></i>
                            @if (Auth::user()->unreadNotifications->count() > 0)
                                <span class="badge badge-primary badge-pill"
                                      id="notifications-count">{{ Auth::user()->unreadNotifications->count() }}</span>
                            @endif
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-300"
                             aria-labelledby="page-header-notifications">
                            <h5 class="h6 text-center py-5 mb-0 border-b text-uppercase">Оповещения</h5>
                            @if (Auth::user()->notifications->count() > 0)
                                <ul class="list-unstyled my-20">
                                    @foreach(Auth::user()->notifications as $notification)
                                        <li>
                                            @if (isset($notification->toArray()['data']['url']))
                                                <a href="{{ $notification->toArray()['data']['url'] }}"
                                                   class="media mb-15">
                                                </a>
                                            @elseif ($notification->type == 'App\\Notifications\\ProfileConfirmed')
                                                <a href="#" class="media mb-15 text-body-color-dark">
                                                    <div class="ml-5 mr-15">
                                                        <i class="fa fa-fw fa-check text-success"></i>
                                                    </div>
                                                    <div class="media-body pr-10">
                                                        <p class="mb-0">Анкета вашего
                                                            персонажа {{ $notification->toArray()['data']['profile']['hero']['nickname'] }}
                                                            подтвержджена! Вы можете перейти к созданию ПДА.</p>
                                                        <div class="text-muted font-size-sm font-italic">
                                                            {{ $notification->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                </a>
                                            @else
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                            @endif
                        </div>
                    </div>
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
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div
                        class="block block-rounded text-body-color-light bg-primary-dark-op js-appear-enabled animated fadeInLeft"
                        data-toggle="appear">
                        <div class="block-header">
                            <h3 class="block-title text-body-color-light">Свежие посты</h3>
                        </div>
                        <div class="block-content bg-primary-dark">
                            <ul class="list-group list-group-flush mb-20">
                                @foreach($lastPosts as $lastPost)
                                <li class="list-group-item bg-primary-dark clearfix">
                                    <div class="float-left">
                                        <div class="d-flex">
                                            <i class="fa fa-comments-o fa-2x"></i>
                                            <div class="d-flex flex-column ml-10">
                                                <a href="{{ route('place', ['areaSlug' => $lastPost->area->slug, 'locationSlug' => $lastPost->location->slug, 'placeSlug' => $lastPost->place->slug]) }}#post{{ $lastPost->id }}" class="text-body-color-light font-w600 font-size-md">{{ $lastPost->location->name }}
                                                    - {{ $lastPost->place->name }}</a>
                                                <a href="{{ route('location', ['areaSlug' => $lastPost->area->slug, 'locationSlug' => $lastPost->location->slug]) }}" class="text-body-color-light font-size-sm">{{ $lastPost->location->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                               class="text-body-color-light font-w600 font-size-md text-center">{{ $lastPost->hero->getName() }}</a>
                                            <span class="font-size-sm text-body-color-light js-utc-to-local">{{ $lastPost->created_at }}</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5">
                    <div
                        class="block block-rounded text-body-color-light bg-primary-dark-op js-appear-enabled animated fadeInRight"
                        style="height: 420px" data-toggle="appear">
                        <div class="block-header">
                            <h3 class="block-title text-body-color-light fresh-posts text-right">Новые игроки</h3>
                        </div>
                        <div class="block-content bg-primary-dark">
                            <ul class="list-group list-group-flush">
                                @foreach($lastUsers as $user)
                                    <a href="{{ route('profile.show', $user->slug) }}"
                                       class="list-group-item bg-primary-dark list-group-item-action">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="@if ($user->hasImage()) {{ $user->getImage() }} @else {{ asset('assets/img/avatars/avatar0.jpg') }} @endif" alt=""
                                                     class="img img-avatar img-avatar32">
                                            </div>
                                            <div class="col-10">
                                                <span class="text-body-color-light">{{ $user->nickname }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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
<script src="{{ asset('assets/js/script.js') }}"></script>
@yield('js')

</html>
