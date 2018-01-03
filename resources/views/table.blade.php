<table id="allcatalog">
    @foreach($table as $tr)
        <tr>
            @foreach($tr as $td)
                <td>{{$td}}</td>
            @endforeach
        </tr>
    @endforeach
</table>