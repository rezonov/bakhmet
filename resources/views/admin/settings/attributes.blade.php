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
<table id="allcatalog" class="table">
    @foreach($table as $tr)
        <tr>

            @foreach($tr as $td)
                <td>{{$td}}</td>
            @endforeach
        </tr>
    @endforeach
</table>
        </div>
    @stop