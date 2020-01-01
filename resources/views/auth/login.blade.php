@extends('auth.layout')
@section('title', 'Войти')
@section('content')
    <div class="py-30 text-center">
        <a href="{{ route('home') }}"><img
                src="{{ asset('assets/img/logo.png') }}" alt=""></a>
        <h1 class="h4 font-w700 mt-30 mb-10 text-body-color-light">Добро пожаловать, Сталкер!</h1>
    </div>
    <form action="" class="js-validation-signin" method="post" novalidate>
        @csrf
        <div class="block bg-primary-dark-op block-rounded block-shadow">
            <div class="block-header">
                <h3 class="block-title text-body-color-light">Ты кто такой?</h3>
            </div>
            <div class="block-content bg-primary-dark">
                <div class="form-group @error('nickname')is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="text" name="nickname" id="nickname" class="form-control text-body-color-light">
                        <label for="nickname">Прозвище</label>
                    </div>
                    @error('nickname')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('password')is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="password" name="password" id="password" class="form-control text-body-color-light">
                        <label for="password">Пароль</label>
                    </div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group row mb-0">
                    <div class="col-sm-6 d-sm-flex align-items-center push">
                        <label class="css-control css-control-primary css-checkbox">
                            <input type="checkbox" name="remember" id="remember" checked
                                   class="css-control-input">
                            <span class="css-control-indicator"></span>
                            Запомнить меня?
                        </label>
                    </div>
                    <div class="col-sm-6 text-sm-right push">
                        <button class="btn btn-alt-primary" type="submit"><i class="si si-login mr-10"></i>Войти</button>
                    </div>
                </div>
            </div>
            <div class="block-content">
                <div class="form-group text-center">
                    <a href="{{ route('register') }}"
                       class="link-effect text-muted mr-10 mb-5 d-inline-block"><i class="si si-user-follow mr-5"></i>Зарегистрироваться</a>
                    <a href="" class="link-effect text-muted mr-10 mb-5 d-inline-block"><i class="si si-question mr-5"></i>Я забыл пароль</a>
                </div>
            </div>
        </div>
    </form>
@endsection
