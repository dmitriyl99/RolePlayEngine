@extends('layouts.app')

@section('title', 'Энциклопедия')

@section('content')
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-header">
            <h3 class="block-title text-body-color-light font-w700 text-center">Энциклопедия</h3>
            @auth
                @if (auth()->user()->hasRole('admin'))
                    <div class="block-options">
                        <a href="{{ route('admin.encyclopedia.create') }}" class="btn btn-alt-primary btn-rounded text-body-color-light bg-transparent"><i class="si si-plus"></i> Добавить раздел</a>
                        @if ($encyclopedias->count() > 0)
                            <a href="{{ route('admin.articles.create') }}" class="btn btn-alt-primary btn-rounded text-body-color-light bg-transparent"><i class="si si-plus"></i> Добавить статью</a>
                        @endif
                    </div>
                @endif
            @endauth
        </div>
        <div class="block-content bg-primary-dark">
            <table class="table table-stripped table-borderless table-vcenter">
                <tbody>
                @foreach($encyclopedias as $encyclopedia)
                    <tr>
                        <td class="text-center" style="width: 65px">
                            <i class="si si-notebook fa-2x"></i>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="">
                                    <a href="{{ route('encyclopedia.encyclopedia', $encyclopedia->slug) }}" class="font-size-h5 font-w600">{{ $encyclopedia->title }}</a>
                                    @if ($encyclopedia->description)
                                        <div class="text-muted my-5">{{ $encyclopedia->description }}</div>
                                    @endif
                                </div>
                                @if (auth()->user() and auth()->user()->hasRole('admin'))
                                    <a href="{{ route('admin.encyclopedia.edit', $encyclopedia->slug) }}" class="btn btn-sm btn-alt-primary btn-rounded bg-transparent text-body-color-light ml-10"><i class="fa fa-edit"></i> Редактировать</a>
                                    <form action="{{ route('admin.encyclopedia.destroy', $encyclopedia->slug) }}" method="post" class="ml-10">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('{{ __('Are you sure that you want delete this encyclopedia?') }}')" class="btn btn-sm btn-alt-danger btn-rounded bg-transparent text-body-color-light"><i class="fa fa-trash"></i> Удалить</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

