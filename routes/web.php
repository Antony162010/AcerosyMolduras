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

/* Rutas iniciales */
Route::get('/login', ['as' => 'login', 'uses' => 'AdminController@index']);
Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/signin', ['as' => 'signin', 'uses' => 'AdminController@signin']);
Route::get('/products', ['as' => 'productos.index', 'uses' => 'ProductController@index']);

Route::group(['middleware' => ['session']], function () {
    Route::get('/home', ['as' => 'home', 'uses' => 'AdminController@home']);

    // Almacen
    Route::group(['prefix' => 'store_house'], function () {
        Route::get('/', ['as' => 'store_house.index', 'uses' => 'StoreHouseController@index']);
        Route::get('/create', ['as' => 'store_house.create', 'uses' => 'StoreHouseController@create']);
        Route::post('/save', ['as' => 'store_house.save', 'uses' => 'StoreHouseController@save']);
        Route::put('/edit', ['as' => 'store_house.edit', 'uses' => 'StoreHouseController@edit']);
        Route::get('/update', ['as' => 'store_house.update', 'uses' => 'StoreHouseController@update']);
        Route::delete('/destroy', ['as' => 'store_house.destroy', 'uses' => 'StoreHouseController@destroy']);
        Route::post('/info', ['as' => 'store_house.info', 'uses' => 'StoreHouseController@info']);
        Route::post('/store', ['as' => 'store_house.store', 'uses' => 'StoreHouseController@store']);
    });

    // Productos
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', ['as' => 'product.index', 'uses' => 'ProductController@index']);
        Route::get('/create', ['as' => 'product.create', 'uses' => 'ProductController@create']);
        Route::post('/save', ['as' => 'product.save', 'uses' => 'ProductController@save']);
        Route::put('/edit', ['as' => 'product.edit', 'uses' => 'ProductController@edit']);
        Route::get('/update', ['as' => 'product.update', 'uses' => 'ProductController@update']);
        Route::delete('/destroy', ['as' => 'product.destroy', 'uses' => 'ProductController@destroy']);
    });

    /* Cualquier ruta externa no funciona */
    Route::fallback(function () {
        return view('error/notFound');
    });
});
