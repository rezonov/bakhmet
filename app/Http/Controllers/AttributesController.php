<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Db;
use App\Attributes;

class AttributesController extends Controller
{
    //
    public function AllAttributes() {
        $Attrs = Attributes::all();
        foreach($Attrs as $item) {
            $finalAr[] = $item;
        }
       // die();
       // dump($finalAr);
        return view('home', ['names' => $finalAr]);
    }
}
