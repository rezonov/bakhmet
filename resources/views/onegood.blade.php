@extends ('header_page')


@section('title')
    @if( (!empty($Seo->title)))
        $Seo->title
    @else
        "ТД Бахмет"
    @endif

@stop

@section('keywords')
    @if( (!empty($Seo->keywords)))
        $Seo->keywords
    @else
        "ТД Бахмет"
    @endif

@stop
@section('descriptions')
    @if( (!empty($Seo->keywords)))
        $Seo->keywords
    @else
        "ТД Бахмет"
    @endif

@stop


@section ('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{$name}}</h1>
        </div>
        <div class="col-md-5">

            @if(!empty($Descrs->file))
                <div class="descrtd" id="descr{{$id}}">
                    <div style="float:left">
                        <img width="300" float="right" src="/img/{{ $Descrs->file }}"/>
                        @if(!empty($files))
                            <div class="slider variable-width">

                                @foreach ($files as $item)
                                    <div style="width: 250px;"><a href="#"><img width="250px"
                                                                                src="/php/files/{{$id}}/{{$item}}"/></a>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                    </div>
                </div>


                    <script type="text/javascript">
                        function Slick() {
                            $('.variable-width').not('.slick-initialized').slick({
                                dots: true,
                                autoscroll: false,
                                infinite: true,
                                speed: 300,
                                slidesToShow: 1,
                                centerMode: true,
                                variableWidth: true
                            });
                        }

                        Slick();
                    </script>




            @endif
        </div>
        <div class="col-md-7">
            <div class="table-responsive">

                <table class="table">


                    @foreach($Attributes as $A)
                        <tr>
                            <td>{{$A->name}}</td>
                            <td>{{$A->value}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <button type="button" class="btn btn-orange" data-toggle="modal" data-target="#myModal">
                ЗАКАЗАТЬ
            </button>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(!empty($Descrs->text))  {!! $Descrs->text !!} @endif
            </div>
        </div>
    </div>
@stop