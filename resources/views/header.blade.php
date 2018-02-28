@extends ('header_page')

@section('title')
    @if( is_null($Seo->title))
        $Seo->title
    @else
        "ТД Бахмет"
    @endif


@section ('content')

@include('table', ['table'=>$data, 'header' => $header, 'descs' => $descs])

@stop

