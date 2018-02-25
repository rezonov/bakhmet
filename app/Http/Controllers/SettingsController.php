<?php

namespace App\Http\Controllers;

use App\Settings;
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

    public function ShowSettings() {
        $Settings = Settings::all();

        return view('admin/settings/index', ['table' => $Settings]);
    }

    public function SaveSet (Request $request) {
        /*foreach($request->parameters as $r) {
           // $Set = Settings::firstOrNew(array($request))
            dump($r);
        }*/

        foreach ($request->all() as $key => $item) {
          if($key != '_token') {
             $Set = Settings::firstOrNew(array("name" => $key));
             $Set->value = $item;
              $Set->save();
            dump($key);
          }

        }
    }
}
