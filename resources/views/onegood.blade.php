@extends ('header_page')

@section('title', "YEAH")


@section ('content')
    <div class="col-md-3">

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
                </div>
            </div>
            <div>
                @endif
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



            </div>

        @endif
    </div>
    <div class="col-md-6">
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
        <div>
            {!! $Descrs->text !!}
        </div>
    </div>
@stop