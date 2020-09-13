@extends('layouts.admin')

@section('title', 'Добавить раздел - Энциклопедия')

@section('content')
    <form action="{{ route('admin.encyclopedia.store') }}" method="post">
        @csrf
        <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="block-header">
                <h3 class="block-title text-body-color-light font-w700 text-center">Добавить раздел в энциклопедию</h3>
                <div class="block-options">
                    <button class="btn btn-alt-success btn-rounded" type="submit"><i class="si si-check"></i> Сохранить</button>
                </div>
            </div>
            <div class="block-content bg-primary-dark pb-20">
                <div class="form-group @error('title') is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="text" name="title" id="title" class="form-control text-body-color-light" value="{{ old('title') }}">
                        <label for="title">Название</label>
                    </div>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group @error('description') is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="text" name="description" id="description" class="form-control text-body-color-light" value="{{ old('description') }}">
                        <label for="description">Краткое описание</label>
                    </div>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group @error('image') is-invalid @enderror">
                    <div class="form-material form-material-primary">
                        <input type="file" name="image" id="image" class="form-control text-body-color-light">
                        <label for="image">Изображение</label>
                    </div>
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group @error('full_description') is-invalid @enderror">
                    <div class="form-material form-material-primary">
                        <textarea type="text" name="full_description" id="js-ckeditor">{!! old('full_description') !!}</textarea>
                        <label for="js-ckeditor">Полное описание</label>
                    </div>
                    @error('full_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </form>
@endsection
