@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Список странимц</h1>
@stop

@section('content')

    <div class="box">

        <div class="box-header">
            <h3 class="box-title">{{$tables->title or 'Добавить новую страницу'}}</h3>
        </div>
        <div class="box-body">
            {!! Form::open([
                                    'action' => 'PagesController@SavePage',
                                    'method' => 'post'
                                    ]) !!}
            <label>Заголовок</label>
            <input class="form-control" type="text" name="title"
                   value="{{$tables->title or ''}}" placeholder="Введите заголовок">

            <label>Описание страницы (200 символов)</label>
            <input class="form-control" type="text" name="descriptions"
                   value="{{$tables->description or ''}}" placeholder="Введите описание">

            <label>Ключевые слова</label>
            <input class="form-control" type="text" name="keywords"
                   value="{{$tables->keywords or ''}}" placeholder="Введите ключевые слова">

            <label>URL</label>
            <input class="form-control" type="text" name="url"
                   value="{{$tables->url or ''}}" placeholder="Введите url">
            <label>Контент</label>

            <textarea id="editor1" name="text">{{$tables->content or ''}}</textarea>

            <input type="hidden" name="id" value="{{ $tables->id or '0' }}"/>
            <input type="submit" class="btn btn-success" value="Сохранить">
            {!! Form::close() !!}
        </div>
    </div>
    </div>

@stop