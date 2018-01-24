@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{$Gname}}</h1>
@stop

@section('content')
    {!! Form::open([
                          'action' => 'GoodsController@SaveAttr',
                          'method' => 'post'
                          ]) !!}
    <div class="box">

        <div class="box-body">
            <h3 class="box-title">Каталог</h3>

            <div class="box-body">
                <select>
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
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Аттрибуты</h3>
                </div>


                <div class="box-body">
                    <div class="row">

                        <input type="hidden" name="id" value="{{$id}}"/>
                        @foreach ($attrs as $item)
                            <div class="col-xs-3">
                                <label>{{$item->name}}</label>
                                <input class="form-control" type="text" name="Val[{{$item->id}}]"
                                       value="{{$item->value}}" placeholder="Default input">
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <br/>
                                <input type="submit" value="Сохранить" class="btn btn-success"/>

                            </div>
                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>
    <div class="box">
        <div class="box-header">
            <div class="row">
                <div class="col-md-12">


                </div>
            </div>
            <h3 class="box-title">Описание</h3>
        </div>
        <div class="box-body">
            <div class="col-md-12">

                <textarea id="editor1" name="text">{{$Descriptions[0]->text}}</textarea>
                <div class="row">
                    <div class="col-sm-12">
                        <div>
                            <br/>
                            <p><input type="submit" value="Сохранить" class="btn btn-success"/></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">SEO часть</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <label>Title страницы</label>
                    <input class="form-control" type="text" name="seotitle"
                    @if(!empty($Seo[0]) && !empty($Seo[0]->title))
                    value=" {{$Seo[0]->title}}"
                           @endif
                            placeholder="Введите Title">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Ключевые слова</label>
                    <input class="form-control" type="text" name="seokeywords"
                           @if(!empty($Seo[0]) && !empty($Seo[0]->keywords))
                           value=" {{$Seo[0]->keywords}}"
                           @endif
                           placeholder="Введите ключевые слова">
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Описание страницы</label>
                    <input class="form-control" type="text" name="seodescriptions"
                           @if(!empty($Seo[0]) && !empty($Seo[0]->keywords))
                           value=" {{$Seo[0]->descriptions}}"
                           @endif
                           placeholder="Введите Описание">
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 align-right">
                    <input type="submit" class="btn btn-success" value="Сохранить">

                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Изображение</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Текущее изображение</h3>
                        </div>
                        <div class="box-body">


                            <img width="250px" src="/img/{{$Descriptions[0]->file}}"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Новое изображение</h3>
                        </div>
                        <div class="box-body">

                            <div id="container_image"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 align-right">
                    <input type="submit" class="btn btn-success" value="Сохранить">
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="">

    </div>
    <script>
        $(function () {
            $("#container_image").PictureCut({
                InputOfImageDirectory: "image",
                ImageButtonCSS: {
                    border: "1px #CCC solid",
                    width: 500,
                    height: 300
                },

                PluginFolderOnServer: "/js/jQuery-Picture-Cut/",
                FolderOnServer: "/img/",

                CropWindowStyle: "Bootstrap",
                UploadedCallback: function (data) {
                    console.log(data);
                }
            });
        });
    </script>
@stop