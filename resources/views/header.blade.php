@extends ('header_page')

@section('title', !empty($Seo->title))


@section ('content')

@include('table', ['table'=>$data, 'header' => $header, 'descs' => $descs])

@stop

