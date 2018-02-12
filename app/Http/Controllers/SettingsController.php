<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SettingsController extends Controller
{
    //
    public function ShowAttr() {
        $Attr = DB::table('attributes')
            ->join('catalogs__attributes', 'catalogs__attributes.id_attribute', '=', 'attributes.id')
            ->get();

        foreach ($Attr as $item) {
            $finalAr[] = $item;
        }
        // die();
        // dump($finalAr);
        return view('admin/settings/attributes', ['table' => $finalAr]);
    }
}
