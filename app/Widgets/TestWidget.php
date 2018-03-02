<?php

namespace App\Widgets;

use Klisl\Widgets\Contract\ContractWidget;
use Illuminate\Support\Facades\DB;
/**
 * Class TestWidget
 * Класс для демонстрации работы расширения
 * @package App\Widgets
 */
class TestWidget implements ContractWidget{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function execute(){
        $Allc = DB::table('catalog as CG')->
        select(DB::RAW('CG.name, CG.id, CG.parent, (SELECT COUNT(*) from catalog where CG.id = catalog.parent) as COut, (SELECT COUNT(*) from catalog
                 where catalog.id = CG.parent) as CIn'))->
        where('CG.parent', '=', 0)->
        get();
        //  dump($Allc);

        $html_start = '';
        $html_end = '';
        $finalmenu = '';
        foreach ($Allc as $Cat) {
            $Cat->level = '0';
            $html_start = ' <li><a href="#">' . $Cat->name . '</a>
                                        <ul class="submenu"><li ><div class="cont">';

            $html_end = '</div></li></ul></li>';
            $finalCat[] = $Cat;
            $Allc2 = DB::table('catalog as CG')->
            select(DB::RAW('CG.name, CG.latin_name,  CG.id, CG.parent, (SELECT COUNT(*) from catalog where CG.id = catalog.parent) as COut, (SELECT COUNT(*) from catalog
                 where catalog.id = CG.parent) as CIn'))->
            where('CG.parent', '=', $Cat->id)->
            get();
            $col1 = '<div class="col-md-4">';
            $col2 ='<div class="col-md-4">';
            $col3 = '<div class="col-md-4">';

            $c =0;
            foreach ($Allc2 as $Cat) {
                $Cat->level = '1';
                $finalCat[] = $Cat;
                $punkt_start = '';
                $Allc = DB::table('catalog as CG')->
                select(DB::RAW('CG.name, CG.latin_name, CG.id, CG.parent, (SELECT COUNT(*) from catalog where CG.id = catalog.parent) as COut, (SELECT COUNT(*) from catalog
                 where catalog.id = CG.parent) as CIn'))->
                where('CG.parent', '=', $Cat->id)->
                get();

                if (count($Allc) == 0) {
                    $punkt_start .= '<a href="/catalog/' . $Cat->latin_name . '.html">' . $Cat->name . '</a>
                                       ';
                    $html_end .= '';
                } else {
                    $punkt_start .= '
                                        <div class="spoiler">

<!--* Добавлен tabindex="-1" для снятия фокуса при переходе по "tab" -->
<input style="width:360px;" type="checkbox" tabindex="-1">
     <div class="box">
         <span class="close_sp">'.$Cat->name.'</span><span class="open">'.$Cat->name.'</span>
         <div class="Untext">
';



                    foreach ($Allc as $Cat) {
                        $Cat->level = '2';
                        $punkt_start .= '<a href="/catalog/' . $Cat->latin_name . '.html">' . $Cat->name . '</a>';

                        $finalCat[] = $Cat;
                    }
                    $punkt_start .= '  </div></div></div>
                                   ';

                }
                if($c < 15) {
                    $col1 .= $punkt_start;
                } elseif ($c < 30) {
                    $col2 .= $punkt_start;
                } else {
                    $col3 .= $punkt_start;
                }
                $c++;

            }
            $html_start .= $col1 .'</div>' . $col2 .'</div>' . $col3;
            $finalmenu .= $html_start . "" . $html_end;
        }
        $html_start = '';
        $html_end = '';
		return view('Widgets::test', ['menu' => $finalmenu]);
		
	}	
}
