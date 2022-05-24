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


//////// RUTAS DE EL APARTADO DE USERS ////////////
Route::post('/login', 'AuthController@logIn');
Route::post('/user', 'AuthController@createuser');


//////// RUTAS DE EL APARTADO DE CLIENTES ////////////
Route::get('/clientes/{id?}', 'ClienteController@index');
Route::delete('/clientes/{id?}', 'ClienteController@destroy');
Route::put('/clientes/{id?}', 'ClienteController@update');
Route::post('/clientes', 'ClienteController@create');

//////// RUTAS DE EL APARTADO DE MASCOTAS ////////////
Route::get('/mascotas/{id?}', 'MascotasController@index');
Route::delete('/mascotas/{id?}', 'MascotasController@destroy');
Route::put('/mascotas/{id?}', 'MascotasController@update');
Route::post('/mascotas', 'MascotasController@create');

//////// RUTAS DE EL APARTADO DE USERS ////////////
Route::get('/veterinarios/{id?}', 'VeterinarioController@index');
Route::delete('/veterinarios/{id?}', 'VeterinarioController@destroy');
Route::put('/veterinarios/{id?}', 'VeterinarioController@update');
