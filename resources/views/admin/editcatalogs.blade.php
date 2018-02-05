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


                                    <input type="checkbox" name="sh[{{$item->id}}]"
                                          @if($item->sh == 'on'): checked
                                           @endif

                                    >
                                </td>
                                <td>
                                    <input type="checkbox" name="fl[{{$item->id}}]"
                                           @if ($item->fl == 'on'): checked
                                            @endif
                                    >
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

@stop