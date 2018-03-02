@extends ('header_page')

@section('title', "Результаты поиска")


@section ('content')
<h2>Результаты поиска:</h2>
    <table class="table">
        @foreach($names as $n)
        <tr>
            <td><a href="/good/{{$n->Clat}}/{{$n->Name}}">{{$n->Gname}}</a></td>
            <td>{{$n->Gname}}</td>
            <td>{{$n->Name}}</td>
        </tr>
            @endforeach
    </table>

@stop