@extends('layouts.place')

@section('title', $hero->getName())

@section('content')
    <div class="alert alert-warning alert-block fade show">
        <strong>Если вы редактируете анкету из-за замечаний гейм-мастера, не забудьте отметить исправление гейм-мастера как "Исправлено"!</strong>
    </div>
    <h2 class="content-heading pt-5">Анкета персонажа</h2>
    <form action="{{ route('hero.update', $hero->id) }}" method="post">
        @csrf
        @method('put')
        <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="block-header">
                <h3 class="block-title text-body-color-light text-center">Анкета персонажа <span class="font-weight-bold">{{ $hero->getName() }}</span> <small>Редактировать анкету</small></h3>
            </div>
            <div class="block-content bg-primary-dark">
                <p><span class="font-weight-bold">Полное имя:</span> {{ $hero->name }}</p>
                <p><span class="font-weight-bold">Прозвище:</span> {{ $hero->nickname  }}</p>
                <h2 class="content-heading pt-0">Анкета</h2>
                <div class="profile-content pb-20">
                    {!! $hero->profile->content !!}
                </div>
            </div>
        </div>
        <h4 class="content-heading pt-0">Редактировать</h4>
        <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="block-content bg-primary-dark">
                <div class="form-group @error('name') is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="text" name="name" id="name" class="form-control" value="{{ $hero->name }}">
                        <label for="name">Полное имя</label>
                    </div>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('nickname') is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="text" name="nickname" id="nickname" class="form-control" value="{{ $hero->nickname }}">
                        <label for="nickname">Прозвище (если есть)</label>
                    </div>
                </div>
                <div class="form-group @error('content') is-invalid @enderror">
                    <label for="js-ckeditor">Анкета</label>
                    <textarea name="content" id="js-ckeditor">{!! $hero->profile->content !!}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end mt-10 mb-20">
                    <button class="btn btn-alt-success btn-rounded" type="submit"><i class="si si-check"></i> Сохранить</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{ asset('assets/js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/ckeditorInitialScript.js') }}"></script>
@endsection
