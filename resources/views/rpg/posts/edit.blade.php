@extends('layouts.place')

@section('title', 'Редактировать пост')

@section('content')
    <h2 class="content-heading">Редактировать пост</h2>
    <article id="post{{ $post->id }}" class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-content bg-primary-dark">
            <div class="row pb-50">
                <div class="col-md-2">
                    <div class="d-flex flex-column justify-content-center align-items-center post-hero-info">
                        <div class="post-hero-name">
                            <div class="text-primary text-center font-weight-bold"><a href="#" class="link-effect">{{ $post->hero->getName() }}</a> <small><a
                                        href="#" class="link-effect">({{ $post->user->nickname }})</a></small></div>
                        </div>
                        <div class="post-hero-image mt-10">
                            <img src="@if ($post->user->hasImage()) {{ $post->user->getImage() }} @else {{ asset('assets/img/avatars/avatar0.jpg') }} @endif" class="img-avatar img-avatar128" alt="{{ $post->user->nickname }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="post-date text-body-color-light">
                        <span class="js-utc-to-local">{{ $post->created_at }}</span>
                    </div>
                    <div class="post-content">
                        <p>{!! $post->content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <form action="{{ route('post.update', $post->id) }}" method="post">
        @csrf
        @method('put')
        <input type="hidden" name="redirect_url" value="{{ $redirect_url }}">
        <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="block-header">
                <h3 class="block-title text-body-color-light">Редактировать пост</h3>
            </div>
            <div class="block-content bg-primary-dark">
                <div class="form-group @error('content') is-invalid @enderror">
                    <textarea name="content" id="js-ckeditor">{!! $post->content !!}</textarea>
                </div>
                <div class="d-flex justify-content-end my-20">
                    <button type="submit" class="btn btn-alt-success"><i class="si si-check"></i> Сохранить</button>
                </div>
            </div>
        </div>
    </form>
@endsection
