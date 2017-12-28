@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{$Gname}}</h1>
@stop

@section('content')
    <div class="box">

        <div class="box-body">
            <h3 class="box-title">Каталог</h3>

            <div class="box-body">
                <select multiple style="height:250px">
                    @foreach($AllCatalog as $AC)
                        <option id="{{$AC->id}}">
                            @if($AC->parent > 10)
                                &nbsp;&nbsp;&nbsp;
                            @endif
                            {{$AC->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Аттрибуты</h3>
        </div>


        <div class="box-body">

            {!! Form::open([
                'action' => 'GoodsController@SaveAttr',
                'method' => 'post'
                ]) !!}
            <input type="hidden" name="id" value="{{$id}}" />
            @foreach ($attrs as $item)
                <div class="col-xs-3">
                    <label>{{$item->name}}</label>
                    <input class="form-control" type="text" name="Val[{{$item->id}}]" value="{{$item->value}}"
                           placeholder="Default input">
                </div>
            @endforeach
            <input type="submit" value="Сохранить" class="btn btn-success"/>
            {!! Form::close() !!}

        </div>


    </div>
@stop