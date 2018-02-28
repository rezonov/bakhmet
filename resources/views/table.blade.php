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
                        @if(!empty($descr[$tr[0]]['file']))
                            <div class="descrtd" id="descr{{$tr[0]}}" style="display: none;width:300px ">
                                <img width="300" float="right" src="/img/{{ $descs[$tr[0]]['file'] }}" />

                                {!! $descs[$tr[0]]['text'] !!}
                                <div class="your-class">
                                    <div>your content</div>
                                    <div>your content</div>
                                    <div>your content</div>
                                </div>
                            </div>
                            @endif
                    </td>
            </tr>
    @endforeach
</table>

<script type="text/javascript" src="js/slick/slick.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.your-class').slick({

    });
    });
</script>

