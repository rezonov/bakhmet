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
            <div class="row">
                <div class="col-md-12">
                    <form id="fileupload" action="https://jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
                        <!-- Redirect browsers with JavaScript disabled to the origin page -->
                        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                        <div class="row fileupload-buttonbar">
                            <div class="col-lg-7">
                                <!-- The fileinput-button span is used to style the file input field as button -->
                                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Добавить файлы</span>
                    <input type="file" name="files[]" multiple>
                </span>
                                <button type="submit" class="btn btn-primary start">
                                    <i class="glyphicon glyphicon-upload"></i>
                                    <span>Загрузить все</span>
                                </button>
                                <button type="reset" class="btn btn-warning cancel">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span>Отменить</span>
                                </button>
                                <button type="button" class="btn btn-danger delete">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    <span>Удалить</span>
                                </button>
                                <input type="checkbox" class="toggle">
                                <!-- The global file processing state -->
                                <span class="fileupload-process"></span>
                            </div>
                            <!-- The global progress state -->
                            <div class="col-lg-5 fileupload-progress fade">
                                <!-- The global progress bar -->
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                </div>
                                <!-- The extended global progress state -->
                                <div class="progress-extended">&nbsp;</div>
                            </div>
                        </div>
                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                    </form>
                    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                        <div class="slides"></div>
                        <h3 class="title"></h3>
                        <a class="prev">‹</a>
                        <a class="next">›</a>
                        <a class="close">×</a>
                        <a class="play-pause"></a>
                        <ol class="indicator"></ol>
                    </div>
                    <!-- The template to display files available for upload -->
                    <script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
                    <script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
                    <div id="result"></div>
                </div>
            </div>
        </div>
    </div>
                    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
                    <script src="/js/js/vendor/jquery.ui.widget.js"></script>
                    <script src="/js/js/jquery.iframe-transport.js"></script>
                    <script src="/js/js/jquery.fileupload.js"></script>

                    <!-- The Templates plugin is included to render the upload/download listings -->
                    <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
                    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
                    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
                    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
                    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
                    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                    <!-- blueimp Gallery script -->
                    <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
                    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
                    <script src="/js/js/jquery.iframe-transport.js"></script>
                    <!-- The basic File Upload plugin -->
                    <script src="/js/js/jquery.fileupload.js"></script>
                    <!-- The File Upload processing plugin -->
                    <script src="/js/js/jquery.fileupload-process.js"></script>
                    <!-- The File Upload image preview & resize plugin -->
                    <script src="/js/js/jquery.fileupload-image.js"></script>
                    <!-- The File Upload audio preview plugin -->
                    <script src="/js/js/jquery.fileupload-audio.js"></script>
                    <!-- The File Upload video preview plugin -->
                    <script src="/js/js/jquery.fileupload-video.js"></script>
                    <!-- The File Upload validation plugin -->
                    <script src="/js/js/jquery.fileupload-validate.js"></script>
                    <!-- The File Upload user interface plugin -->
                    <script src="/js/js/jquery.fileupload-ui.js"></script>
                    <!-- The main application script -->
                    <script src="/js/js/main.js"></script>


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