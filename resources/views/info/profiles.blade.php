@extends('layouts.app')

@section('title', 'Данные')

@section('content')
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-header">
            <h3 class="block-title text-body-color-light font-w700 text-center">Принятые анкеты</h3>
        </div>
        <div class="block-content bg-primary-dark">
            @if (count($confirmedProfiles) > 0)
                <table class="table table-stripped table-borderless table-vcenter">
                    <tbody>
                        @foreach($confirmedProfiles as $profile)
                            <tr>
                                <td class="text-center" style="width: 65px">
                                    <i class="si si-book-open fa-2x"></i>
                                </td>
                                <td>
                                    <a href="#" class="font-size-h5 font-w600">{{ $profile->hero->getName() }}</a>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <span class="font-size-sm">
                                        <a href="{{ route('profile.show', $profile->hero->user->id) }}">{{ $profile->hero->user->nickname }}</a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="py-30 text-center">
                    <i class="si si-ghost text-primary display-3"></i>
                    <p class="mt-20 font-size-h5">Нет ещё ни одной принятной анкеты</p>
                </div>
            @endif
        </div>
    </div>
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-header">
            <h3 class="block-title text-body-color-light font-w700 text-center">Анкеты на проверке</h3>
        </div>
        <div class="block-content bg-primary-dark">
            @if (count($nonConfirmedProfiles) > 0)
                <table class="table table-stripped table-borderless table-vcenter">
                    <tbody>
                    @foreach($nonConfirmedProfiles as $profile)
                        <tr>
                            <td class="text-center" style="width: 65px">
                                <i class="si si-book-open fa-2x"></i>
                            </td>
                            <td>
                                <a href="{{ route('profiles.show', $profile->id) }}" class="font-size-h5 font-w600">{{ $profile->hero->getName() }}</a>
                            </td>
                            <td class="d-none d-md-table-cell" style="width: 108.8px">
                                <span class="font-size-sm">
                                    <a href="{{ route('profile.show', $profile->hero->user->id) }}">{{ $profile->hero->user->nickname }}</a>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="py-30 text-center">
                    <i class="si si-ghost text-primary display-3"></i>
                    <p class="mt-20 font-size-h5">Нет ещё ни одной непринятой анкеты</p>
                </div>
            @endif
        </div>
    </div>
@endsection
