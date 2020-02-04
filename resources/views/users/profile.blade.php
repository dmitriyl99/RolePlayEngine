@extends('layouts.app')

@section('title', $user->nickname)

@section('content')
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-header">
            <h3 class="block-title text-body-color-light text-center">Профиль игрока <span class="text-primary font-w700">{{ $user->nickname }}</span></h3>
        </div>
        <div class="block-content bg-primary-dark">
            <div class="row pb-20">
                <div class="col-sm-12 col-md-6">
                    <img src="{{ asset($user->getAvatar()) }}" class="img-fluid" alt="">
                </div>
                <div class="col-sm-12 col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-primary-dark text-body-color-light">Имя: <span class="font-w700">{{ $user->name }}</span>  a.k.a <span class="font-w700">{{ $user->nickname }}</span></li>
                        <li class="list-group-item bg-primary-dark text-body-color-light">E-mail: @if (Auth::user() &&  Auth::user()->id === $user->id) <a href="mailto:{{ $user->email }}" class="font-w700">{{ $user->email }}</a> <small>(Адрес виден только вам)</small> @else Незачем тебе это знать! @endif</li>
                        <li class="list-group-item bg-primary-dark text-body-color-light">Зарегистрирован: <span class="font-w700 js-utc-to-local">{{ date('d.m.Y H:m', strtotime($user->created_at)) }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="content-header">
                <h3 class="content-heading text-body-color-light font-w700">Персонажи</h3>
            </div>
            @if ($user->hasHeroes())
                <div class="row">
                    @foreach($user->heroes as $hero)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <a href="#" class="block block-rounded block-link-rotate text-center text-body-color-light bg-primary-dark">
                                <div class="block-content">
                                    <p class="mt-5">
                                        <i class="si si-user fa-4x text-primary"></i>
                                    </p>
                                    <p class="font-w600">{{ $hero->getName() }}</p>
                                    <small>Создан: <span  class="js-utc-to-local">{{ date('d.m.Y H:m', strtotime($hero->created_at)) }}</span></small>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-30 text-center">
                    <i class="si si-ghost text-primary display-3"></i>
                    <p class="mt-20 font-size-h5">У @if (Auth::user() && Auth::user()->id === $user->id) Вас @else этого пользователя @endif ещё нет ни одного персонажа</p>
                    @if (Auth::user() && Auth::user()->id === $user->id)<a href="#" class="btn btn-alt-primary">Создать</a>@endif
                </div>
            @endif
        </div>
    </div>
@endsection
