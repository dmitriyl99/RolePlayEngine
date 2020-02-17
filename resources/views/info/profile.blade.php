@extends('layouts.app')

@section('title')
    Анкета {{ $profile->hero->getName() }}
@endsection

@section('content')
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-header">
            <h3 class="block-title text-body-color-light text-center">Анкета персонажа <span class="text-primary font-w700">{{ $profile->hero->getName() }}</span> <small class="text-muted">(владелец:
                    <a href="{{ route('profile.show', $profile->hero->user->id) }}">{{ $profile->hero->user->nickname }}</a>)</small></h3>
            @if (Auth::user() && Auth::user()->hasRole('game_master'))
                <div class="block-options">
                    <form action="{{ route('profiles.confirm', $profile->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn-option text-body-color-light bg-transparent" style="border: none;"><i class="fa fa-check mr-10"></i>Принять</button>
                    </form>
                </div>
            @endif
        </div>
        <div class="block-content bg-primary-dark profile-content pb-20">
            {!! $profile->content !!}
        </div>
    </div>
@endsection
