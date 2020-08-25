@extends('layouts.app')

@section('title', $location->name)

@section('content')
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-header">
            @if (auth()->user() and auth()->user()->hasRole('admin'))
                <h3 class="block-title text-body-color-light font-w700">{{ $location->name }} <small>Места</small></h3>
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
                @foreach($location->places as $place)
                    <tr>
                        <td class="text-center" style="width: 65px;"><i class="si si-compass fa-2x"></i></td>
                        <td colspan="2">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('place', ['areaSlug' => $area->slug, 'locationSlug' => $location->slug, 'placeSlug' => $place->slug]) }}" class="font-size-h5 text-primary font-w600">{{ $place->name }}</a>
                                @if (auth()->user() and auth()->user()->hasRole('admin'))
                                    <a href="{{ route('admin.places.edit', $place->slug) }}" class="btn btn-sm btn-alt-primary btn-rounded bg-transparent text-body-color-light ml-10"><i class="fa fa-edit"></i> Редактировать</a>
                                    <form action="{{ route('admin.places.destroy', $place->id) }}" method="post" class="ml-10">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('{{ __('Are you sure that you want delete this place?') }}')" class="btn btn-sm btn-alt-danger btn-rounded bg-transparent text-body-color-light"><i class="fa fa-trash"></i> Удалить</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                        <td></td>
                        <td class="d-none d-md-table-cell text-right">
                            @php
                                $lastPost = $place->lastPost
                            @endphp
                            @if ($lastPost)
                                <span class="font-size-sm">
                                        от <a href="">{{ $lastPost->hero->getName() }}</a>
                                        <br>
                                        <em><a href="{{ route('place', ['areaSlug' => $lastPost->area->slug, 'locationSlug' => $lastPost->location->slug, 'placeSlug' => $lastPost->place->slug]) }}#post{{ $lastPost->id }}" class="js-utc-to-local text-body-color-light">{{ $lastPost->created_at }}</a></em>
                                    </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
