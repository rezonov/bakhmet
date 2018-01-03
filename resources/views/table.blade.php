<table id="allcatalog" class="table">
        <tr>
                <th></th>
                @foreach($header as $th)
                        <th>{{$th['name']}}</th>
                        @endforeach
        </tr>
    @foreach($table as $tr)
        <tr class="valuerow">
            @foreach($tr as $td)
                <td>{{$td}}</td>
            @endforeach
        </tr>
    @endforeach
</table>