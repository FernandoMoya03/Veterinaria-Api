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
// LOGIN
Route::post('/login', 'AuthController@logIn');
Route::post('/us/registro', 'AuthController@createuser');
// LOGOUT
Route::post('/logout', 'AuthController@logIn');

//////// RUTAS DE EL APARTADO DE CLIENTES ////////////
Route::middleware("auth:sanctum")->get('/clientes/{id?}', 'ClienteController@index');
Route::middleware('auth:sanctum')->delete('/clientes/{id?}', 'ClienteController@destroy');
Route::middleware('auth:sanctum')->put('/clientes/{id?}', 'ClienteController@update');
Route::middleware('auth:sanctum')->post('/clientes', 'ClienteController@create');

//////// RUTAS DE EL APARTADO DE MASCOTAS ////////////
Route::get('/mascotas/{id?}', 'MascotasController@index');
Route::delete('/mascotas/{id?}', 'MascotasController@destroy');
Route::put('/mascotas/{id?}', 'MascotasController@update');
Route::post('/mascotas', 'MascotasController@create');

//////// RUTAS DE EL APARTADO DE CITAS ////////////
Route::get('/citas/{id?}', 'CitaController@index');
Route::delete('/citas/{id?}', 'CitaController@destroy');
Route::put('/citas/{id?}', 'CitaController@update');
Route::post('/citas', 'CitaController@create');

//////// RUTAS DE EL APARTADO DE HISTORIAL CLINICO ////////////
Route::get('/h_c/{id?}', 'HistorialClinicoController@index');
Route::delete('/h_c/{id?}', 'HistorialClinicoController@destroy');
Route::put('/h_c/{id?}', 'HistorialClinicoController@update');
Route::post('/h_c', 'HistorialClinicoController@create');

//////// RUTAS DE EL APARTADO DE SERVICIOS ////////////
Route::get('/servicios/{id?}', 'ServicioController@index');
Route::post('/servicios', 'ServicioController@create');
Route::delete('/servicios/{id?}', 'ServicioController@destroy');
Route::put('/servicios/{id?}', 'ServicioController@update');



//////// RUTAS DE EL APARTADO DE VETERINARIOS ////////////
//Route::get('/veterinarios/{id?}', 'VeterinarioController@index');
//Route::delete('/veterinarios/{id?}', 'VeterinarioController@destroy');
//Route::put('/veterinarios/{id?}', 'VeterinarioController@update');