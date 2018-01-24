<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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

    public function PostCatalog(Request $request)
    {
        $product = Product::create($request->all());
        ProductPhoto::whereIn('id', explode(",", $request->file_ids))
            ->update(['product_id' => $product->id]);
        return 'Product saved successfully';
    }

    public function UploadCatalog(Request $request)
    {
        $photos = [];

        foreach ($request->photos as $photo) {
            $filename = $photo->store('photos');

            $photo_object = new \stdClass();
            $photo_object->name = $filename;

            $photos[] = $photo_object;
        }

        return response()->json(array('files' => $photos), 200);
    }

    public function ShowExcel($filename)
    {


        $filename = '/public/uploads/' . $filename;
        $r = Excel::load($filename, function ($reader) {

            // Getting all results
            $results = $reader->first();

            $results = $reader->all()->toArray();

            //dump($results);
            $html = '<table><tr>';
            foreach ($results[0] as $key => $value) {
                $html .= '<td>' . $this->translit($key) . '</td>';
            }
            $html .= '</tr>';

            foreach ($results as $rows) {
                $html .= '<tr>';
                foreach ($rows as $key => $value) {
                    $html .= '<td>' . $value . '</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</table>';
            echo $html;
            return $html;
            // ->all() is a wrapper for ->get() and will work the same
            //        return json(array($results));

        });


    }

    public function translit($word)
    {
        $translit = array(

            'а' => 'a', 'б' => 'b', 'в' => 'v',

            'г' => 'g', 'д' => 'd', 'е' => 'e',

            'ё' => 'yo', 'ж' => 'zh', 'з' => 'z',

            'и' => 'i', 'й' => 'j', 'к' => 'k',

            'л' => 'l', 'м' => 'm', 'н' => 'n',

            'о' => 'o', 'п' => 'p', 'р' => 'r',

            'с' => 's', 'т' => 't', 'у' => 'u',

            'ф' => 'f', 'х' => 'x', 'ц' => 'c',

            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shh',

            'ь' => '\'', 'ы' => 'y', 'ъ' => '\'\'',

            'э' => 'e\'', 'ю' => 'yu', 'я' => 'ya',


            'А' => 'A', 'Б' => 'B', 'В' => 'V',

            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',

            'Ё' => 'YO', 'Ж' => 'Zh', 'З' => 'Z',

            'И' => 'I', 'Й' => 'J', 'К' => 'K',

            'Л' => 'L', 'М' => 'M', 'Н' => 'N',

            'О' => 'O', 'П' => 'P', 'Р' => 'R',

            'С' => 'S', 'Т' => 'T', 'У' => 'U',

            'Ф' => 'F', 'Х' => 'X', 'Ц' => 'C',

            'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SHH',

            'Ь' => '\'', 'Ы' => 'Y\'', 'Ъ' => '\'\'',

            'Э' => 'E\'', 'Ю' => 'YU', 'Я' => 'YA',

        );
        $word = strtr($word, array_flip($translit));
        return $word;
    }

    public function postDiamond(Request $request)
    {
        $supplier_name = $request->supplier_name;
        $extension = $request->file('file');
        $extension = $request->file('file')->getClientOriginalExtension(); // getting excel extension
        $dir = 'uploads/';
        $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
        $request->file('file')->move($dir, $filename);
        return $filename;
    }

    public function ImportCatalog()
    {
        return view('admin/importexcel');
    }

    function AllCatalogs()
    {


        $Allc = DB::table('catalog as CG')->
        select(DB::RAW('CG.name, CG.id, CG.parent, (SELECT COUNT(*) from catalog where CG.id = catalog.parent) as COut, (SELECT COUNT(*) from catalog
                 where catalog.id = CG.parent) as CIn'))->
        where('CG.parent', '=', 0)->
        get();
        //  dump($Allc);
        foreach ($Allc as $Cat) {
            $Cat->level = '0';
            $finalCat[] = $Cat;
            $Allc2 = DB::table('catalog as CG')->
            select(DB::RAW('CG.name, CG.id, CG.parent, (SELECT COUNT(*) from catalog where CG.id = catalog.parent) as COut, (SELECT COUNT(*) from catalog
                 where catalog.id = CG.parent) as CIn'))->
            where('CG.parent', '=', $Cat->id)->
            get();
            foreach ($Allc2 as $Cat) {
                $Cat->level = '1';
                $finalCat[] = $Cat;
                $Allc = DB::table('catalog as CG')->
                select(DB::RAW('CG.name, CG.id, CG.parent, (SELECT COUNT(*) from catalog where CG.id = catalog.parent) as COut, (SELECT COUNT(*) from catalog
                 where catalog.id = CG.parent) as CIn'))->
                where('CG.parent', '=', $Cat->id)->
                get();
                foreach ($Allc as $Cat) {
                    $Cat->level = '2';
                    $finalCat[] = $Cat;
                }
            }
        }
        return view('admin/catalogs', ['fnames' => $finalCat]);

    }

    public function SaveEditCatalog(Request $request)
    {
        $Attrs = DB::table('attributes')
            ->join('catalogs__attributes', 'catalogs__attributes.id_attribute', '=', 'attributes.id')
            ->select('attributes.name as name',
                'attributes.type as type',
                'attributes.id as id',
                'catalogs__attributes.sh as sh',
                'catalogs__attributes.fl as fl',
                'catalogs__attributes.id_catalog as IdC',
                'catalogs__attributes.id_attribute as IdA'
            )
            ->where('catalogs__attributes.id_catalog', '=', $request->id)
            ->get();

        foreach ($Attrs as $item) {
            if (!isset($request->sh[$item->id])) {
                DB::table('catalogs__attributes')
                    ->where(['id_catalog' => $request->id, 'id_attribute' => $item->id])
                    ->update(['sh' => 'Off']);
            } else {
                DB::table('catalogs__attributes')
                    ->where(['id_catalog' => $request->id, 'id_attribute' => $item->id])
                    ->update(['sh' => 'on']);
            }

            if (!isset($request->fl[$item->id])) {
                DB::table('catalogs__attributes')
                    ->where(['id_catalog' => $request->id, 'id_attribute' => $item->id])
                    ->update(['fl' => 'Off']);
            } else {
                DB::table('catalogs__attributes')
                    ->where(['id_catalog' => $request->id, 'id_attribute' => $item->id])
                    ->update(['fl' => 'on']);
            }
        }
        //dump($request->request);

        return $this->EditCatalogs($request->id);
    }

    function EditCatalogs($id)
    {

        $Attrs = DB::table('attributes')
            ->join('catalogs__attributes', 'catalogs__attributes.id_attribute', '=', 'attributes.id')
            ->select('attributes.name as name',
                'attributes.type as type',
                'attributes.id as id',
                'catalogs__attributes.sh as sh',
                'catalogs__attributes.fl as fl',
                'catalogs__attributes.id_catalog as IdC',
                'catalogs__attributes.id_attribute as IdA'
            )
            ->where('catalogs__attributes.id_catalog', '=', $id)
            ->get();
        //    dump($Attrs);
        foreach ($Attrs as $item) {
            $finalAr[] = $item;


        }
        return view('admin/editcatalogs', ['fnames' => $finalAr, 'id' => $id]);

    }

    public function ShowPublicCatalog($id, $start = 0)
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
            ->get();
        $finalmenu = '';

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
                $ValueArr[$c][] = $item->value;
                $finalAr[$Cat->id][] = $item->value;
                $c++;
            }

            $Descrs = DB::table('descriptions')
                ->select('text', 'file')
                ->where('id', '=', $Cat->id)
                ->get();

            foreach ($Descrs as $dd) {
                $Descs[$Cat->id]['text'] = htmlspecialchars_decode($dd->text);
                $Descs[$Cat->id]['file'] = $dd->file;
            }
        }

        for ($i = 1; $i <= count($ValueArr); $i++) {
            if (!empty(min($ValueArr[$i]))) {
                $HeaderAr[$i]['min'] = min($ValueArr[$i]);
            } else {
                $HeaderAr[$i]['min'] = 0;
            }
            $HeaderAr[$i]['max'] = max($ValueArr[$i]);
        }

        $Allc = DB::table('catalog as CG')->
        select(DB::RAW('CG.name, CG.id, CG.parent, (SELECT COUNT(*) from catalog where CG.id = catalog.parent) as COut, (SELECT COUNT(*) from catalog
                 where catalog.id = CG.parent) as CIn'))->
        where('CG.parent', '=', 0)->
        get();
        //  dump($Allc);
        $html_start = '';
        $html_end = '';
        foreach ($Allc as $Cat) {
            $Cat->level = '0';
            $html_start = ' <li><a href="#">' . $Cat->name . '</a>
                                        <ul class="submenu">';

            $html_end = '</ul></li>';
            $finalCat[] = $Cat;
            $Allc2 = DB::table('catalog as CG')->
            select(DB::RAW('CG.name, CG.id, CG.parent, (SELECT COUNT(*) from catalog where CG.id = catalog.parent) as COut, (SELECT COUNT(*) from catalog
                 where catalog.id = CG.parent) as CIn'))->
            where('CG.parent', '=', $Cat->id)->
            get();
            foreach ($Allc2 as $Cat) {
                $Cat->level = '1';
                $finalCat[] = $Cat;

                $Allc = DB::table('catalog as CG')->
                select(DB::RAW('CG.name, CG.id, CG.parent, (SELECT COUNT(*) from catalog where CG.id = catalog.parent) as COut, (SELECT COUNT(*) from catalog
                 where catalog.id = CG.parent) as CIn'))->
                where('CG.parent', '=', $Cat->id)->
                get();
                if (count($Allc) == 0) {
                    $html_start .= '<li><a href="/catalog/' . $Cat->id . '/0">' . $Cat->name . '</a>
                                       ';
                    $html_end .= '</li>';
                } else {
                    $html_start .= '<li>
                                        <div class="spoiler">

                                            <input type="checkbox">' . $Cat->name .
                        '
                                            <div class="box">';


                    foreach ($Allc as $Cat) {
                        $Cat->level = '2';
                        $html_start .= '<a href="/catalog/' . $Cat->id . '/0">' . $Cat->name . '</a>';

                        $finalCat[] = $Cat;
                    }
                    $html_start .= '  </div> </div>
                                    </li>';

                }
            }
            $finalmenu .= $html_start . "" . $html_end;
        }

        return view('header', [
            'header' => $HeaderAr,
            'data' => $finalAr,
            'descs' => $Descs,
            'menu' => $finalmenu,

        ]);

    }

    public function SaveExcel($id)
    {
        $finalAr = array();

        $Catalog = DB::table('catalog')
            ->join('goods_catalogs', 'goods_catalogs.id_catalog', '=', 'catalog.id')
            ->join('goods', 'goods_catalogs.id_good', '=', 'goods.id')
            ->where('catalog.id', '=', $id)
            ->groupBy('goods.id')
            ->select('goods.name as name', 'goods.id as id')
            ->get();

        //  dump($Catalog);
        foreach ($Catalog as $Cat) {

            $finalAr[$Cat->id][] = $Cat->name;

            $Name = $Cat->name;
            // $HeaderAr[0][0] = 'Модель';
            $Attrs = DB::table('attributes')
                ->join('goods_attributes', 'goods_attributes.attributes_id', '=', 'attributes.id')
                ->join('goods', 'goods_attributes.id_good', '=', 'goods.id')
                ->select('attributes.name as name', 'goods_attributes.value', 'attributes.name as Gname')
                ->where('goods.id', '=', $Cat->id)
                ->get();
            $c = 1;
            $HeaderAr2 = array('Модель');
            foreach ($Attrs as $item) {
                $HeaderAr2[] = $item->Gname;
                $finalAr[$Cat->id][] = $item->value;
            }
        }


        foreach ($HeaderAr2 as $key => $value) {
            $HeaderAr3[] = $value;
        }
        $HeaderAr = $HeaderAr3;
        // dump($HeaderAr);
        foreach ($finalAr as $item) {

            foreach ($item as $key => $value) {
                $FArray[] = $value;
            }
            $FinalArray[] = $FArray;
            $FArray = array();
        }
        //  dump($FinalArray);

        Excel::create('Filename', function ($excel) use ($FinalArray, $HeaderAr) {
            $excel->sheet('Sheetname', function ($sheet) use ($FinalArray, $HeaderAr) {

                $sheet->appendRow($HeaderAr);
                $sheet->row(1, function ($row) {

                    // call cell manipulation methods
                    $row->setBackground('#367fa9');
                    $row->setFontColor('#ffffff');

                });
                foreach ($FinalArray as $item) {
                    $sheet->appendRow($item);
                }
            });

        })->export('xls');


        /*$excel->sheet('Sheetname', function ($sheet) use ($FinalArray, $HeaderAr) {
            $sheet->appendRow($HeaderAr);
            /*$sheet->row(1, function($row) {
                // call cell manipulation methods
                $row->setBackground('#367fa9');
                $row->setFontColor('#ffffff');
            });
            foreach ($FinalArray as $item) {
                //$sheet->appendRow($item);
            }
        });*/


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
                ->join('catalogs__attributes', 'catalogs__attributes.id_attribute', '=', 'attributes.id')
                ->select('attributes.name as name', 'goods_attributes.value', 'attributes.name as Gname', 'catalogs__attributes.sh as Sh')
                ->where('goods.id', '=', $Cat->id)
                ->groupBy('goods_attributes.id')
                ->get();
            //dump($Attrs);
            $c = 1;
            foreach ($Attrs as $item) {
                if ($item->Sh != 'Off') {
                    $HeaderAr[0][$c] = $item->Gname;
                    $finalAr[$Cat->id][] = $item->value;
                    $c++;
                }
            }
            $c = 1;
        }

        return view('admin/catalog', [
            'name' => $Name,
            'fnames' => $finalAr,
            'header' => $HeaderAr,
            'id' => $id
        ]);

    }

    public function SaveImage(Request $request)
    {
        $Post = $request->request;


        $AllCatalog = DB::table('catalog')->get();
        DB::table('descriptions')
            ->where('id', "=", $request->id)
            ->update(['file' => $request->image]);
        return $this->OneGood($request->id);

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

        $Seo = DB::table('goods__seo')
            ->join('goods', 'goods.id', '=', 'goods__seo.id')
            ->where('goods.id', '=', $id)
            ->get();

        // die();
        // dump($finalAr);
        return view('admin/good',
            ['attrs' => $finalAr,
                'Gname' => $Gname,
                'AllCatalog' => $AllCatalog,
                'Descriptions' => $Descriptions,
                'Seo' => $Seo,
                'id' => $id
            ]);
    }


    public function SaveDescr(Request $request)
    {
        $Post = $request->request;


        $AllCatalog = DB::table('catalog')->get();
        DB::table('descriptions')
            ->where('id', "=", $request->id)
            ->update(['text' => $request->text]);
        return $this->OneGood($request->id);

    }

    public function SaveAttr(Request $request)
    {
        $Post = $request->request;
        //  dump($request->id);
        foreach ($request->Val as $key => $item) {
            DB::table('goods_attributes')
                ->where(['id_good' => $request->id, 'attributes_id' => $key])
                ->update(['value' => $item]);

        }
        $values = array("text" => $request->text);
        $seo = array("title" => $request->seotitle, "keywords" => $request->seokeywords, "keywords" => $request->seodescription);
        if ($request->image != '') {
            $values['file'] = $request->image;
        }


        DB::table('descriptions')
            ->where('id', "=", $request->id)
            ->update($values);
        $row = DB::table('goods__seo')
            ->where('id', "=", $request->id)
            ->get();
        if (count($row) > 0) {
            DB::table('goods__seo')
                ->where('id', "=", $request->id)
                ->update($seo);
        } else {
            $seo['id'] = $request->id;
            DB::table('goods__seo')
                ->insert($seo);
        }
        $AllCatalog = DB::table('catalog')
            ->get();

        return $this->OneGood($request->id);
        //return Redirect::back();
    }
}
