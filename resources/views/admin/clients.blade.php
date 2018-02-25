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

                @foreach($fnames as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->CREATED_AT}}</td>
                        <td><a href="/admin/clients/show/{{$item->id}}">Посмотреть</a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot></tfoot>
            </table>

        </div>
    </div>

@stop