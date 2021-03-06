@extends('layouts.admin')

@section('title', 'Добавить статью - Энциклопедия')

@section('content')
    <form action="{{ route('admin.articles.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="block-header">
                <h3 class="block-title text-body-color-light font-w700 text-center">Добавить статью в энциклопедию</h3>
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
                <div class="form-group @error('image') is-invalid @enderror">
                    <div class="form-material form-material-primary">
                        <input type="file" name="image" id="image" class="form-control text-body-color-light">
                        <label for="image">Изображение</label>
                    </div>
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group @error('encyclopedia_id') is-invalid @enderror">
                    <div class="form-material form-material-primary floating open">
                        <select name="encyclopedia_id" id="encyclopedia_id" class="form-control text-body-color-light">
                            <option selected disabled>-- Выберите раздел --</option>
                            @foreach($encyclopedias as $encyclopedia)
                                <option value="{{ $encyclopedia->id }}">{{ $encyclopedia->title }}</option>
                            @endforeach
                        </select>
                        <label for="encyclopedia_id">Раздел энциклопедии</label>
                        @error('encyclopedia_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group @error('content') is-invalid @enderror">
                    <div class="form-material form-material-primary">
                        <label for="js-ckeditor">Контент</label>
                        <textarea type="text" name="content" id="js-ckeditor">{!! old('content') !!}</textarea>
                    </div>
                    @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </form>
@endsection
