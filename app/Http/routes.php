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

    Route::get('/', 'HomeController@index');

    Route::auth();

	Route::get('/teste', function(){
		$eventos = App\Models\Evento::get();       
		return view('teste', compact('eventos'));
	});

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

	//ToDo - utilizar softDelete
	//Route::post('evento/{id}/delete', 'EventoController@delete');

// Cadastro de lotes
	Route::get('evento/{evento}/lotes', 'LoteController@index');
    Route::post('evento/{evento}/lote', 'LoteController@store');
    Route::get('/lote/{lote}/edit', 'LoteController@edit');
    Route::post('/lote/{lote}/edit', 'LoteController@update');

//	Route::delete('/evento/{evento}', 'EventoController@destroy');

// Cadastro de produtores
	Route::get('/produtores', 'ProdutorController@index');
	Route::get('/produtor/create', 'ProdutorController@create');
	Route::post('/produtor/create/{id}', 'ProdutorController@store');
    Route::get('produtor/{produtor}/edit', 'ProdutorController@edit');
    Route::post('produtor/{produtor}/edit', 'ProdutorController@update');
    Route::delete('produtor/{produtor}', 'ProdutorController@destroy');
    

// Cadastro de imagens
	Route::get('evento/{evento}/imagens', 'EventoImagemController@index');
 	Route::post('evento/{evento}/imagem', 'EventoImagemController@store');
    Route::delete('imagem/{imagem}', 'EventoImagemController@destroy');

});
