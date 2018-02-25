@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Все заявки</h1>
@stop

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Заявки</h3>
        </div>

        <div class="body">

            <table id="example1" class="table table-bordered table-striped">
                <tbody>


                    <tr>
                        <td>Имя</td>

                        <td>{{$item->name}}</td>
                    </tr>
                    <tr>
                        <td>Телефон</td>
                        <td>{{$item->phone}}</td>
                    </tr>
                    <tr>

                        <td>Email</td>

                        <td>{{$item->email}}</td>
                    </tr>
                    <tr>
                        <td>Дата заявки</td>
                        <td>{{$item->CREATED_AT}}</td>

                    </tr>
                <tr>
                    <td colspan="2"><b>Текст сообщения</b><br />{{$item->message}}</td>

                </tr>


                </tbody>
                <tfoot>

            </table>

        </div>
    </div>

@stop