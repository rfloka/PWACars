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
/* landing page */
Route::get('/',  'SiteController@landing');
Route::view('/offline', 'Offline');
/* perfil page */
Route::get('/perfil',  'SiteController@perfil');
Route::get('/perfil/{id}/delete',  'SiteController@deletecarperf');
Route::post('/perfil/updatepic',  'SiteController@updateavatar');
/* contactos pages */
Route::get('/contactos',  'ContactosController@index');
Route::post('/contactos/mensagem', 'ContactosController@mensagem');
/* servicos pages */
Route::get('/servicos',  'ServicosController@index');
Route::post('/servicos/enviar',  'ServicosController@enviar');
/* mycar pages */
Route::get('/mycar',  'MycarController@index');
Route::post('/mycar/filtrado',  'MycarController@mycartinder');
Route::post('/mycar/enviar',  'MycarController@addmycar');
/* viaturas pages */
Route::get('/viaturas',  'ViaturasController@Index');
Route::get('/viaturas/search',  'ViaturasController@search');
Route::post('/viaturas/filtros',  'ViaturasController@filtros');
Route::get('viaturas/{id}/show',  'ViaturasController@showviatura');
Route::post('/viaturas/{id}/contactar',  'ViaturasController@contactar');
Route::post('viaturas/{id}/fav',  'MycarController@fav');
Route::post('viaturas/{id}/unfav',  'MycarController@unfav');
/* admin */
Route::get('/admin', 'AdminController@index');
/* admin utilizadores */
Route::get('/admin/users', 'AdminController@indexusers');
Route::get('/admin/users/perfil/{id}', 'AdminController@userperfil');
Route::post('/admin/users/perfil/rolemod', 'AdminController@rolemod');
Route::get('/admin/users/{id}/delete', 'AdminController@deleteusers');
/* admin viaturas */
Route::get('/admin/viaturas', 'AdminController@indexviaturas');
Route::get('/admin/viaturas/adicionar', 'AdminController@addviatura');
Route::get('/admin/viaturas/{id}/edit', 'AdminController@editviatura');
Route::get('/admin/viaturas/{id}/delete', 'AdminController@deleteviatura');
Route::get('/admin/viaturas/{id}/deletefoto', 'AdminController@deletefoto');
Route::get('/admin/viaturas/{id}/changehead', 'AdminController@changefoto');
Route::post('/admin/viaturas/{id}/update', 'AdminController@updateviatura');
Route::post('/admin/viaturas/guardar','AdminController@guardarviatura');
/* admin servicos */
Route::get('/admin/servicos', 'AdminController@indexservicos');
Route::get('/admin/servicos/{id}/delete', 'AdminController@deleteservico');
Route::get('/admin/servico/{id}', 'AdminController@verservico');
/* auth */
Auth::routes();
    
