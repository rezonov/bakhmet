<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/categories', function (){
    return view ('categories');
})->middleware('auth');

Auth::routes();

Route::post('/admin/goods/save/', ['uses' => 'GoodsController@SaveAttr']);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/catalogs', 'GoodsController@AllCatalogs')->middleware('auth');
Route::get('/admin/catalog/{id}', 'GoodsController@ShowCatalog')->middleware('auth');;


Route::get('/admin/goods/{id}', 'GoodsController@OneGood')->middleware('auth');;
Route::get('/attrs', 'AttributesController@AllAttributes')->middleware('auth');;

