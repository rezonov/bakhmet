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
                            <a href="/{{$catalog}}/{{$Url[$tr[0]]}}.html">{{$tr[$i]}}</a>
                            <a onClick="if($('#descr{{$tr[0]}}').css('display') == 'none') { $('#descr{{$tr[0]}}').css('display', 'block') } else { $('#descr{{$tr[0]}}').css('display', 'none') }">{{$tr[$i]}}</a>
                        @elseif(!empty($tr[$i]))
                            {{$tr[$i]}}
                        @endif

                    </td>
                @endif
            @endfor
            <td>
                <button type="button" class="btn btn-orange" data-toggle="modal" data-target="#myModal">
                    ЗАКАЗАТЬ
                </button>
            </td>
        </tr>
        <tr>
            <td colspan="{{count($tr)}}">

                @if(!empty($descr[$tr[0]]['text']))
                    <div class="descrtd" id="descr{{$tr[0]}}" style="display: none;width:300px ">
                        <div style="float:left">
                            <img width="300" float="right" src="/img/{{ $descs[$tr[0]]['file'] }}"/>
                            @if(!empty($files[$tr[0]]))
                                <div class="slider variable-width">

                                    @foreach ($files[$tr[0]] as $item)
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
                                    autoscroll:false,
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
            </td>
        </tr>
    @endforeach
</table>



