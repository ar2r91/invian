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

Route::prefix('jerarquia')->group(function () {
    Route::get('/listjeraquia/{ruc}', 'EmpresaController@listjeraquia');
});

Route::prefix('usuarios')->group(function () {
    Route::get('/list', 'UsuariosController@list')->name('list.usuarios');
    Route::get('/listusuacat', 'UsuariosController@listusuariocategoria')->name('listusucat.usuarios');
    Route::post('/store', 'UsuariosController@store')->name('store.usuarios');
    Route::get('/{id}/show', 'UsuariosController@show')->name('show.usuarios');
});

Route::prefix('categoria')->group(function () {
    Route::get('/list', 'CategoriaController@list')->name('list.categoria');
    Route::post('/store', 'CategoriaController@store')->name('store.categoria');
    Route::get('/{id}/show', 'CategoriaController@show')->name('show.categoria');
});

Route::prefix('empresa')->group(function () {
    Route::get('/list', 'EmpresaController@list')->name('list.empresa');
    Route::post('/store', 'EmpresaController@store')->name('store.categoempresaria');
    Route::get('/{id}/show', 'EmpresaController@show')->name('show.empresa');
});