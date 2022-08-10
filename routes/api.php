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
// LOGOUT
Route::post('/logout', 'AuthController@logIn');
// REGISTRAR
Route::post('/us/registro', 'AuthController@createuser');
// CONSULTAS USUARIOS
Route::middleware('auth:sanctum')->get('/usr/veterinarios/', 'AuthController@getVeterinarios');
Route::middleware('auth:sanctum')->get('/usr/asistentes/', 'AuthController@getAsistente');
Route::middleware('auth:sanctum')->get('/usr/todos/', 'AuthController@getAllUsuarios');
Route::middleware('auth:sanctum')->get('/usr/perfil/', 'AuthController@perfil');

//////// RUTAS DE EL APARTADO DE CLIENTES /////////////
Route::middleware('auth:sanctum')->get('/clientes/{id?}', 'ClienteController@index');
Route::middleware('auth:sanctum')->delete('/clientes/{id?}', 'ClienteController@destroy');
Route::middleware('auth:sanctum')->put('/clientes/{id?}', 'ClienteController@update');
Route::middleware('auth:sanctum')->post('/clientes', 'ClienteController@create');
////////////////////////////////////////////////////////
Route::put('/clientes/changeStatus/{id?}', 'ClienteController@changeStatus');

//////// RUTAS DE EL APARTADO DE MASCOTAS //////////////
Route::middleware("auth:sanctum")->get('/mascotas/{id?}', 'MascotasController@index');
Route::middleware("auth:sanctum")->delete('/mascotas/{id?}', 'MascotasController@destroy');
Route::middleware("auth:sanctum")->put('/mascotas/{id?}', 'MascotasController@update');
Route::middleware("auth:sanctum")->post('/mascotas', 'MascotasController@create');
///////////////////////////////////////////////////////
Route::put('/mascotas/changeStatus/{id?}', 'MascotasController@changeStatus');

//////// RUTAS DE EL APARTADO DE CITAS ////////////////
Route::middleware('auth:sanctum')->get('/citas/{id?}', 'CitaController@index');
Route::middleware('auth:sanctum')->delete('/citas/{id?}', 'CitaController@destroy');
Route::middleware('auth:sanctum')->put('/citas/{id?}', 'CitaController@update');
Route::middleware('auth:sanctum')->post('/citas', 'CitaController@create');
///////////////////////////////////////////////////////
Route::put('/citas/changeStatus/{id?}', 'CitaController@changeStatus');

//////// RUTAS DE EL APARTADO DE HISTORIAL CLINICO ////////////
Route::middleware('auth:sanctum')->get('/h_c/{id?}', 'HistorialClinicoController@index');
Route::middleware('auth:sanctum')->delete('/h_c/{id?}', 'HistorialClinicoController@destroy');
Route::middleware('auth:sanctum')->put('/h_c/{id?}', 'HistorialClinicoController@update');
Route::middleware('auth:sanctum')->post('/h_c', 'HistorialClinicoController@create');
///////////////////////////////////////////////////////

//////// RUTAS DE EL APARTADO DE SERVICIOS ////////////
Route::middleware('auth:sanctum')->get('/servicios/{id?}', 'ServicioController@index');
Route::middleware('auth:sanctum')->post('/servicios', 'ServicioController@create');
Route::middleware('auth:sanctum')->delete('/servicios/{id?}', 'ServicioController@destroy');
Route::middleware('auth:sanctum')->put('/servicios/{id?}', 'ServicioController@update');
///////////////////////////////////////////////////////

///////////////////////////////////////////// CONSULTAS /////////////////////////////////////////////
//////// ClienteMascota ////////////
Route::middleware('auth:sanctum')->get('/clienteMascota','ClienteController@nombreClienteMascota');
//////// Datos completos de la Cita ////////////
Route::middleware('auth:sanctum')->get('/citasCompleta','CitaController@indexCompleto');
//////// Datos completos de la Cita ////////////
Route::middleware('auth:sanctum')->get('/cli_mascota','ClienteController@clienteMascota');




//////// RUTAS DE EL APARTADO DE VETERINARIOS ////////////
//Route::get('/veterinarios/{id?}', 'VeterinarioController@index');
//Route::delete('/veterinarios/{id?}', 'VeterinarioController@destroy');
//Route::put('/veterinarios/{id?}', 'VeterinarioController@update');