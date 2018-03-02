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
Route::get('/', 'PagesController@ShowIndex' );
Route::get('good/{catalog}/{url}.html', 'GoodsController@GetOneGood' );
Route::get('/catalog/{id}.html', 'GoodsController@ShowPublicCatalog');
Route::post('/actions/json', 'GoodsController@JsonCatalog');
/*
 * Административная часть
 */
Route::get('/{name}.html', 'PagesController@ShowPage' );

Route::post('/sendmail', 'ClientsController@Record');
Route::get('/admin', function () {
    return view('admin/dashboard');
})->middleware('auth');

Route::get('/categories', function (){
    return view ('admin/categories');
})->middleware('auth');



Route::get('/admin/clients', 'ClientsController@Show')->middleware('auth');
Route::get('/admin/clients/show/{id}', 'ClientsController@ShowClient')->middleware('auth');

Route::post('/admin/goods/save/', ['uses' => 'GoodsController@SaveAttr']);
Route::post('/admin/catalogs/edit/', ['uses' => 'GoodsController@SaveEditCatalog']);
Route::get('/дщпшт', 'HomeController@index')->name('home');
Route::get('/admin/catalogs', 'GoodsController@AllCatalogs')->middleware('auth');
Route::get('/admin/catalog/{id}', 'GoodsController@ShowCatalog')->middleware('auth');;
Route::get('/admin/catalog/edit/{id}', 'GoodsController@EditCatalogs')->middleware('auth');;
Route::get('/admin/catalogs/excel/{id}', 'GoodsController@SaveExcel')->middleware('auth');

Route::get('/admin/pages', 'PagesController@AdminPages')->middleware('auth');
Route::post('/admin/page/save/', ['uses' => 'PagesController@SavePage'])->middleware('auth');
Route::get('/admin/page/add', 'PagesController@AddPage')->middleware('auth');
Route::get('/admin/page/{name}', 'PagesController@AdminPage')->middleware('auth');

Route::get('/admin/goods/{id}', 'GoodsController@OneGood')->middleware('auth');
Route::get('/attrs', 'AttributesController@AllAttributes')->middleware('auth');

Route::get('/admin/import', 'GoodsController@ImportCatalog')->middleware('auth');
Route::post('/postDiamond', [
    'as' => 'postDiamond',
    'uses' => 'GoodsController@postDiamond'
]);
Route::get('/admin/excel/{filename}', 'GoodsController@ShowExcel');
Route::get('/admin/settings', 'SettingsController@ShowSettings')->middleware('auth');
Route::post('/admin/settings/save/', ['uses' => 'SettingsController@SaveSet'])->middleware('auth');
Route::post('/admin/catalogs/change/', ['uses' => 'GoodsController@ChangeOrder']);
Route::get('/admin/rasstsort', 'GoodsController@RasstSort')->middleware('auth');
Route::get('/admin/catalogs/names', 'GoodsController@GetListUrl')->middleware('auth');
Route::get('/admin/catalogs/goodsurls', 'GoodsController@GetGoodsUrl')->middleware('auth');
Route::post('/search/', 'GoodsController@Search');