@extends ('header_page')

@section('title')
    @if( (!empty($Seo->title)))
        $Seo->title
    @else
        "ТД Бахмет"
    @endif

@stop

@section ('content')

    <script type="text/javascript" src="/js/slick/slick.min.js"></script>
@include('table', ['table'=>$data, 'header' => $header, 'descr' => $descs])

@stop

@section ('layers')
    <div>
        @include('layers', ['attr'=>$header])
    </div>
@endsection
