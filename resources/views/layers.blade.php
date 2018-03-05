<?php $c = 0;?>
<div class="filters">

    @foreach($attr as $tr)
        <?php  $c = $c + 1;?>
        @if ($tr['Fl'] != "Off" and $tr['Sh'] != "Off")
            <p>
                <label for="amount">{{$tr['name']}}</label>
                <input type="text" id="amount-{{$tr['id']}}" style="border:0; color:#f6931f; font-weight:bold;"/>
            </p>
            <div id="slider-range-{{$tr['id']}}"></div>

            <script>
                $("#slider-range-{{$tr['id']}}").slider({
                    range: true,
                    min:{{$tr['min']}},
                    max:{{$tr['max']}},
                    values: [ {{$tr['min']}}, {{$tr['max']}} ],
                    change: function (event, ui) {
                        $("#amount-{{$tr['id']}}").val(ui.values[0] + " - " + ui.values[1]);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        filterTable('#allcatalog', '{{$c}}', ui.values[0], ui.values[1]);
                    }
                });
                $("#amount-{{$tr['id']}}").val($("#slider-range-{{$tr['id']}}").slider("values", 0) +
                    " - " + $("#slider-range-{{$tr['id']}}").slider("values", 1));
            </script>
        @endif
    @endforeach


</div>
<script>

    function filterTable($table, $col, $min, $max) {
            <?php $c = 0;?>
        var $Cols = [];
        @foreach($attr as $tr)
        <?php  $c = $c + 1;?>
                @if ($tr['Fl'] != "Off" and $tr['Sh'] != "Off" )

                    $Cols[{{$tr['id']}}] = $("#amount-{{$tr['id']}}").val().split(' - ');
                @endif

                @endforeach


        var $Tols = [];
        console.log($Cols);

        var $rows = $('#allcatalog').find('.valuerow');
        $rows.each(function (rowIndex) {
            $("td",this).each(function(){
                var ind = $(this).attr('data-row');

                var valid = true;


                    console.log(ind + $(this).text() + $Cols[ind][0]);



                    //   console.log($Cols[i][0] + ">" + result);
               /*     if ((result > $Cols[i][0]) && (result < $Cols[i][1])) {
                        valid = true;

                    } else
                        valid = false;*/
            });
            var $row = $(this);




            if (valid == false) {
                $(this).css('display', 'none');
            } else {
                $(this).css('display', '');
            }


        });
        console.log('---------');
    }
</script>