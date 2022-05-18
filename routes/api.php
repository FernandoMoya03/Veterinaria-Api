<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//////// RUTAS DE EL APARTADO DE CLIENTES ////////////
Route::get('/clientes/{id?}', 'ClienteController@index');
Route::delete('/clientes/{id?}', 'ClienteController@destroy');
Route::put('/clientes/{id?}', 'ClienteController@update');
Route::post('/clientes', 'ClienteController@create');