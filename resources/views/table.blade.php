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
                                <div class="slider variable-width">
                                    <div style="width: 200px;"><p>200</p></div>
                                    <div style="width: 175px;"><p>175</p></div>
                                    <div style="width: 150px;"><p>150</p></div>
                                    <div style="width: 300px;"><p>300</p></div>
                                    <div style="width: 225px;"><p>225</p></div>
                                    <div style="width: 125px;"><p>125</p></div>

                                </div>
                                <script type="text/javascript">
                                    function Slick() {
                                    $('.variable-width').not('.slick-initialized').slick({
                                        dots: true,
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



