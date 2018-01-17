<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="/css/custom.css"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

</head>
<body>
<div class="container" id="LG">
    <div class="row">
        <div class="col-xs-4"></div>
        <div class="col-xs-4"></div>
        <div class="col-xs-4"></div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <nav>
                <ul class="topmenu">
                    <li><a href="" class="active">Каталог<span class="fa fa-angle-down"></span></a>
                        <ul class="submenu">
                            {!! $menu !!}
                            <li><a href="">меню второго уровня<span class="fa fa-angle-down"></span></a>
                                <div class="submenu">
                                    <div class="row">
                                        <div class="col-md-4">


                                        <div class="spoiler">

                                            <input type="checkbox">123
                                            <div class="box">

                                                Текст сообщения в спойлере.

                                            </div>

                                        </div>
                                        </div>
                                    <div class="col-md-4">


                                        <div class="spoiler">

                                            <input type="checkbox">123
                                            <div class="box">

                                                Текст сообщения в спойлере.

                                            </div>

                                        </div>
                                    </div>
                                    </div>

                                </div>
                            </li>
                            <li><a href="">меню второго уровня</a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
        <div class="col-md-10"></div>
    </div>
    <div class="row">
        <div class="col-md-2">
            @include('layers', ['attr'=>$header])
        </div>
        <div class="col-md-10">

            @include('table', ['table'=>$data, 'header' => $header, 'descs' => $descs])

        </div>
    </div>
</div>
<script>
    function filterTable($table, $col, $min, $max) {

        var $rows = $('#allcatalog').find('.valuerow');
        $rows.each(function (rowIndex) {
            var valid = true;

            var result = $(this).find('td').eq($col).html();
            if ((result > $min) && (result < $max)) {
                valid = true;
                console.log($min + ">" + result + "<" + $max);
            } else
                valid = false;

            if (valid == false) {
                $(this).css('display', 'none');
            } else {
                $(this).css('display', '');
            }


        });
        console.log('---------');
    }

    $('.dropdown-toggle').dropdown();

</script>
</body>
</html>