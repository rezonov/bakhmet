@extends ('header_page')

@section('title')
    @if( (!empty($Seo->title)))
        $Seo->title
    @else
        "ТД Бахмет"
    @endif

@stop

@section ('content')

@include('table', ['table'=>$data, 'header' => $header, 'descs' => $descs])

@stop

@section ('layers')
    <div>
        @include('layers', ['attr'=>$header])
    </div>
@endsection
