@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Список странимц</h1>
@stop

@section('content')

    <div class="box">

        <div class="box-header">
            <h3 class="box-title">{{$tables->name}}</h3>
        </div>
        <div class="box-body">
            {!! Form::open([
                                    'action' => 'PagesController@SavePage',
                                    'method' => 'post'
                                    ]) !!}
            <label>Заголовок</label>
            <input class="form-control" type="text" name="title"
                   value="{{$tables->title}}" placeholder="Default input">

            <label>Описание страницы (200 символов)</label>
            <input class="form-control" type="text" name="descriptions"
                   value="{{$tables->description}}" placeholder="Default input">

            <label>Ключевые слова</label>
            <input class="form-control" type="text" name="keywords"
                   value="{{$tables->keywords}}" placeholder="Default input">

            <label>URL</label>
            <input class="form-control" type="text" name="url"
                   value="{{$tables->url}}" placeholder="Default input">
            <label>Контент</label>

            <textarea id="editor1" name="text">{{$tables->content}}</textarea>

            <input type="hidden" name="id" value="{{ $tables->id }}"/>
            <input type="submit" class="btn btn-success" value="Сохранить">
            {!! Form::close() !!}
        </div>
    </div>
    </div>

@stop