<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // $route = url()->full();

    // dd($route);
    
    // $posicion_barra = strpos($route, "/");
    // $posicion_punto = strpos($route, ".");

    // $resultado = substr($route, $posicion_barra + 2, $posicion_punto - $posicion_barra - 2);

    // dd($resultado);
    // return 'Aquí no es.';
    return view('welcome');
});


//API TOKEN UB41SSMWFGGMVWFO5FTW69IC479NYBGF


//Thank you for being on hold.I really appreciate! As I checked the subdomains will not be created  automatically Marco, using an API will not work, that will need root access.


