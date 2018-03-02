<!DOCTYPE>

<html>
<head>
    <title>@yield('title', 'Торговый дом Бахмет')</title>
    <script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>



    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
    <script>
        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).parent().addClass('open');
            var menu = $(this).parent().find("ul");
            var menupos = menu.offset();
            if ((menupos.left + menu.width()) + 30 > $(window).width()) {
                var newpos = - menu.width();
            } else {
                var newpos = $(this).parent().width();
            }
            menu.css({ left:newpos });
        });
    </script>

    <link rel="stylesheet" type="text/css" href="/js/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/js/slick/slick-theme.css"/>

    <link rel="stylesheet" href="/css/custom.css"/>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <div class="logo"><img src="/images/logo.jpg"/></div>
        </div>
        <div class="col-sm-10">
            <div class="row">
                <nav class="navbar navbar-default mainmenu">

                    <div class="col-sm-12">
                        <ul class="nav navbar-nav">
                            <li><a href="#">О нас</a></li>
                            <li><a href="dostavka.html">Доставка</a></li>
                            <li><a href="garantii.html">Гарантии</a></li>
                            <li><a href="contacts.html">Контакты</a></li>
                            <li><a href="vakansii.html">Вакансии</a></li>
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
                            <img src="/images/pics/clients.jpg"/>
                            <p>БОЛЕЕ 400 КЛИЕНТОВ</p>
                        </div>
                        <div>
                            <img src="/images/pics/tender.jpg"/>
                            <p>ПОБЕДИТЕЛИ ТЕНДЕРОВ</p>
                        </div>
                        <div>
                            <img src="/images/pics/avto.jpg"/>
                            <p>УМЕЕМ "СРОЧНО" И "ВЧЕРА"</p>
                        </div>
                        <div>
                            <img src="/images/pics/pack.jpg"/>
                            <P>100 ПОЗИЦИЙ = 1 ДОСТАВКА</P>
                        </div>
                        <div>
                            <img src="/images/pics/geo.jpg"/>
                            <P>ДОСТАВЛЯЕМ ПО ВСЕЙ РОССИИ</P>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="phones">
                        +7 (495) 508 15 25<br/>
                        +7 (905) 538 77 73 <br/>


                        <button type="button" class="btn btn-orange" data-toggle="modal" data-target="#myModal">
                            ЗАКАЗАТЬ ЗВОНОК</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="background: #4cbceb; height:75px">

            <div class="col-sm-5">
                <div style="width:250px; color:#fff; height:70px; border-top-left-radius:10px; border-top-right-radius:10px;  position:relative; top:10px; padding-top:20px; font-size:20px; background:#006896; text-align:center;">
                    Каталог товаров
                </div>

            </div>
            <div class="col-sm-7">
                {!! Form::open([
                         'action' => 'GoodsController@Search',
                         'method' => 'post'
                         ]) !!}
                <div class="search_wrapper">
                    <p style="color:#fff; font-size:18px; padding-top:10px; padding-left:20px;">Поиск в базе по <u>11
                                                                                                                   248</u>
                                                                                                товарам</p>
                    <p style="padding-left:10px;"><input type="text" name="word" class="form-control"/><input type="submit"
                                                                                                  value="ПОИСК"
                                                                                                  class="btn btn-orange"
                                                                                                  style="width: 15%;
    float: right;
    top: -35px;
    position: relative;"></p>
                    {!! Form::close!!}
                </div>
            </div>

        </div>

    </div>
</div>
<div class="container-fluid" style="background: url('{{$background}}');">
    <div class="row">
        <div class="col-md-3" >
            @widget('test')
            @yield('layers')
        </div>

        <div class="col-md-9" style="background: #fff">
@yield('content')

        </div>
    </div>

    <script>

        $('.dropdown-toggle').dropdown();

    </script>
@include('form')
</body>
</html>