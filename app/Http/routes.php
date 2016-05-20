<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('index');
    });

    Route::auth();

    Route::get('/home', 'HomeController@index');

});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

	Route::get('/', function(){
		return view('admin.index');
	});

	Route::get('/eventos', 'EventoController@index');

	Route::get('/evento/create', 'EventoController@create');
	Route::post('/evento/create', 'EventoController@store');

//	Route::get('evento/{id}', 'EventoController@show');
	Route::get('evento/{id}/edit', 'EventoController@edit');
	Route::post('evento/{id}/edit', 'EventoController@update');

	//ToDo - utilizar softDelete do laravel
	//Route::post('evento/{id}/delete', 'EventoController@delete');

// Lotes de um evento
	Route::get('evento/{evento}/lotes', 'LoteController@index');


// Salva novo lote
    Route::post('evento/{evento}/lote', 'LoteController@store');

// Edita um lote
    Route::get('evento/{evento}/lote/{lote}/edit', 'LoteController@edit');
    Route::post('evento/{evento}/lote/{lote}/edit', 'LoteController@update');

//	Route::delete('/evento/{evento}', 'EventoController@destroy');

// Produtores cadastrados
	Route::get('/produtores', 'ProdutorController@index');

// Cadastrar um usuário como produtor
	Route::get('/produtor/create', 'ProdutorController@create');
	Route::post('/produtor/create/{id}', 'ProdutorController@store');

// Editar dados do produtor
    Route::get('produtor/{produtor}/edit', 'ProdutorController@edit');
    Route::post('produtor/{produtor}/edit', 'ProdutorController@update');

// Remove um usuário da lista de produtores
    Route::delete('produtor/{produtor}', 'ProdutorController@destroy');
    

});
