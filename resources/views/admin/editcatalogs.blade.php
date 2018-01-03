@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')
    <div class="box">

        <div class="box-body">
            <h3 class="box-title">Каталог</h3>

            <div class="box-body">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">

                        <tbody>
                        @foreach($fnames as $item)
                            <tr>


                                        <td>

                                           {{$item->name}}
                                        </td>
                                        <td>
                                            <select>
                                                <option value="Диапазон">Диапазон</option>
                                                <option value="Выбор одного значения">Выбор одного значения</option>
                                                <option value="Выбор нескольких значений">Выбор нескольких значений</option>
                                            </select>
                                            {{
                                                $item->type
                                            }}
                                        </td>





                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>

@stop