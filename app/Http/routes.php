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
	
//	Route::delete('/evento/{evento}', 'EventoController@destroy');

});
