@extends('layouts.admin')

@section('title', $location->name)

@section('content')
    <form action="{{ route('admin.locations.update', $location->id) }}" method="post">
        @method('put')
        @csrf
        <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="block-header">
                <h3 class="block-title text-body-color-light font-w700 text-center">Локация "{{ $location->name }}" <small>Редактировать</small></h3>
                <div class="block-options">
                    <button class="btn btn-alt-success btn-rounded" type="submit"><i class="si si-check"></i> Сохранить</button>
                </div>
            </div>
            <div class="block-content bg-primary-dark">
                <div class="form-group @error('name') is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="text" name="name" id="name" class="form-control text-body-color-light" value="{{ $location->name }}">
                        <label for="name">Название</label>
                    </div>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('area_id') is-invalid @enderror">
                    <div class="form-material form-material-primary floating open">
                        <select name="area_id" id="area_id" class="form-control text-body-color-light">
                            @foreach($areas as $area)
                                <option @if ($location->area_id == $area->id) selected @endif value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                        <label for="area_id">Игровая зона</label>
                        @error('area_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
