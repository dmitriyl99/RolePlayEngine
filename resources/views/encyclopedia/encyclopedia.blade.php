@extends('layouts.place')

@section('title', "{$encyclopedia->title} Энциклопедия")

@section('content')
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-header">
            <h3 class="block-title text-body-color-light font-w700 text-center">Энциклопедия "{{ $encyclopedia->title }}"</h3>
            @auth
                @if (auth()->user()->hasRole('admin'))
                    <div class="block-options">
                        <a href="{{ route('admin.encyclopedia.create') }}" class="btn btn-alt-primary btn-rounded text-body-color-light bg-transparent"><i class="si si-plus"></i> Добавить раздел</a>
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-alt-primary btn-rounded text-body-color-light bg-transparent"><i class="si si-plus"></i> Добавить статью</a>
                    </div>
                @endif
            @endauth
        </div>
        <div class="block-content bg-primary-dark">
            @if ($encyclopedia->hasImage())
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ $encyclopedia->getImage() }}" alt="{{ $encyclopedia->title }}" class="img-fluid-100 place-image">
                </div>
            @endif
            <h3 class="content-heading @if (!$encyclopedia->hasImage()) pt-0 @endif text-body-color-light text-center">{{ $encyclopedia->title }}</h3>
            <p class="place-description text-body-color-light">
                {!! $encyclopedia->full_description !!}
            </p>
        </div>
    </div>
    <section class="encyclopedia-articles">
        @foreach($encyclopedia->articles as $article)
            <article id="article{{ $article->id }}"
                     class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn"
                     data-toggle="appear">
                <div class="block-content bg-primary-dark">
                    <div class="row pb-50">
                        <div class="col-md-2">
                            <div class="d-flex flex-column justify-content-center align-items-center post-hero-info">
                                <div class="post-hero-image mt-10">
                                    <img
                                        src="@if ($article->hasImage()) {{ $article->getImage() }} @else {{ asset('assets/img/avatars/avatar0.jpg') }} @endif"
                                        class="img-avatar-square img-avatar128" alt="{{ $article->title }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="post-date text-body-color-light d-flex justify-content-end">
                                @auth
                                    <div class="d-flex align-items-center">
                                        @if (auth()->user()->hasRole(App\Role::ADMIN) || auth()->user()->hasRole(App\Role::GAME_MASTER))
                                            <a href="{{ route('admin.articles.edit', $article->slug) }}"
                                               class="btn btn-sm btn-alt-warning" data-toggle="tooltip"
                                               title="Редактировать пост"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if (auth()->user()->hasRole(App\Role::ADMIN))
                                            <form action="{{ route('admin.articles.destroy', $article->slug) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                        onclick="return confirm('Вы уверены, что хотите удалить эту статью?')"
                                                        class="btn btn-sm btn-alt-danger ml-10" data-toggle="tooltip"
                                                        title="Удалить пост"><i class="fa fa-trash"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                @endauth
                            </div>
                            <div class="post-content">
                                <div class="text-primary text-center font-weight-bold">{{ $article->title }}</div>
                                <p>{!! $article->content !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
    </section>
@endsection

