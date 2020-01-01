@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-header">
            <h3 class="block-title text-body-color-light font-w700 text-center">Информация</h3>
        </div>
        <div class="block-content bg-primary-dark">
            <table class="table table-stripped table-borderless table-vcenter">
                <tbody>
                    <tr>
                        <td class="text-center" style="width: 65px">
                            <i class="si si-book-open fa-2x"></i>
                        </td>
                        <td>
                            <a href="#" class="font-size-h5 font-w600">Данные</a>
                            <div class="text-muted my-5">Здесь хранятся данные как о тех, кто уже давно пересёк Периметр, так и о тех, кто ещё только собирается испытать свою судьбу.</div>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">
                                от <a href="">Нулевой</a>
                                <br>
                                <em><span class="font-w600">23:08</span> | 20.12.2019</em>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="width: 65px">
                            <i class="si si-users fa-2x"></i>
                        </td>
                        <td>
                            <a href="#" class="font-size-h5 font-w600">Живые сталкеры</a>
                            <div class="text-muted my-5">Список сталкеров, которым до сих пор счастливится коптить небо Зоны</div>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">
                                от <a href="">Нулевой</a>
                                <br>
                                <em><span class="font-w600">23:08</span> | 20.12.2019</em>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="block block-rounded text-body-color-light mt-20 bg-primary-dark-op js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="block-header">
            <h3 class="block-title text-body-color-light font-w700 text-center">S.T.A.L.K.E.R. Underground</h3>
        </div>
        <div class="block-content bg-primary-dark">

        </div>
    </div>
@endsection
