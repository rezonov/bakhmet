@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Импортировать каталог</h1>
@stop

@section('content')

    <div class="box">

        <div class="box-body">
            <h3 class="box-title">Каталог</h3>

            <div class="box-body">

                <form id="uploaddiamond" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="block">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Upload Diamond <span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <input required="" type="file" name="result_file" id="result_file" />
                                    </div>
                                </div>

                                <div class="btn-group pull-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    $(function () {
        $("#container_image").PictureCut({
            ImageButtonCSS: {
                border: "1px #CCC solid",
                width: 500,
                height: 300
            },
            Extensions: ['xls', 'xlsx', 'csv'],
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