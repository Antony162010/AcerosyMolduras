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
Route::get('/login', ['as' => 'login', 'uses' => 'AdminController@login']);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/products', ['as' => 'productos.index', 'uses' => 'ProductController@index']);

// Route::group(['middleware' => ['session']], function () {
//     Route::get('/mm', ['as' => 'home', 'uses' => 'ExampleController@index']);
// });

Route::fallback(function () {
    return view('error/notFound');
});
