@extends('layouts.place')

@section('title', "Создать КПК для {$hero->getName()}")


@section('content')
    <h2 class="content-heading">Создание КПК для персонажа {{ $hero->getName() }}</h2>
    <form action="{{ route('hero.pda.store', $hero->id) }}" method="post">
        @csrf
        <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn"
             data-toggle="appear">
            <div class="block-content bg-primary-dark">
                <div class="form-group @error('content') is-invalid @enderror">
                    <label for="js-ckeditor">Оформите КПК здесь</label>
                    <textarea name="content" id="js-ckeditor"></textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end my-20">
                    <button class="btn btn-alt-success btn-rounded"><i class="si si-check"></i> Сохранить</button>
                </div>
            </div>
        </div>
    </form>
@endsection
