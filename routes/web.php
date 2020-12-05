<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('vartotojai', 'HomeController@visiVartotojai');
});

Route::group(['middleware' => ['auth1']], function() {
    Route::get('/', 'RenginiaiTController@index');
    Route::get('/home', 'RenginiaiTController@index');
    Route::get('renginiai', 'RenginiaiTController@index');


    Route::get('renginys', 'RenginiaiTController@create');
    Route::get('mano-renginiai', 'RenginiaiTController@mano');
    Route::get('renginys/{id}/edit', 'RenginiaiTController@edit');
    Route::get('renginys/{id}/show', 'RenginiaiTController@show');
    Route::get('renginys/{id}/register', 'RenginiaiTController@register');
    Route::get('renginys/{id}/signout', 'RenginiaiTController@signout');
    Route::post('renginys', 'RenginiaiTController@store');
    Route::put('renginyss/{id}', 'RenginiaiTController@update');
    Route::get('renginys/{id}/delete', 'RenginiaiTController@destroy')->name('deleteRenginys');
    Route::get('vartotojas/{id}/delete', 'HomeController@destroy')->name('deleteVartotojas');

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

});

Auth::routes();

//Route::group(['middleware' => ['auth', 'renginio_organizatorius']], function() {
//    Route::get('vartotojai', 'HomeController@visiVartotojai');
//});

//Route::get('vartotojai', 'HomeController@visiVartotojai');







