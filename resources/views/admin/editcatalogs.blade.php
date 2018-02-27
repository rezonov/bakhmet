@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')
    {!! Form::open([
                         'action' => 'GoodsController@SaveEditCatalog',
                         'method' => 'post'
                         ]) !!}
    <input type="hidden" name="id" value="{{ $id }}"/>
    <div class="box">

        <div class="box-body">
            <h3 class="box-title">Каталог</h3>

            <div class="box-body">
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>
                                Название
                            </th>
                            <th>Показывать в таблице</th>
                            <th>Показывать в фильтре</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fnames as $item)
                            <tr>
                                <td>
                                    {{$item->name}}
                                </td>
                                <td>
                                    <input type="checkbox" name="sh[{{$item->id}}]" @if($item->sh == 'on'): checked
                                            @endif
                                    >
                                </td>
                                <td>
                                    <input type="checkbox" name="fl[{{$item->id}}]" @if ($item->fl == 'on'): checked
                                            @endif
                                    >
                                </td>
                                <td><input type="text" value="{{$item->sort}}"/>

                                </td>
                                <td>
                                    <input type="hidden" class="id_" value="{{$item->id}}"/>
                                    <input type="hidden" value="{{$item->sort}}"/>
                                    <a class="btn btn-success up" onclick=""><i class="fa fa-hand-o-up"></i></a>
                                    <a class="btn btn-success down"><i class="fa fa-hand-o-down"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6 align-right">
                        <input type="submit" class="btn btn-success" value="Сохранить">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.up').click(function () {


            var newtr = $(this).parent().parent();
            var oldtr = $(this).parent().parent().prev();


            var token = "{{ csrf_token() }}";


            $.ajax({
                type: 'POST',
                beforeSend: function(xhr, type) {
                    if (!type.crossDomain) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                    }
                },
                url: '/admin/catalogs/change',
                data: {
                    _token:token,
                    sort:$(this).prev().prev().val(),
                    cat:{{$id}},act:"plus",
                    cursort:$(this).prev().val(),
                    prev:oldtr.find('td > .id_').val(),
                },
                success: function(result){
                    newtr.insertBefore(oldtr);
                    console.log(result);
                }
            });
            return;
        });
        $('.down').click(function () {


            var newtr = $(this).parent().parent();
            var oldtr = $(this).parent().parent().next();


            var token = "{{ csrf_token() }}";


            $.ajax({
                type: 'POST',
                beforeSend: function(xhr, type) {
                    if (!type.crossDomain) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                    }
                },
                url: '/admin/catalogs/change',
                data: {
                    _token:token,
                    sort:$(this).prev().prev().prev().val(),
                    cat:{{$id}},
                    act:"minus",
                    cursort:$(this).prev().prev().val(),
                    prev:oldt.find('td > .id_').val(),
                },
                success: function(result){
                    newtr.insertAfter(oldtr);
                    console.log(result);
                }
            });
            return;
        });
    </script>
@stop

