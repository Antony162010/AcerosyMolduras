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
Route::get('/login', ['as' => 'login', function () {
    return view('user.login');
}]);

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::group(['middleware' => ['session']], function () {
//     Route::get('/', ['as' => 'home', 'uses' => 'ExampleController@index']);
// });

Route::fallback(function () {
    return view('error/notFound');
});
