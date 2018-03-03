<table id="allcatalog" class="table">
    <tr>

        @foreach($header as $th=>$value)
            @if($value->sh != 'Off')
            <th>{{$value->name}}</th>
            @endif

        @endforeach
    </tr>
    @foreach($table as $tr)
        <tr class="valuerow">
            @foreach($header as $th=>$value)
               @if($header[$value->id]->sh != 'Off')
                <td>
                    @if($value->id == 1)
                        <a onClick="if($('#descr{{$tr[0]}}').css('display') == 'none') { $('#descr{{$tr[0]}}').css('display', 'block') } else { $('#descr{{$tr[0]}}').css('display', 'none') }">{{$tr[$i]}}</a>
                    @else
                    {{$tr[$value->id] or ''}}
                        @endif
                </td>
                @endif
            @endforeach

            <td>
                <button type="button" class="btn btn-orange" data-toggle="modal" data-target="#myModal">
                    ЗАКАЗАТЬ
                </button>
            </td>
        </tr>
        <tr>
            <td colspan="{{count($tr)}}">
                @if(!empty($tr[202]))
                    <div class="descrtd" id="descr{{$tr[0]}}" style="display: none;width:300px ">
                {!!  $tr[202]  !!}
                    </div>
                    @endif

            </td>
        </tr>
    @endforeach
</table>



