@extends('layouts.place')

@section('title', 'Личные сообщения')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/jquery-auto-complete/jquery.auto-complete.min.css') }}">
@endsection

@section('content')
    <div class="block block-rounded text-body-color-light bg-primary-dark-op js-appear-enabled animated fadeInLeft" data-toggle="appear">
        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
            <li class="nav-item">
                <a href="#incoming" class="nav-link @if (!session()->get('sendMessageTab')) active @endif">Входящие ({{ $incomingMessages->count() }})</a>
            </li>
            <li class="nav-item">
                <a href="#outgoing" class="nav-link @if (session()->get('sendMessageTab') == 'outgoing') active @endif">Исходящие ({{ $outgoingMessages->count() }})</a>
            </li>
            <li class="nav-item ml-auto">
                <a href="#write" class="nav-link @if (session()->get('sendMessageTab') == 'write') active @endif"><i class="si si-envelope-letter"></i> Написать</a>
            </li>
        </ul>
        <div class="block-content tab-content">
            <div class="tab-pane @if (!session()->get('sendMessageTab')) active @endif" id="incoming" role="tabpanel">
                @if ($incomingMessages->count() > 0)
                    @foreach($incomingMessages as $message)
                        <div class="py-20 d-flex justify-content-between px-20">
                            <a href="{{ route('messages.show', $message->id) }}" class="message-title text-body-color-light link-effect">@if ($message->read) <span class="text-success" data-toggle="tooltip" title="Прочитано"><i class="si si-check mr-5"></i></span> @endif{{ $message->title }} (От кого: {{ $message->fromUser->nickname }})</a>
                            <span class="js-utc-to-local">{{ $message->created_at }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="py-30 text-center">
                        <i class="si si-ghost text-primary display-3"></i>
                        <p class="mt-20 font-size-h5">Нет ни одного входящего сообщения</p>
                    </div>
                @endif
            </div>
            <div class="tab-pane @if (session()->get('sendMessageTab') == 'outgoing') active @endif" id="outgoing" role="tabpanel">
                @if ($outgoingMessages->count() > 0)
                    @foreach($outgoingMessages as $message)
                        <div class="py-20 d-flex justify-content-between px-20">
                            <a href="{{ route('messages.show', $message->id) }}" class="message-title text-body-color-light link-effect">{{ $message->title }} (Кому: {{ $message->toUser->nickname }})</a>
                            <span class="js-utc-to-local">{{ $message->created_at }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="py-30 text-center">
                        <i class="si si-ghost text-primary display-3"></i>
                        <p class="mt-20 font-size-h5">Нет ни одного исходящего сообщения</p>
                    </div>
                @endif
            </div>
            <div class="tab-pane @if (session()->pull('sendMessageTab') == 'write') active @endif" id="write" role="tabpanel">
                <form action="{{ route('messages.store') }}" method="post" class="mb-30">
                    @csrf
                    <div class="form-group @error('nickname') is-invalid @enderror">
                        <div class="form-material form-material-primary floating">
                            <input type="text" name="nickname" id="nickname" class="form-control js-autocomplete" autocomplete="off">
                            <label for="nickname">Кому (укажите ник):</label>
                        </div>
                        @error('nickname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group @error('title') is-invalid @enderror">
                        <div class="form-material form-material-primary floating">
                            <input type="text" name="title" id="title" class="form-control" autocomplete="off">
                            <label for="title">Тема</label>
                        </div>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group @error('content') is-invalid @enderror">
                        <div class="form-material form-material-primary">
                            <textarea name="content" id="js-ckeditor"></textarea>
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
            </div>
        </div>
    </div>
    <ul class="d-none">
        @foreach($users as $user)
            <li class="user-nickname">{{ $user->nickname }}</li>
        @endforeach
    </ul>
@endsection

@section('js')
    <script src="{{ asset('assets/js/plugins/jquery-auto-complete/jquery.auto-complete.min.js') }}"></script>
    <script>
        let users = [];
        $('li.user-nickname').toArray().forEach(function(item) {
            users.push(item.innerHTML)
        });
        jQuery('.js-autocomplete').autoComplete({
            minChars: 1,
            source: function (term, suggest) {
                term = term.toLowerCase();
                let suggestions = [];
                for (let i = 0; i < users.length; i++) {
                    if (~ users[i].toLowerCase().indexOf(term)) suggestions.push(users[i]);
                }
                suggest(suggestions);
            }
        })
    </script>
@endsection
