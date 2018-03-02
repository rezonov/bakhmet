@extends ('header_page')

@section('title', "YEAH")


@section ('content')
    <table class="table">


    @foreach($Attributes as $A)
            <tr>
                <td>{{$A->name}}</td>
                <td>{{$A->value}}</td>
            </tr>
    @endforeach
    </table>
@stop