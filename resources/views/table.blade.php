<table id="allcatalog" class="table">
    <tr>

        @foreach($header as $th)
            @if($th['Sh']!='Off')
                <th>{{$th['name']}}</th>
            @endif
        @endforeach
    </tr>
    @foreach($table as $tr)
        <tr class="valuerow">

            @for($i=0;$i<count($header);$i++)
                @if($header[$i]['Sh'] != 'Off' )

                        @if ($i==1)

                        <td data-row="{{$header[$i]['id']}}"><a onClick="if($('#descr{{$tr[0]}}').css('display') == 'none') { $('#descr{{$tr[0]}}').css('display', 'contents') } else { $('#descr{{$tr[0]}}').css('display', 'none') }">{{$tr[$i]}}</a>
                                <span style="float:right"><a href="/good/{{$catalog}}/{{$Url[$tr[0]]}}.html">Описание</a></span></td>
                        @elseif(!empty($tr[$i]))
                        <td data-row="{{$header[$i]['id']}}">{{trim($tr[$i])}}</td>
                            @else
                        <td data-row="{{$header[$i]['id']}}"></td>
                        @endif



                @endif
            @endfor
            <td>
                <button type="button" class="btn btn-orange" data-toggle="modal" data-target="#myModal">
                    ЗАКАЗАТЬ
                </button>
            </td>
        </tr>
        <tr id="descr{{$tr[0]}}" style="display: none">
            <td colspan="{{count($tr)}}">

                @if(!empty($descr[$tr[0]]['text']))
                    <div class="descrtd"  style="width:300px ">
                        <div style="float:left">
                            <img width="300" float="right" src="/img/{{ $descs[$tr[0]]['file'] }}"/>
                            @if(!empty($files[$tr[0]]))
                                <div class="slider variable-width">

                                    @foreach ($files[$tr[0]] as $item)
                                        <div style="width: 250px;"><a href="#"><img width="250px"
                                                                                    src="/php/files/{{$tr[0]}}/{{$item}}"/></a>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                        @endif
                        <script type="text/javascript">
                            function Slick() {
                                $('.variable-width').not('.slick-initialized').slick({
                                    dots: true,
                                    autoscroll: false,
                                    infinite: true,
                                    speed: 300,
                                    slidesToShow: 1,
                                    centerMode: true,
                                    variableWidth: true
                                });
                            }

                            Slick();
                        </script>

                        {!! $descs[$tr[0]]['text'] !!}

                    </div>

                @endif
            </td>
        </tr>
    @endforeach
</table>



<script>
    $(function () {
        $('#allcatalog').DataTable({
            language: {
                processing: "Traitement en cours...",
                search: "Поиск",
                lengthMenu: "Отображать по _MENU_ строк",
                info: "Показаны с _START_ по _END_ из _TOTAL_ позиций",
                infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                infoPostFix: "",
                loadingRecords: "Chargement en cours...",
                zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
                emptyTable: "Aucune donnée disponible dans le tableau",
                paginate: {
                    first: "В начало",
                    previous: "Предыдущий",
                    next: "Следующий",
                    last: "В конец"
                },
                aria: {
                    sortAscending: ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        })

    })

</script>