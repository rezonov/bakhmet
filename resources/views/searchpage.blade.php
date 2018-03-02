@extends ('header_page')

@section('title', "Результаты поиска")


@section ('content')

    <table class="table">
        @foreach($name as $n)
        <tr>
            <td>{{$n->Name}}</td>
        </tr>
    </table>
@stop