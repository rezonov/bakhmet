<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    //
    public function AllGoods()
    {
//SELECT * FROM `goods` as G join goods_attributes as GA join attributes as A where GA.id_good = G.id and GA.id_attribute = A.id

        $Attrs = DB::table('attributes')
            ->join('goods_attributes', 'goods_attributes.id_attribute', '=', 'attributes.id')
            ->join('goods', 'goods_attributes.id_good', '=', 'goods.id')
            ->select('attributes.name as name', 'goods.name as Gname', 'goods_attributes.value')
            ->get();

        foreach ($Attrs as $item) {
            $finalAr[] = $item;
        }
        // die();
        // dump($finalAr);
        return view('home', ['names' => $finalAr]);
    }

    function AllCatalogs()
    {

            // Пользователь вошёл в систему...

        /*select CG.name, CG.id, (
            SELECT COUNT(*) from catalog
                 join goods_catalogs on goods_catalogs.id_catalog = catalog.id
            where catalog.id = CG.id
            ) as CN from catalog as CG
        */
        $Allc = DB::table('catalog as CG')->
        select(DB::RAW('CG.name, CG.id, CG.parent, (
            SELECT COUNT(*) from catalog 
                 join goods_catalogs on goods_catalogs.id_catalog = catalog.id
            where catalog.id = CG.id
            ) as CN'))->
        get();
        foreach ($Allc as $Cat) {
            $finalCat[] = $Cat;
        }
        return view('catalogs', ['fnames' => $finalCat]);

    }

    function ShowCatalog($id)
    {


        $Catalog = DB::table('catalog')
            ->join('goods_catalogs', 'goods_catalogs.id_catalog', '=', 'catalog.id')
            ->join('goods', 'goods_catalogs.id_good', '=', 'goods.id')
            ->where('catalog.id', '=', $id)
            ->groupBy('goods.id')
            ->select('goods.name as name', 'goods.id as id')
            ->get();

        //  dump($Catalog);
        foreach ($Catalog as $Cat) {
            $finalAr[$Cat->id][] = $Cat->id;
            $finalAr[$Cat->id][] = $Cat->name;

            $Name = $Cat->name;
            $HeaderAr[0][0] = 'Модель';
            $Attrs = DB::table('attributes')
                ->join('goods_attributes', 'goods_attributes.id_attribute', '=', 'attributes.id')
                ->join('goods', 'goods_attributes.id_good', '=', 'goods.id')
                ->select('attributes.name as name', 'goods_attributes.value', 'attributes.name as Gname')
                ->where('goods.id', '=', $Cat->id)
                ->get();
            $c = 1;
            foreach ($Attrs as $item) {

                $HeaderAr[0][$c] = $item->Gname;
                $finalAr[$Cat->id][] = $item->value;
                $c++;
            }
            $c = 1;
        }

        return view('catalog', [
            'name' => $Name,
            'fnames' => $finalAr,
            'header' => $HeaderAr
        ]);

    }

    public
    function SaveAttr(Request $request)
    {
        $Post = $request->request;
        //  dump($request->id);
        foreach ($request->Val as $key => $item) {
            DB::table('goods_attributes')
                ->where(['id_good' => $request->id, 'id_attribute' => $key])
                ->update(['value' => $item]);

        }


        $AllCatalog = DB::table('catalog')
            ->get();

        return $this->OneGood($request->id);
        //return Redirect::back();
    }

    public
    function OneGood($id)
    {

        $AllCatalog = DB::table('catalog')
            ->get();


        $Catalog = DB::table('catalog')
            ->join('goods_catalogs', 'goods_catalogs.id_catalog', '=', 'catalog.id')
            ->join('goods', 'goods_catalogs.id_good', '=', 'goods.id')
            ->select('catalog.name as name')
            ->where('goods.id', '=', $id)
            ->groupBy('catalog.name')
            ->get();


        $Attrs = DB::table('attributes')
            ->join('goods_attributes', 'goods_attributes.id_attribute', '=', 'attributes.id')
            ->join('goods', 'goods_attributes.id_good', '=', 'goods.id')
            ->select('attributes.name as name', 'goods.name as Gname', 'goods_attributes.value', 'attributes.id as id')
            ->where('goods.id', '=', $id)
            ->get();

        foreach ($Attrs as $item) {
            $finalAr[] = $item;
            $Gname = $item->Gname;
            //  dump($Gname);

        }
        // die();
        // dump($finalAr);
        return view('good', ['attrs' => $finalAr, 'Gname' => $Gname, 'AllCatalog' => $AllCatalog, 'id' => $id]);
    }
}
