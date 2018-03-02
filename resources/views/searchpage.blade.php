@extends ('header_page')


@section('title')
    @if( (!empty($Seo->title)))
        $Seo->title
    @else
        "ТД Бахмет"
    @endif

@stop

@section('keywords')
    @if( (!empty($Seo->keywords)))
        $Seo->keywords
    @else
        "ТД Бахмет"
    @endif

@stop
@section('descriptions')
    @if( (!empty($Seo->keywords)))
        $Seo->keywords
    @else
        "ТД Бахмет"
    @endif

@stop

@section ('content)

    @stop