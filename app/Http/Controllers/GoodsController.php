<?php

namespace App\Http\Controllers;

use App\catalogs;
use App\Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

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
        return view('admin/home', ['names' => $finalAr]);
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
        return view('admin/catalogs', ['fnames' => $finalCat]);

    }

    function EditCatalogs($id)
    {

        $Attrs = DB::table('attributes')
            ->join('catalogs__attributes', 'catalogs__attributes.id_attribute', '=', 'attributes.id')
            ->select('attributes.name as name', 'attributes.type as type', 'attributes.id as id')
            ->where('catalogs__attributes.id_catalog', '=', $id)
            ->get();
        dump($Attrs);
        foreach ($Attrs as $item) {
            $finalAr[] = $item;


        }
        return view('admin/editcatalogs', ['fnames' => $finalAr]);

    }


    public function ShowPublicCatalog($id, $start=0)
    {

        /*
         *select goods.id, goods_catalogs.id_catalog, goods.name from `goods`, `goods_catalogs`
        where `goods`.id = `goods_catalogs`.`id_good` and
        `goods_catalogs`.`id_catalog` = 1
        GROUP by id_good
         */

        $Catalog = DB::table('catalog')
                ->join('goods_catalogs', 'goods_catalogs.id_catalog', '=', 'catalog.id')
                ->join('goods', 'goods_catalogs.id_good', '=', 'goods.id')
                ->groupBy('goods.id')
                ->where('catalog.id', '=', $id)
                ->select('goods.name as name', 'goods.id as id')
                ->skip($start)
                ->take(1000)
                ->get();



        foreach ($Catalog as $Cat) {
            $finalAr[$Cat->id][] = $Cat->id;
            $finalAr[$Cat->id][] = $Cat->name;
            // dump($finalAr);
            $HeaderAr[0]['name'] = "Модель";
            $HeaderAr[0]['type'] = 'text';
            $HeaderAr[0]['id'] = 0;
            $HeaderAr[0]['min'] = 0;
            $HeaderAr[0]['max'] = 0;
            $Attrs = DB::table('attributes')
                ->join('goods_attributes', 'goods_attributes.attributes_id', '=', 'attributes.id')
                ->join('goods', 'goods_attributes.id_good', '=', 'goods.id')
                ->select('attributes.name as name', 'attributes.id as id', 'goods_attributes.value as value', 'attributes.name as Gname', 'attributes.type as type')
                ->where('goods.id', '=', $Cat->id)
                ->get();
            $c = 1;

            foreach ($Attrs as $item) {

                $HeaderAr[$c]['name'] = $item->Gname;
                $HeaderAr[$c]['type'] = $item->type;
                $HeaderAr[$c]['id'] = $item->id;
                $ValueArr[$c][]=$item->value;
                    $finalAr[$Cat->id][] = $item->value;
                $c++;
            }

        }

        for($i=1;$i<=count($ValueArr);$i++) {
            if(!empty(min($ValueArr[$i]))) {
            $HeaderAr[$i]['min'] = min($ValueArr[$i]);
            }
            else {
                $HeaderAr[$i]['min'] = 0;
            }
            $HeaderAr[$i]['max'] = max($ValueArr[$i]);
        }

        return view('header', [
            'header' => $HeaderAr,
            'data' => $finalAr,

        ]);

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
                ->join('goods_attributes', 'goods_attributes.attributes_id', '=', 'attributes.id')
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

        return view('admin/catalog', [
            'name' => $Name,
            'fnames' => $finalAr,
            'header' => $HeaderAr
        ]);

    }

    public function SaveAttr(Request $request)
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
            ->join('goods_attributes', 'goods_attributes.attributes_id', '=', 'attributes.id')
            ->join('goods', 'goods_attributes.id_good', '=', 'goods.id')

            ->select('attributes.name as name', 'goods.name as Gname', 'goods_attributes.value', 'attributes.id as id')
            ->where('goods.id', '=', $id)
            ->get();

        foreach ($Attrs as $item) {
            $finalAr[] = $item;
            $Gname = $item->Gname;
            //  dump($Gname);

        }
        $Descriptions = DB::table('goods')
            ->join('descriptions', 'descriptions.id', '=', 'goods.id')
            ->where('goods.id', '=', $id)
            ->get();

        // die();
        // dump($finalAr);
        return view('admin/good',
            ['attrs' => $finalAr,
                'Gname' => $Gname,
                'AllCatalog' => $AllCatalog,
                'Descriptions' => $Descriptions,
                'id' => $id
            ]);
    }
}
