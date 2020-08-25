@extends('layouts.place')

@section('title', $place->name)

@section('content')
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-header">
            @if (auth()->user() and auth()->user()->hasRole('admin'))
                <h3 class="block-title text-body-color-light font-w700">{{ $place->name }}</h3>
                <div class="block-options">
                    <a href="{{ route('admin.areas.create') }}" class="btn btn-alt-primary btn-rounded text-body-color-light bg-transparent"><i class="si si-plus"></i> Создать зону</a>
                    @if ($areas->count() > 0)
                        <a href="{{ route('admin.locations.create') }}" class="btn btn-alt-primary btn-rounded text-body-color-light bg-transparent"><i class="si si-plus"></i> Создать локацию</a>
                        <a href="{{ route('admin.places.create') }}" class="btn btn-alt-primary btn-rounded text-body-color-light bg-transparent"><i class="si si-plus"></i> Создать место</a>
                    @endif
                </div>
            @else
                <h3 class="block-title text-body-color-light font-w700 text-center">{{ $place->name }}</h3>
            @endif
        </div>
        <div class="block-content bg-primary-dark">
            @if ($place->hasImage())
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ $place->getImage() }}" alt="{{ $place->name }}" class="img-fluid-100">
                </div>
            @endif
            <h3 class="content-heading @if (!$place->hasImage()) pt-0 @endif text-body-color-light text-center">@if ($place->hasImage()) Описание @else {{ $place->name }} @endif</h3>
            <p class="place-description text-body-color-light">
                {!! $place->description !!}
            </p>
        </div>
    </div>
    <section class="place-posts">
        @foreach($posts as $post)
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
        @endforeach
    </section>
    <div class="d-flex justify-content-end">
        {{ $posts->links() }}
    </div>
    <section class="make-post">
        <form action="{{ route('post.create') }}" method="post">
            @csrf
            <input type="hidden" name="area_id" value="{{ $area->id }}">
            <input type="hidden" name="location_id" value="{{ $location->id }}">
            <input type="hidden" name="place_id" value="{{ $place->id }}">
            <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
                <div class="block-header">
                    <h3 class="block-title text-body-color-light font-w700">Оставить пост</h3>
                    <div class="block-options">
                        <button class="btn btn-alt-success btn-rounded"><i class="si si-check"></i> Опубликовать</button>
                    </div>
                </div>
                <div class="block-content bg-primary-dark">
                    @auth
                        @if (auth()->user()->hasHeroes())
                            <div class="form-group">
                                <div class="form-material form-material-primary floating">
                                    <select name="hero_id" id="hero_id"
                                            class="form-control text-body-color-light">
                                        @foreach(auth()->user()->heroes as $hero)
                                            <option value="{{ $hero->id }}">{{ $hero->getName() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-material form-material-primary floating">
                                    <textarea name="content" id="js-ckeditor">{!! old('content') !!}</textarea>
                                </div>
                            </div>
                        @else
                            <p class="text-warning text-center font-size-h5 font-weight-bold">У вас нет ни одного персонажа.</p>
                            <div class="d-flex justify-content-center mb-20"><a href="{{ route('hero.create') }}"
                                                                          class="btn btn-alt-primary"><i class="si si-plus"></i> Создать персонажа</a></div>
                        @endif
                    @else
                    @endauth
                </div>
            </div>
        </form>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        jQuery(function(){
            // Init full text editor
            if (jQuery('#js-ckeditor:not(.js-ckeditor-enabled)').length) {

                CKEDITOR.replace('js-ckeditor', {
                    toolbar: [
                        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                        { name: 'editing', groups: [ 'find', 'selection' ], items: [ 'Find', 'Replace', '-', 'SelectAll' ] },
                        '/',
                        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                        { name: 'paragraph', groups: [ 'list', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley' ] },
                        '/',
                        { name: 'styles', items: ['Format', 'FontSize' ] },
                        { name: 'colors', items: [ 'TextColor' ] },
                        { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
                        { name: 'others', items: [ '-' ] },
                        { name: 'about', items: [ 'About' ] }
                    ],
                    language: 'ru',
                    // Adding drag and drop image upload.
                    extraPlugins: 'print,format,font,colorbutton,justify,uploadimage',
                    // Configure your file manager integration. This example uses CKFinder 3 for PHP.
                    filebrowserUploadUrl: '/ckfinder/upload/image',
                    removeDialogTabs: 'image:advanced;link:advanced,image:Link'
                });

                // Add .js-ckeditor-enabled class to tag it as activated
                jQuery('#js-ckeditor').addClass('js-ckeditor-enabled');
            }
        });
    </script>
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
