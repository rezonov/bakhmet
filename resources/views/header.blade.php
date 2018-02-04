<!DOCTYPE html>
<html  lang="ru-RU"
       itemscope
       itemtype="http://schema.org/Article"
       prefix="og: http://ogp.me/ns#" >
<head>
    <meta name="csrf-token" content="tXcE3u4iytTSOfjpBJ6u6ERdgdsapulUgSenb0KR">
    <script type="text/javascript" src="http://gc.kis.v2.scr.kaspersky-labs.com/20EFB0EA-8B55-5747-A402-0F64DA5E8187/main.js" charset="UTF-8"></script><script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/custom.css"/>
    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">-->

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <img width="200px" src="/images/logo.jpg" />
        </div>
        <div class="col-sm-10">
            <div class="row">
                <nav class="navbar navbar-default mainmenu">

                    <div class="col-sm-12">
                        <ul class="nav navbar-nav">
                            <li><a href="#">О Нас</a></li>
                            <li><a href="#">Доставка</a></li>
                            <li><a href="#">Гарантии</a></li>
                            <li><a href="#">Контакты</a></li>
                            <li><a href="#">Вакансии</a></li>

                        </ul>

                    </div>


                </nav>
            </div>
            <div class="row">
                <div class="col-sm-10 header">
                    <h2>ПОЛНОЦЕННЫЙ ОТДЕЛ СНАБЖЕНИЯ
                        ДЛЯ ВАШЕЙ КОМПАНИИ</h2>

                    <div class="pics">
                        <div>
                            <img src="/images/pics/clients.jpg" /><p>БОЛЕЕ 400 КЛИЕНТОВ</p>
                        </div>
                        <div>
                            <img src="/images/pics/tender.jpg" /><p>ПОБЕДИТЕЛИ ТЕНДЕРОВ</p>
                        </div>
                        <div>
                            <img src="/images/pics/avto.jpg" /><p>УМЕЕМ "СРОЧНО" И "ВЧЕРА"</p>
                        </div>
                        <div>
                            <img src="/images/pics/pack.jpg" /><P>100 ПОЗИЦИЙ = 1 ДОСТАВКА</P>
                        </div>
                        <div>
                            <img src="/images/pics/geo.jpg" /><P>ДОСТАВЛЯЕМ ПО ВСЕЙ РОССИИ</P>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="phones">
                        +7 (495) 508 15 25<br />
                        +7 (905) 538 77 73 <br />
                        <input type="submit" class="btn btn-orange" value="ЗАКАЗАТЬ ЗВОНОК" />
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12" style="background: #4cbceb; height:75px">

            <div class="col-sm-5">
                <div style="width:250px; color:#fff; height:70px; border-top-left-radius:10px; border-top-right-radius:10px;  position:relative; top:10px; padding-top:20px; font-size:20px; background:#006896; text-align:center;">Каталог товаров</div>

            </div>
            <div class="col-sm-7">
                <div style="background: #3386ab; width:669px; height:100px; position:relative; top:-50px; border:solid 1px #666666; padding:10px">
                    <p style="color:#fff; font-size:18px; padding-top:10px; padding-left:20px;">Поиск в базе по <u>11 248</u> товарам</p>
                    <p style="padding-left:10px;"><input type="text" class="form-control" /><input type="submit" value="ПОИСК" class="btn btn-orange" style="width: 15%;
    float: right;
    top: -35px;
    position: relative;"></p>
                </div>
            </div>

        </div>

    </div>
    <div class="row">
    <div class="col-sm-3">
        <div class="menu_wrapper">
            <ul class="menu">
                <li>Насосы</li>
                <li>Насосы</li>
                <li>Насосы</li>
                <li>Насосы</li>
                <li>Насосы</li>
                <li>Насосы</li>
                <li>Насосы</li>
            </ul>
        </div>
        <div>

            @include('layers', ['attr'=>$header])
            </div>

        </div>
        <div class="col-sm-9">

            @include('table', ['table'=>$data, 'header' => $header, 'descs' => $descs])

        </div>
</div>


<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-10">


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