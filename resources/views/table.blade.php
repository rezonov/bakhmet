<table id="allcatalog" class="table">
        <tr>

                @foreach($header as $th)
                    @if($th['Sh']!='Off')
                        <th>{{$th['name']}}</th>
                @endif
                        @endforeach
        </tr>
    @foreach($table as $tr)
        <tr class="valuerow">

            @for($i=0;$i<count($header);$i++)
                        @if($header[$i]['Sh'] != 'Off')
                        <td>
                            @if ($i==1)
                            <a onClick="if($('#descr{{$tr[0]}}').css('display') == 'none') { $('#descr{{$tr[0]}}').css('display', 'block') } else { $('#descr{{$tr[0]}}').css('display', 'none') }">{{$tr[$i]}}</a>
                                @elseif(!empty($tr[$i]))
                                {{$tr[$i]}}
                                @endif

                        </td>
                        @endif
            @endfor
            <td> <button type="button" class="btn btn-orange" data-toggle="modal" data-target="#myModal">
                    ЗАКАЗАТЬ                       </button></td>
        </tr>
            <tr>
                    <td colspan="{{count($tr)}}">

                        @if(!empty($descr[$tr[0]]['text']))
                            <div class="descrtd" id="descr{{$tr[0]}}" style="display: none;width:300px ">
                                <img width="300" float="right" src="/img/{{ $descs[$tr[0]]['file'] }}" />
                                <section class="slider">
                                    <div>slide1</div>
                                    <div>slide2</div>
                                    <div>slide3</div>
                                    <div>slide4</div>
                                    <div>slide5</div>
                                    <div>slide6</div>
                                </section>
                                <script>
                                    function createSlick(){

                                        $(".slider").not('.slick-initialized').slick({
                                            autoplay: true,
                                            dots: true,
                                            responsive: [{
                                                breakpoint: 500,
                                                settings: {
                                                    dots: false,
                                                    arrows: false,
                                                    infinite: false,
                                                    slidesToShow: 2,
                                                    slidesToScroll: 2
                                                }
                                            }]
                                        });

                                    }

                                    createSlick();
                                </script>

                                {!! $descs[$tr[0]]['text'] !!}

                            </div>

                            @endif
                    </td>
            </tr>
    @endforeach
</table>



