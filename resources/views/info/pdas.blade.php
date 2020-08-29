@extends('layouts.app')

@section('title', 'Живые сталкеры')

@section('content')
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-header">
            <h3 class="block-title text-body-color-light font-w700 text-center">Живые сталкеры</h3>
        </div>
        <div class="block-content bg-primary-dark">
            @if ($pdas->count() > 0)
                <table class="table table-stripped table-borderless table-vcenter">
                    <tbody>
                        @foreach($pdas as $pda)
                            <tr>
                                <td class="text-center" style="width: 65px">
                                    <i class="si si-user fa-2x"></i>
                                </td>
                                <td>
                                    <a href="{{ route('hero.pda.show', $pda->id) }}" class="font-size-h5 font-w600">{{ $pda->hero->getName() }}</a>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <span class="font-size-sm">
                                        <a href="{{ route('profile.show', $profile->hero->user->id) }}">{{ $pda->user->nickname }}</a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="py-30 text-center">
                    <i class="si si-ghost text-primary display-3"></i>
                    <p class="mt-20 font-size-h5">Нет ни одного живого сталкера в Зоне</p>
                </div>
            @endif
        </div>
    </div>
@endsection
