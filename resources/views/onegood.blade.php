@extends ('header_page')

@section('title', "YEAH")


@section ('content')
    <div class="col-md-3">

        @if(!empty($Descrs->file))
            <div class="descrtd" id="descr{{$tr[0]}}" style="display: none;width:300px ">
                <div style="float:left">
                    <img width="300" float="right" src="/img/{{ $Descrs->file }}"/>
                    @if(!empty($files[$tr[0]]))
                        <div class="slider variable-width">

                            @foreach ($files as $item)
                                <div style="width: 250px;"><a href="#"><img width="250px"
                                                                            src="/php/files/{{$tr[0]}}/{{$item}}"/></a>
                                </div>
                            @endforeach
                        </div>
                </div>
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

                {!! $descs[$tr[0]]['text'] !!}

            </div>

        @endif
    </div>
    <div class="col-md-9">
    <table class="table">


    @foreach($Attributes as $A)
            <tr>
                <td>{{$A->name}}</td>
                <td>{{$A->value}}</td>
            </tr>
    @endforeach
    </table>
    </div>
@stop