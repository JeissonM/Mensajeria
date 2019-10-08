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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('cliente', 'ClienteController');
Route::get('cliente/{id}/delete', 'ClienteController@destroy')->name('cliente.delete');
Route::get('cliente/consulta/vista', 'ClienteController@consulta')->name('cliente.consulta');
Route::get('cliente/consulta/vista/pdf', 'ClienteController@pdf')->name('cliente.pdf');
Route::post('cliente/consulta/vista/consultar', 'ClienteController@consultar')->name('cliente.consultar');
Route::get('cliente/consulta/vista/consultar/{campo}/{valor}/pdf', 'ClienteController@consultarpdf')->name('cliente.consultarpdf');
Route::resource('user', 'UserController');
Route::put('user/{user}/update/password', 'UserController@updatePassword')->name('user.updatePassword');
