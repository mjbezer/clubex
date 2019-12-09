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

Auth::routes();

Route::get('/', 'HomeController@index');

Route:: get('/date', function(){
    echo date('d/m/Y h:i');
});
/**
 * Rotas do Associado
 */
Route::get('/associado/register', 'AssociadoController@create')->name('associate.register');
Route::post('/associete/store', 'AssociadoController@store')->name('associate.store');
Route::get('/associate/edit/{user_id}','AssociadoController@edit');
Route::put('/associate/update/{id}', 'AssociadoController@update');
Route::get('/associates', 'AssociadoController@getAll');
Route::get('/associate/show/{id}', 'AssociadoController@show');
Route::get('/associate/getById/{id}', 'AssociadoController@getById');


/**
 * Rotas de comissão
 * 
 */
Route::post('/commission/store', 'ComissaoController@store');

/**
 * Rotas de Rendimentos
 * 
 */

Route::get('/rendimento/form', 'RendimentoController@form');
Route::post('/rendimento/store', 'RendimentoController@storeOrUpdate');
Route::put('/rendimento/update/id', 'RendimentoController@update');
Route::get('/rendimento/create', 'RendimentoController@create');

/**
 * Rotas de Saque
 * 
 */

 Route::get('/cash/create/{comissao_id}/{associado_id}/{valor}', 'SaqueController@store');
 Route::get('/cash/authorization/{id}', 'SaqueController@authorization');
Route::get('/cash/getAll', 'SaqueController@getAll');

/**
 * 
 * Rotas de Usuário
 */

 Route::get('/user/editPassword/{id}', 'UsuarioController@editPassword');
 Route::put('/user/updatePassword/{id}', 'UsuarioController@updatePassword');