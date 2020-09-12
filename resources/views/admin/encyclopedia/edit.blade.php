@extends('layouts.admin')

@section('title', $encyclopedium->title . ' - Энциклопедия')

@section('content')
    <form action="{{ route('admin.encyclopedia.update', $encyclopedium->slug) }}" method="post">
        @csrf
        @method('PUT')
        <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="block-header">
                <h3 class="block-title text-body-color-light font-w700 text-center">{{ $encyclopedium->title }} <small>Редактировать</small></h3>
                <div class="block-options">
                    <button class="btn btn-alt-success btn-rounded" type="submit"><i class="si si-check"></i> Сохранить</button>
                </div>
            </div>
            <div class="block-content bg-primary-dark pb-20">
                <div class="form-group @error('title') is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="text" name="title" id="title" class="form-control text-body-color-light" value="{{ $encyclopedium->title }}">
                        <label for="title">Название</label>
                    </div>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group @error('description') is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="text" name="description" id="description" class="form-control text-body-color-light" value="{{ $encyclopedium->description }}">
                        <label for="description">Описание</label>
                    </div>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </form>
@endsection
