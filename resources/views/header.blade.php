@extends ('header_page')

@section('title', $Seo->title)


@section ('content')

@include('table', ['table'=>$data, 'header' => $header, 'descs' => $descs])

@stop

