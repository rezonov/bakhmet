@extends ('header_page')

@section('title', "Результаты поиска")


@section ('content')
<h2>Результаты поиска:</h2>
    <table class="table">
        <tr>
            <th>Название товара</th>
            <th>Каталог</th>
        </tr>
        @foreach($names as $n)
        <tr>
            <td><a href="/good/{{$n->Clat}}/{{$n->Glat}}.html">{{$n->Gname}}</a></td>
            <td><a href="/catalog/{{$n->Clat}}">{{$n->Name}}</a></td>

        </tr>
            @endforeach
    </table>

@stop