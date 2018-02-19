<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="/css/jquery.fileupload.css">
    <link rel="stylesheet" href="/css/jquery.fileupload-ui.css">
    <script src="https://code.jquery.com/jquery-1.11.1.js"></script>
    <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
    <script src="/js/jQuery-Picture-Cut/src/jquery.picture.cut.js"></script>

    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript>
        <link rel="stylesheet" href="/css/jquery.fileupload-noscript.css">
    </noscript>
    <noscript>
        <link rel="stylesheet" href="/css/jquery.fileupload-ui-noscript.css">
    </noscript>
@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
@endif

<!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    @endif

    @yield('adminlte_css')


    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


</head>
<body class="hold-transition @yield('body_class')">


@yield('body')
<script>
    $("#uploaddiamond").on("submit", function (e) {
        e.preventDefault();
        var extension = $('#result_file').val().split('.').pop().toLowerCase();
        if ($.inArray(extension, ['csv', 'xls', 'xlsx']) == -1) {
            $('#errormessage').html('Please Select Valid File... ');
        } else {

            var file_data = $('#result_file').prop('files')[0];
            var supplier_name = $('#supplier_name').val();


            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('supplier_name', supplier_name);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('postDiamond')}}", // point to server-side PHP script
                data: form_data,
                type: 'POST',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function (data) {
                    $.ajax({
                        url: "/admin/excel/" + data,
                        type: 'GET',
                        contentType: false,
                        success: function (html) {
                            console.log('--------' + html);
                            $('#results').append(html);
                        }
                    })
                }
            });
        }
    });
</script>
<!--<script src="/js/jquery-ui/jquery-ui.js"></script>-->

<script src="https://adminlte.io/themes/AdminLTE/bower_components/ckeditor/ckeditor.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endif

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
@endif


@yield('adminlte_js')
<script>
    $(function () {
        $('#example1').DataTable({
            language: {
                processing: "Traitement en cours...",
                search: "Поиск",
                lengthMenu: "Отображать по _MENU_ строк",
                info: "Показаны с _START_ по _END_ из _TOTAL_ позиций",
                infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                infoPostFix: "",
                loadingRecords: "Chargement en cours...",
                zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
                emptyTable: "Aucune donnée disponible dans le tableau",
                paginate: {
                    first: "В начало",
                    previous: "Предыдущий",
                    next: "Следующий",
                    last: "В конец"
                },
                aria: {
                    sortAscending: ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        })
        /* $('#example1').DataTable({
             'paging': true,
             'lengthChange': false,
             'searching': true,
             'ordering': true,
             'info': true,
             'autoWidth': false
         })*/
    })

</script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.plugins.addExternal('colorbutton', '/js/colorbutton/', 'plugin.js');

        CKEDITOR.replace('editor1', {
                extraPlugins: 'colorbutton'
            }
        );
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5();


    })


</script>

</body>
</html>
