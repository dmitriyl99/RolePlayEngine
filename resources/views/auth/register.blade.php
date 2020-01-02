@extends('auth.layout')

@section('title', 'Регистрация')

@section('content')
    <div class="py-30 text-center">
        <a href="{{ route('home') }}"><img
                src="{{ asset('assets/img/logo.png') }}" alt=""></a>
        <h1 class="h4 font-w700 mt-30 mb-10 text-body-color-light">Добро пожаловать, Сталкер! Хочешь создать новый профиль?</h1>
    </div>
    <form action="" class="js-validation-signin" method="post" novalidate enctype="multipart/form-data">
        @csrf
        <div class="block bg-primary-dark-op block-rounded block-shadow">
            <div class="block-header">
                <h3 class="block-title text-body-color-light">Валыну убери и представься.</h3>
            </div>
            <div class="block-content bg-primary-dark">
                <div class="form-group @error('name')is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="text" name="name" id="name" class="form-control text-body-color-light">
                        <label for="name">Полное имя <span class="text-danger">*</span></label>
                        <div class="form-text text-muted text-right">Имя и фамилия, отчество не надо.</div>
                    </div>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('nickname')is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="text" name="nickname" id="nickname" class="form-control text-body-color-light">
                        <label for="nickname">Прозвище <span class="text-danger">*</span></label>
                        <div class="form-text text-muted text-right">Ваше прозвище будет отображаться везде в системе и использоваться для авторизации.</div>
                    </div>
                    @error('nickname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('email')is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="email" name="email" id="email" class="form-control text-body-color-light">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <div class="form-text text-muted text-right">Адрес электронной почты.</div>
                    </div>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('avatar')is_invalid @enderror">
                    <div class="form-material form-material-primary">
                        <input type="file" name="avatar" id="avatar" class="form-control text-body-color-light">
                        <label for="avatar">Аватар</label>
                        <div class="d-flex mt-20 justify-content-center">
                            <img src="{{ asset('assets/img/avatars/avatar0.jpg') }}" alt="" class="img-avatar"
                                 id="avatar-img">
                        </div>
                    </div>
                </div>
                <div class="form-group @error('signature')is_invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <textarea name="signature" rows="5" id="signature" class="form-control text-body-color-light"></textarea>
                        <label for="signature">Подпись</label>
                        <div class="form-text text-muted text-right">Твоя подпись будет отображаться под всеми постами на сайте.</div>
                    </div>
                </div>
                <div class="form-group @error('password')is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="password" name="password" id="password" class="form-control text-body-color-light">
                        <label for="password">Новый пароль <span class="text-danger">*</span></label>
                        <div class="form-text text-muted text-right">Не забудь.</div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('password_confirmation')is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control text-body-color-light">
                        <label for="password_confirmation">Подтверди пароль <span class="text-danger">*</span></label>
                    </div>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group row mb-0">
                    <div class="col-sm-12 text-sm-right push">
                        <button class="btn btn-alt-primary" type="submit"><i class="si si-key mr-10"></i>Создать аккаунт</button>
                    </div>
                </div>
                <div class="form-group">
                    <p class="my-10 font-size-md"><span class="text-danger">*</span> - обязательные поля</p>
                </div>
            </div>
            <div class="block-content">
                <div class="form-group text-center">
                    <a href="{{ route('login') }}"
                       class="link-effect text-muted mr-10 mb-5 d-inline-block"><i class="si si-user mr-5"></i>Войти</a>
                </div>
            </div>
        </div>
    </form>
@endsection
