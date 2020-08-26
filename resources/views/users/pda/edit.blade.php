@extends('layouts.place')

@section('title', "КПК персонажа {$pda->hero->getName()}")

@section('content')
    <h2 class="content-heading">КПК персонажа {{ $pda->hero->getName() }}</h2>
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn"
         data-toggle="appear">
        <div class="block-content bg-primary-dark">
            {!! $pda->content !!}
        </div>
    </div>
    @auth
        @if (auth()->user()->id == $pda->user_id)
            <form action="{{ route('hero.pda.update', $pda->hero->id) }}" method="post">
                @csrf
                @method('put')
                <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn"
                     data-toggle="appear">
                    <div class="block-content bg-primary-dark">
                        <div class="form-group @error('content') is-invalid @enderror">
                            <label for="js-ckeditor">Редактировать КПК</label>
                            <textarea name="content" id="js-ckeditor">{!! $pda->content !!}</textarea>
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
        @endif
    @endauth
@endsection
