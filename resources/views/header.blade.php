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
@include('table', ['table'=>$data, 'header' => $header, 'descr' => $descs, 'url' => $Url, 'header' => $header])

@stop

@section ('layers')
    <div>
        @include('layers', ['attr'=>$header])
    </div>
    <script>
        function filterTable($table, $col, $min, $max) {

            var $rows = $('#allcatalog').find('.valuerow');
            $rows.each(function (rowIndex) {

                var valid = true;
                if($(this).css('display') != 'none') {
                var result = $(this).find('td').eq($col).html();
                if ((result > $min) && (result < $max)) {
                    valid = true;
                    console.log($min + ">" + result + "<" + $max);
                } else
                    valid = false;
                }
                if (valid == false) {
                    $(this).css('display', 'none');
                } else {
                    $(this).css('display', '');
                }


            });
            console.log('---------');
        }
    </script>
@endsection
