@extends('layouts.admin')

@section('title', 'Создать зону')

@section('content')
    <form action="{{ route('admin.areas.store') }}" method="post">
        @csrf
        <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="block-header">
                <h3 class="block-title text-body-color-light font-w700 text-center">Создать зону</h3>
                <div class="block-options">
                    <button class="btn btn-alt-success btn-rounded" type="submit"><i class="si si-check"></i> Сохранить</button>
                </div>
            </div>
            <div class="block-content bg-primary-dark pb-20">
                <div class="form-group @error('name') is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="text" name="name" id="name" class="form-control text-body-color-light">
                        <label for="name">Название зоны</label>
                    </div>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </form>
@endsection
