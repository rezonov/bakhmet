@extends ('header_page')

@section('title', $tables->title)


@section ('content')
    <table class="table">


    @foreach($Attributes as $A)
            <tr>
                <td>{{$A->name}}</td>
            </tr>
    @endforeach
    </table>
@stop