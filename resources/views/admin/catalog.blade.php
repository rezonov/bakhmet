@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{$name}}</h1>
@stop

@section('content')
    <div class="box">

        <div class="box-body">
            <div class="col-md-6">
                <a href="/admin/catalogs/excel/{{$id}}">
                    <img src="http://download.seaicons.com/icons/ziggy19/microsoft-office-mac-tilt/512/Excel-icon.png" width="100px" />
                </a>
            </div>
            <h3 class="box-title">Каталог</h3>
        </div>
        <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            @foreach($header[0] as $item_sub)
                                <th>{{$item_sub}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fnames as $item)
                            <tr>

                                @for($i=1; $i<count($item); $i++)
                                @if ($i == 1)
                                    <td>

                                        <a href="/admin/goods/{{$item[0]}}">
                                            {{$item[1]}}
                                        </a>
                                    </td>

                                @else

                                <td>
                                    {{$item[$i]}}

                                </td>
                                @endif
                                @endfor

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            @foreach($header[0] as $item_sub)
                                <th>{{$item_sub}}</th>
                            @endforeach
                        </tr>a
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop