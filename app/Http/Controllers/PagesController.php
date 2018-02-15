<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PagesController extends Controller
{
    //

    public function ShowIndex() {
        $Attrs = DB::table('pages')
            ->where('url','=','index')
            ->get();
     //   dump($Attrs);

        return view('pages', ['tables' => $Attrs[0]]);
    }

    public function ShowPage($name) {
        $Attrs = DB::table('pages')
           ->where('url','=',$name)
            ->get();

        return view('pages', ['tables' => $Attrs[0]]);
    }

    public function AdminPages() {
        $Pages = DB::table('pages')
        ->get();

        return view('admin/pages', ['tables' => $Pages]);
    }


    public function AdminPage($id) {
        $Pages = DB::table('pages')
            ->where('url', '=', $id)
            ->get();

        return view('admin/page', ['tables' => $Pages[0]]);
    }

    public function AddPage() {
        return view('admin/page');
    }

    public function SavePage(Request $request) {

        if($request->id == '0') {

            $savepage = array(
                "title" => $request->title,
                "content" => $request->text,
                "keywords" => $request->keywords,
                "url" => $request->url,
                "description" => $request->descriptions,

            );
            DB::table('pages')
                ->insert($savepage
                );
        } else {
            $savepage = array(
                "title" => $request->title,
                "content" => $request->text,
                "keywords" => $request->keywords,
                "url" => $request->url,
                "description" => $request->descriptions,

            );
            DB::table('pages')
                ->where(['id' => $request->id])
                ->update($savepage
                );
        }
        return $this->AdminPage($request->url);

    }
}
