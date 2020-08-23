@extends('layouts.app')

@section('title', $area->name)

@section('content')
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-header">
            @if (auth()->user() and auth()->user()->hasRole('admin'))
                <h3 class="block-title text-body-color-light font-w700">Локации</h3>
                <div class="block-options">
                    <a href="{{ route('admin.areas.create') }}" class="btn btn-alt-primary btn-rounded text-body-color-light bg-transparent"><i class="si si-plus"></i> Создать зону</a>
                    @if ($areas->count() > 0)
                        <a href="{{ route('admin.locations.create') }}" class="btn btn-alt-primary btn-rounded text-body-color-light bg-transparent"><i class="si si-plus"></i> Создать локацию</a>
                        <a href="{{ route('admin.places.create') }}" class="btn btn-alt-primary btn-rounded text-body-color-light bg-transparent"><i class="si si-plus"></i> Создать место</a>
                    @endif
                </div>
            @else
                <h3 class="block-title text-body-color-light font-w700 text-center">Локации</h3>
            @endif
        </div>
        <div class="block-content bg-primary-dark">
            <table class="table table-stripped table-borderless table-vcenter">
                <tbody>
                @foreach($area->locations as $location)
                    <tr>
                        <td class="text-center" style="width: 65px;"><i class="si si-compass fa-2x"></i></td>
                        <td colspan="2">
                            <div class="d-flex align-items-center">
                                <span class="font-size-h5 text-primary font-w600">{{ $location->name }}</span>
                                @if (auth()->user() and auth()->user()->hasRole('admin'))
                                    <a href="{{ route('admin.locations.edit', $location->slug) }}" class="btn btn-sm btn-alt-primary btn-rounded bg-transparent text-body-color-light ml-10"><i class="fa fa-edit"></i> Редактировать</a>
                                    <form action="{{ route('admin.locations.destroy', $location->id) }}" method="post" class="ml-10">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('{{ __('Are you sure that you want delete this area?') }}')" class="btn btn-sm btn-alt-danger btn-rounded bg-transparent text-body-color-light"><i class="fa fa-trash"></i> Удалить</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                        <td></td>
                        <td>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
