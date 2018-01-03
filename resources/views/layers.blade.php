
    @foreach($attr as $tr)

               <p>
                   <label for="amount-{{$tr['id']}}">{{$tr['name']}}</label>
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
            $.ajax({
                type: "POST",
                url: "/actions/json",
                data: {
                    "min": ui.values[ 0 ],
                    "max":  ui.values[ 1 ]
                },
                datatype: "json"
            }).done(function( msg ) {
                if(msg.error == 0){
                    //$('.sucess-status-update').html(msg.message);

                }else{

                    //$('.error-favourite-message').html(msg.message);
                }
            });
        }
    });
    $( "#amount-{{$tr['id']}}" ).val(  $( "#slider-range-{{$tr['id']}}" ).slider( "values", 0 ) +
        " - " + $( "#slider-range-{{$tr['id']}}" ).slider( "values", 1 ) );
</script>
    @endforeach