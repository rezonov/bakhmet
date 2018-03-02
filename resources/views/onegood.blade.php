@extends ('header_page')

@section('title', "YEAH")


@section ('content')
    <div class="col-md-3"></div>
    <div class="col-md-9">
    <table class="table">


    @foreach($Attributes as $A)
            <tr>
                <td>{{$A->name}}</td>
                <td>{{$A->value}}</td>
            </tr>
    @endforeach
    </table>
    </div>
@stop