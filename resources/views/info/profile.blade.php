@extends('layouts.app')

@section('title')
    Анкета {{ $profile->hero->getName() }}
@endsection

@section('content')
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn"
         data-toggle="appear">
        <div class="block-header">
            <h3 class="block-title text-body-color-light">Анкета персонажа <span
                    class="text-primary font-w700">{{ $profile->hero->getName() }}</span> <small class="text-muted">(владелец:
                    <a href="{{ route('profile.show', $profile->hero->user->id) }}">{{ $profile->hero->user->nickname }}</a>)</small>
            </h3>
            <div class="block-options">
                @auth
                    @if (auth()->user()->hasRole(App\Role::GAME_MASTER) && !$profile->confirmed)
                        <form action="{{ route('profiles.confirm', $profile->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-alt-success btn-rounded" style="border: none;"><i
                                    class="fa fa-check mr-10"></i>Принять
                            </button>
                        </form>
                    @endif
                    @if (auth()->user()->id == $profile->hero->user_id && !$profile->confirmed)
                        <a href="{{ route('hero.edit', $profile->hero_id) }}" class="btn btn-alt-warning btn-rounded"><i
                                class="fa fa-edit"></i> Редактировать</a>
                    @endif
                    @if (!$profile->hero->pda && auth()->user()->id == $profile->hero->user_id && $profile->confirmed)
                        <a href="{{ route('hero.pda.create', $profile->hero_id) }}" class="btn btn-alt-primary btn-rounded"><i class="si si-plus"></i> Создать КПК</a>
                    @endif
                @endauth
                @if ($profile->hero->pda)
                    <a href="{{ route('hero.pda.show', $profile->hero->id) }}" class="btn btn-alt-primary btn-rounded"><i class="si si-plus"></i> Открыть КПК</a>
                @endif
            </div>
        </div>
        <div class="block-content bg-primary-dark profile-content pb-20">
            {!! $profile->content !!}
        </div>
    </div>

    <h2 class="content-heading text-body-color-light">Замечания</h2>
    @if ($profile->corrections()->exists())
        @foreach($profile->corrections as $correction)
            <article id="correction{{ $correction->id }}"
                     class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn"
                     data-toggle="appear">
                <div class="block-content bg-primary-dark">
                    <div class="row pb-50">
                        <div class="col-md-2">
                            <div class="d-flex flex-column justify-content-center align-items-center post-hero-info">
                                <div class="post-hero-name">
                                    <div class="text-primary text-center font-weight-bold"><a
                                            href="{{ route('profile.show', $correction->owner->slug) }}"
                                            class="link-effect">{{ $correction->owner->nickname }}</a></div>
                                </div>
                                <div class="post-hero-image mt-10">
                                    <img
                                        src="@if ($correction->owner->hasImage()) {{ $correction->owner->getImage() }} @else {{ asset('assets/img/avatars/avatar0.jpg') }} @endif"
                                        class="img-avatar img-avatar128" alt="{{ $correction->owner->nickname }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="post-date text-body-color-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="js-utc-to-local">{{ $correction->created_at }}</span>
                                        @if ($correction->corrected)
                                            <span class="text-success"><i class="si si-check"></i> Исправлено</span>
                                        @endif
                                    </div>
                                    @auth
                                        @if ($profile->hero->user_id == auth()->user()->id && !$correction->corrected)
                                            <form action="{{ route('profiles.correction.correct', $correction->id) }}"
                                                  method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-alt-success"><i
                                                        class="si si-check"></i> Исправлено
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <div class="post-content">
                                <p>{!! $correction->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
    @else
        <div class="d-flex justify-content-center align-items-center flex-column text-success">
            <i class="fa-5x si si-check"></i>
            <span class="mt-20 mb-20 font-weight-bold font-size-h4">Никаких замечаний нет (пока что)</span>
        </div>
    @endif
    @auth
        @if (auth()->user()->hasRole(\App\Role::GAME_MASTER))
            <h2 class="content-heading text-body-color-light">Оставить замечание</h2>
            <form action="{{ route('profiles.correction', $profile->id) }}" method="post">
                @csrf
                <textarea name="content" id="js-ckeditor"></textarea>
                <div class="d-flex justify-content-end mt-20 mb-20">
                    <button type="submit" class="btn btn-alt-success btn-rounded"><i class="si si-check"></i> Сохранить
                    </button>
                </div>
            </form>
        @endif
    @endauth
@endsection
