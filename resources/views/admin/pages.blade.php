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
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <tbody>


                </tbody>
            @foreach ($tables as $tr)
                    <tr>
                        <td><a href="/admin/page/{{$tr->url}}">{{$tr->name}}</a></td>
                        <td>{{$tr->title}}</td>
                        <td>{{$tr->url}}</td>
                        <td>{{$tr->description}}</td>

                    </tr>
                @endforeach


            </table>
        </div>
    </div>

@stop