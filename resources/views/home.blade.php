@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Аттрибуты</h1>
@stop

@section('content')
    @foreach ($names as $item)
        <p>{{$item->name}} {{$item->Gname}}  {{$item->value}}</p>
    @endforeach
@stop