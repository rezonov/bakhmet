@extends ('header_page')

@section('title')
    @if( (!empty($Seo->title)))
        $Seo->title
    @else
        "ТД Бахмет"
    @endif

@stop

@section ('content')
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/js/slick/slick.min.js"></script>
@include('table', ['table'=>$data, 'header' => $header, 'descr' => $descs])

@stop

@section ('layers')
    <div>
        @include('layers', ['attr'=>$header])
    </div>
@endsection
