    {{$c=0}}
    @foreach($attr as $tr)
                {{ $c++ }}
               <p>
                   <label for="amount">{{$tr['name']}}</label>
                   <input type="text" id="amount-{{$tr['id']}}" style="border:0; color:#f6931f; font-weight:bold;" />
               </p>
               <div id="slider-range-{{$tr['id']}}"></div>

<script>
    $("#slider-range-{{$tr['id']}}").slider({
        range: true,
        min:{{$tr['min']}},
        max:{{$tr['max']}},
        values: [ {{$tr['min']}}, {{$tr['max']}} ],
        change: function( event, ui ) {
            $( "#amount-{{$tr['id']}}" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            filterTable('#allcatalog', '{{$c}}', ui.values[ 0 ] , ui.values[ 1 ]  );
        }
    });
    $( "#amount-{{$tr['id']}}" ).val(  $( "#slider-range-{{$tr['id']}}" ).slider( "values", 0 ) +
        " - " + $( "#slider-range-{{$tr['id']}}" ).slider( "values", 1 ) );
</script>
    @endforeach