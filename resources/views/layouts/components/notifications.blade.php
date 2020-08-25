<div class="btn-group" role="group">
    <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-notifications"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="si si-bell"></i>
        @if (Auth::user()->unreadNotifications->count() > 0)
            <span class="badge badge-primary badge-pill"
                  id="notifications-count">{{ Auth::user()->unreadNotifications->count() }}</span>
        @endif
    </button>
    <div class="dropdown-menu dropdown-menu-right min-width-300"
         aria-labelledby="page-header-notifications">
        <h5 class="h6 text-center py-5 mb-0 border-b text-uppercase">Оповещения</h5>
        @if (Auth::user()->notifications->count() > 0)
            <ul class="list-unstyled my-20">
                @foreach(Auth::user()->notifications as $notification)
                    <li>
                        @if (isset($notification->toArray()['data']['url']))
                            <a href="{{ $notification->toArray()['data']['url'] }}"
                               class="media mb-15 text-body-color-dark">
                                @if ($notification->type == 'App\\Notifications\\NewProfile')
                                    <div class="ml-5 mr-15">
                                        <i class="fa fa-fw fa-info text-info"></i>
                                    </div>
                                    <div class="media-body pr-10">
                                        <p class="mb-0"> Пользователь <span class="font-weight-bold">{{ $notification->toArray()['data']['user_nickname'] }}</span> создал анкету на персонажа <span class="font-weight-bold">{{ $notification->toArray()['data']['heroname'] }}</span>. Проверьте её!
                                        </p>
                                    </div>
                                @elseif ($notification->type == 'App\\Notifications\\NewProfileCorrection')
                                    <div class="ml-5 mr-15">
                                        <i class="fa fa-fw fa-warning text-warning"></i>
                                    </div>
                                    <div class="media-body pr-10">
                                        <p class="mb-0">Гейм мастер <span class="font-weight-bold">{{ $notification->toArray()['data']['game_master'] }}</span> оставил новое замечание к анкете вашего персонажа <span class="font-weight-bold">{{ $notification->toArray()['data']['hero_name'] }}</span></p>
                                    </div>
                                @elseif ($notification->type == 'App\\Notifications\\ProfileCorrectionCorrected')
                                    <div class="ml-5 mr-15">
                                        <i class="fa fa-fw fa-info-circle text-info"></i>
                                    </div>
                                    <div class="media-body pr-10">
                                        <p class="mb-0">Владелец персонажа <span class="font-weight-bold">{{ $notification->toArray()['data']['correction']['profile']['hero']['nickname'] }} ({{ $notification->toArray()['data']['correction']['profile']['hero']['user']['nickname'] }})</span> исправил ваше замечание</p>
                                    </div>
                                @endif
                            </a>
                        @elseif ($notification->type == 'App\\Notifications\\ProfileConfirmed')
                            <a href="#" class="media mb-15 text-body-color-dark">
                                <div class="ml-5 mr-15">
                                    <i class="fa fa-fw fa-check text-success"></i>
                                </div>
                                <div class="media-body pr-10">
                                    <p class="mb-0">Анкета вашего
                                        персонажа {{ $notification->toArray()['data']['profile']['hero']['nickname'] }}
                                        подтвержджена! Вы можете перейти к созданию ПДА.</p>
                                    <div class="text-muted font-size-sm font-italic">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </a>
                        @else
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
        @endif
    </div>
</div>
