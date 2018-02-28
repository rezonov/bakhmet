@extends ('header_page')

@section('title', ( $Seo->title or 'empty string'))


@section ('content')

@include('table', ['table'=>$data, 'header' => $header, 'descs' => $descs])

@stop

