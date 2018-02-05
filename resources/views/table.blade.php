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

            @for($i=0;$i<count($tr);$i++)
                        @if($header[$i]['Sh'] != 'Off')
                        <td>
                            @if ($i==1)
                            <a onClick="if($('#descr{{$tr[0]}}').css('display') == 'none') { $('#descr{{$tr[0]}}').css('display', 'block') } else { $('#descr{{$tr[0]}}').css('display', 'none') }">{{$tr[$i]}}</a>
                                @else
                                {{$tr[$i]}}
                                @endif

                        </td>
                        @endif
            @endfor
        </tr>
            <tr>
                    <td colspan="{{count($tr)}}">
                            <div class="descrtd" id="descr{{$tr[0]}}" style="display: none;width:300px ">
                                <img width="300" float="right" src="/img/{{ $descs[$tr[0]]['file'] }}" />
                                {!! $descs[$tr[0]]['text'] !!}</div>
                    </td>
            </tr>
    @endforeach
</table>