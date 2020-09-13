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
                    <li><a href="/{{ $area->slug }}">{{ $area->name }}</a></li>
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
                    <a href="{{ route('messages.index') }}" class="btn btn-rounded btn-dual-secondary" data-toggle="tooltip" title="Личные сообщения">
                        @if (Auth::user()->incomingMessages()->unread()->count() > 0)
                            <i class="si si-envelope-open"></i>
                            <span class="badge badge-primary badge-pill"
                                  id="messages-count">{{ Auth::user()->incomingMessages()->unread()->count() }}</span>
                        @else
                            <i class="si si-envelope"></i>
                        @endif
                    </a>
                </div>
                @include('layouts.components.notifications')
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="si si-user d-sm-none"></i>
                        <img src="@if (auth()->user()->hasImage()) {{ auth()->user()->getImage() }} @else {{ asset('assets/img/avatars/avatar0.jpg') }} @endif" alt="" class=" img img-avatar img-avatar24 mr-5">
                        <span class="d-none d-sm-inline-block">{{ Auth::user()->nickname }}</span>
                        <i class="fa fa-angle-down ml-5"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown" x-placement="bottom-end">
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="si si-user mr-5"></i> Профиль
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="si si-logout mr-5"></i>Выйти</button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</header>
