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

Route::get('/', function () {
    return view('vendor.adminlte.auth.login');
});


Route::get('/fichaevaluacion', function () {
    return view('vendor.adminlte.auth.fichaevaluaciondt');
});

Route::resource('ranexo04','Anexo04Controller');
Route::resource('actividad','ActividadController');
Route::get('generarAnexo04/{id}', 'Anexo04Controller@generarFicha04');


Route::resource('rfichaevaluacion','FichaEvaluacionController');
Route::GET('rfichaevaluacion/{tipopersonal}/create','FichaEvaluacionController@create');




Route::group(['middleware' => 'auth'], function () {

});
