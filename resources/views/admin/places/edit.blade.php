@extends('layouts.admin')

@section('title', $place->name)

@section('content')
    <form action="{{ route('admin.places.update', $place->id) }}" method="post">
        @method('put')
        @csrf
        <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="block-header">
                <h3 class="block-title text-body-color-light font-w700 text-center">Место для игры "{{ $place->name }}" <small>Редактировать</small></h3>
                <div class="block-options">
                    <button class="btn btn-alt-success btn-rounded" type="submit"><i class="si si-check"></i> Сохранить</button>
                </div>
            </div>
            <div class="block-content bg-primary-dark">
                <div class="form-group @error('name') is-invalid @enderror">
                    <div class="form-material form-material-primary floating">
                        <input type="text" name="name" id="name" class="form-control text-body-color-light" value="{{ $place->name }}">
                        <label for="name">Название</label>
                    </div>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('image') is-invalid @enderror">
                    <div class="form-material form-material-primary">
                        <input type="file" name="image" id="image" class="form-control text-body-color-light">
                        <label for="image">Изображение</label>
                    </div>
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if ($place->hasImage())
                        <img src="{{ $place->getImage() }}" alt="{{ $place->name }}" class="img-thumbnail">
                    @endif
                </div>
                <div class="form-group @error('description') is-invalid @enderror">
                    <div class="form-material form-material-primary">
                        <textarea name="description" id="js-ckeditor">{!! $place->description !!}</textarea>
                        <label for="js-ckeditor">Описание</label>
                    </div>
                </div>
                <div class="form-group @error('area_id') is-invalid @enderror">
                    <div class="form-material form-material-primary floating open">
                        <select name="area_id" id="area_id" class="form-control text-body-color-light">
                            @foreach($areas as $area)
                                <option @if ($place->area_id == $area->id) selected @endif value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                        <label for="area_id">Игровая зона</label>
                        @error('area_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group @error('location_id') is-invalid @enderror">
                    <div class="form-material floating form-material-primary open">
                        <select name="location_id" id="location_id" class="form-control text-body-color-light">
                            @foreach($place->area->locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        <label for="location_id">Игровая локация</label>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
        jQuery(function () {
            let areaSelect = jQuery('#area_id');
            let locationSelect = jQuery('#location_id');
            areaSelect.on('change', function () {
                jQuery.ajax({
                    url: '/api/areas/' + this.value + '/locations',
                    beforeSend: function (xhr) {
                        areaSelect.attr('disabled', 'disabled');
                        locationSelect.attr('disabled', 'disabled');
                    },
                    complete: function (xhr, status) {
                        if (status === 'success') {
                            let response = xhr.responseJSON;
                            locationSelect.empty();
                            locationSelect.append('<option disabled selected>-- Выберите локацию --</option>');
                            response.forEach(function (item) {
                                let html = `<option value="${item.id}">${item.name}</option>`;
                                locationSelect.append(html);
                            });
                            areaSelect.removeAttr('disabled');
                            locationSelect.removeAttr('disabled');
                        }
                    }
                })
            });
        })
    </script>
@endsection
