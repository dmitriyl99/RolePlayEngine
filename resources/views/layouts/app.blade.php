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
    @include('layouts.components.navbar')
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
<script src="{{ asset('assets/js/plugins/ckeditor/plugins/include/spoiler.js') }}"></script>
<script src="{{ asset('assets/js/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/js/ckeditorInitialScript.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
@yield('js')

</html>
