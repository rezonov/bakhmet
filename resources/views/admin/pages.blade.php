@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Список странимц</h1>
@stop

@section('content')

    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Страницы</h3>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-success" href="/admin/page/add">Добавить новую</a>
            </div>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <th>
                    Заголовок
                </th>
                <th>
                    url
                </th>
                <tbody>


                </tbody>
                @foreach ($tables as $tr)
                    <tr>
                        <td><a href="/admin/page/{{$tr->url}}">{{$tr->title}}</a>
                            @if($tr->url == 'index')
                                <span class="label pull-right bg-yellow">Главная</span>
                            @endif
                        </td>

                        <td>{{$tr->url}}</td>

                        <td>
                            <a class="btn btn-app button_edit">
                            <i class="fa fa-edit"></i>Редактировать
                            </a>
                        </td>
                    </tr>
                @endforeach


            </table>
        </div>
    </div>

@stop