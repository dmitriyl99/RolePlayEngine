@extends('layouts.admin')

@section('title', 'Личные сообщения')

@section('content')
    <div class="block block-rounded text-body-color-light bg-primary-dark-op js-appear-enabled animated fadeInLeft" data-toggle="appear">
        <div class="block-header">
            <h3 class="block-title text-body-color-light">{{ $message->title }}</h3>
        </div>
        <div class="block-content bg-primary-dark" id="message-content">
            <h2 class="content-heading pt-0">Адрес:</h2>
            <p>От кого: <span class="text-primary">{{ $message->fromUser->nickname }}</span></p>
            <p>Кому: <span class="text-primary">{{ $message->toUser->nickname }}</span></p>
            <h2 class="content-heading pt-0">Содержание</h2>
            <p>
                {!! $message->content !!}
            </p>
            @if (auth()->id() == $message->to_user_id)
                <button class="btn btn-alt-primary btn-rounded mb-20" id="write-reply-button"><i class="si si-envelope"></i> Написать ответ</button>
                <template id="write-template">
                    <h2 class="content-heading">Написать ответ</h2>
                    <form action="{{ route('messages.store') }}" method="post" class="pb-30">
                        @csrf
                        <input type="hidden" name="nickname" value="{{ $message->fromUser->nickname }}">
                        <p>Кому: <span class="text-primary">{{ $message->fromUser->nickname }}</span></p>
                        <div class="form-group @error('title') is-invalid @enderror">
                            <div class="form-material form-material-primary floating">
                                <input type="text" name="title" id="title" class="form-control" value="Re: {{ $message->title }}">
                                <label for="title">Тема</label>
                            </div>
                        </div>
                        <div class="form-group @error('content') is-invalid @enderror">
                            <div class="form-material form-material-primary">
                                <textarea name="content" id="js-ckeditor">Ответ на письмо: {{ $message->title }}</textarea>
                                <label for="js-ckeditor">Содержание письма</label>
                            </div>
                            @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-alt-success btn-rounded">
                                <i class="si si-envelope-letter"></i> Отправить
                            </button>
                        </div>
                    </form>
                </template>
            @endif
        </div>
    </div>

@endsection

@section('js')
    <script>
        jQuery('#write-reply-button').on('click', function () {
            $(this).remove();
            let html = $('#write-template').html();
            html = $(html);
            $('#message-content').append(html);
            initCkeditor();
        })
    </script>
@endsection
