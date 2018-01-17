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
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>PARENT</th>
                            <th>CIN</th>
                            <th>COUT</th>
                        </tr>
                        @foreach($fnames as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                @if ($item->level == 0)
                                    <td>{{$item->name}}</td>
                                @elseif ($item->level == 1)
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/admin/catalog/{{$item->id}}">{{$item->name}}</a></td>
                                @else
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/admin/catalog/{{$item->id}}">{{$item->name}}</a></td>
                                @endif
                                    <td>{{$item->parent}}</td>
                                <td>{{$item->CIn}}</td>
                                    <td>{{$item->COut}}</td>
                                <td><a href="/admin/catalog/edit/{{$item->id}}">Редактировать</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>

                    </table>

        </div>
    </div>

@stop