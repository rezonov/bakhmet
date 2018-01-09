@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Все каталоги</h1>
@stop

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Каталог</h3>
        </div>
        <div class="col-md-12">

        </div>
        <div class="body">

                    <table id="example1" class="table table-bordered table-striped">
                        <tbody>
                        @foreach($fnames as $item)
                            <tr>
                                @if ($item->CN < 1)
                                    <th>{{$item->name}}</th>
                                @else
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/admin/catalog/{{$item->id}}">{{$item->name}}</a></td>
                                @endif
                                <td>{{$item->CN}}</td>
                                <td><a href="/admin/catalog/edit/{{$item->id}}">Редактировать</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>

                    </table>

        </div>
    </div>

@stop