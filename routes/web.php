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



Auth::routes();

Route::get('/catalog/{id}/{start}', 'GoodsController@ShowPublicCatalog');
Route::post('/actions/json', 'GoodsController@JsonCatalog');
/*
 * Административная часть
 */
Route::get('/admin', function () {
    return view('admin/dashboard');
})->middleware('auth');

Route::get('/categories', function (){
    return view ('admin/categories');
})->middleware('auth');




Route::post('/admin/goods/save/', ['uses' => 'GoodsController@SaveAttr']);
Route::post('/admin/catalogs/edit/', ['uses' => 'GoodsController@SaveEditCatalog']);
Route::get('/дщпшт', 'HomeController@index')->name('home');
Route::get('/admin/catalogs', 'GoodsController@AllCatalogs')->middleware('auth');
Route::get('/admin/catalog/{id}', 'GoodsController@ShowCatalog')->middleware('auth');;
Route::get('/admin/catalog/edit/{id}', 'GoodsController@EditCatalogs')->middleware('auth');;
Route::get('/admin/catalogs/excel/{id}', 'GoodsController@SaveExcel')->middleware('auth');;

Route::get('/admin/goods/{id}', 'GoodsController@OneGood')->middleware('auth');
Route::get('/attrs', 'AttributesController@AllAttributes')->middleware('auth');

Route::get('/admin/import', 'GoodsController@ImportCatalog')->middleware('auth');
Route::post('/postDiamond', [
    'as' => 'postDiamond',
    'uses' => 'GoodsController@postDiamond'
]);
Route::get('/admin/excel/{filename}', 'GoodsController@ShowExcel');
Route::get('/admin/settings', 'SettingsController@ShowAttr');