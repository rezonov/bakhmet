<html>
<head>
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/custom.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://laravel.devel/builder/BootstrapPageGenerator/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" id="LG">
    <div class="row">
        <div class="col-xs-4">
        </div>
        <div class="col-xs-4">
        </div>
        <div class="col-xs-4">
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2">
        </div>
        <div class="col-xs-10">
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            @include('layers', ['attr'=>$header])
        </div>
        <div class="col-md-10">

                @include('table', ['table'=>$data, 'header' => $header])

        </div>
    </div>
</div>
<script>
    function filterTable($table, $col, $min, $max) {

        var $rows = $('#allcatalog').find('.valuerow');
        $rows.each(function (rowIndex) {
            var valid = true;

            var result = $(this).find('td').eq($col).html();
            if((result>$min) && (result<$max)) {
                valid = true;
                console.log($min + ">" + result + "<" +$max);
            } else
                valid = false;

            if(valid==false) {
                $(this).css('display', 'none');
            } else {
                $(this).css('display', '');
            }


        });
        console.log('---------');
    }
</script>
</body>
</html>