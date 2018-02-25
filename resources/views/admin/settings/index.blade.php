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

                @foreach ($table as $item)
                <tr>
                    <td>{{$item->name_rus}}</td>

                    @if ($item->type = '3')
                    <td>
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Новое изображение</h3>
                            </div>
                            <div class="box-body">

                                <div id="container_image"></div>

                            </div>
                        </div>

                    </td>
                        @endif
                </tr>

                    @endforeach

                </tbody>
                <tfoot>

            </table>

        </div>
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
