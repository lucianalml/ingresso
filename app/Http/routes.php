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

	            
// TODO -> Receber notificações
Route::get('/pagseguro/not', [
	'uses' => 'HomeController@index',
	'as' => 'pagseguro.notification'
	]);


Route::get('/pagamento/confirmacao', [
	'uses' => 'PagamentoController@store',
	'as' => 'pagseguro.redirect'
	]);


// Rotas para acesso ao site principal
Route::group(['middleware' => ['web']], function () {

	
	// Rotas para autenticação do usuário (/login, /register, /logout)
	Route::auth();

    Route::get('/', [
    	'uses' => 'HomeController@index',
    	'as' => 'index'
   	]);
    
    // Exibir o evento para compra de ingressos
	Route::get('/evento/{evento}', 'HomeController@exibirEvento');

	// Adicionar ingressos ao carrinho
	Route::post('carrinho/add', 'HomeController@atualizaCarrinho');

	// Quando for fechar o pedido tem q estar autenticado....
	Route::group(['middleware' => 'auth'], function () {
		Route::get('/checkout', 'PedidoController@create');
		Route::post('/checkout', 'PedidoController@store');

		// Nao sei se isso ficou bom assim....
		Route::get('/pagamento/{pedido}', 'PagamentoController@create');

		Route::get('/conta', 'HomeController@conta');
		Route::get('/conta/pedido/{pedido}', 'PedidoController@show');

		Route::get('/ingresso/{ingresso}', 'IngressoController@show');
		Route::get('/ingresso/{ingresso}/edit', 'IngressoController@edit');
		Route::post('/ingresso/{ingresso}/edit', 'IngressoController@update');

	});

});

// Rotas para acesso a area de administração
Route::group(['prefix' => 'admin', ['middleware' => 'admin']], function () {

	Route::get('/login', 'AdminController@showFormLogin');
	Route::post('/login', 'AdminController@login');
	Route::get('/logout', 'AdminController@logout');

	Route::group(['middleware' => 'auth.admin'], function () {

		Route::get('/', 'AdminController@index');
 		
 		Route::get('/eventos', 'EventoController@index');

		Route::get('/evento/create', 'EventoController@create');
		Route::post('/evento/create', 'EventoController@store');

	//	Route::get('evento/{id}', 'EventoController@show');
		Route::get('evento/{evento}/edit', 'EventoController@edit');
		Route::post('evento/{evento}/edit', 'EventoController@update');

		//TODO - Para deletar um evento utilizar softDelete p/ nao remover do banco
		//Route::post('evento/{id}/delete', 'EventoController@delete');
	//	Route::delete('/evento/{evento}', 'EventoController@destroy');

	// Cadastro de lotes
		Route::get('evento/{evento}/lotes', 'LoteController@index');
	    Route::post('evento/{evento}/lote', 'LoteController@store');
	    Route::get('/lote/{lote}/edit', 'LoteController@edit');
	    Route::post('/lote/{lote}/edit', 'LoteController@update');

	// Cadastro de produtores
	 	Route::get('/produtores', 'AdminController@listarProdutores');
	 	Route::get('/produtor/create', 'ProdutorController@create');
	 	Route::post('/produtor/register', 'ProdutorController@store');
	
	    Route::get('produtor/{produtor}/edit', 'ProdutorController@edit');
	    Route::post('produtor/{produtor}/edit', 'ProdutorController@update');
	    Route::delete('produtor/{produtor}', 'ProdutorController@destroy');
	    
	// Cadastro de imagens
		Route::get('evento/{evento}/imagens', 'EventoImagemController@index');
	 	Route::post('evento/{evento}/imagem', 'EventoImagemController@store');
	    Route::delete('imagem/{imagem}', 'EventoImagemController@destroy');

		// Usuários cadastrados
	 	Route::get('/usuarios', 'AdminController@listarUsuarios');

		// Pedidos
	 	Route::get('/pedidos', 'PedidoController@index');
	 	Route::get('/pedido/{pedido}', 'AdminController@showPedido');
	 	Route::post('/pedido/{pedido}/edit', 'PedidoController@update');

	 	Route::get('/ingressos', 'IngressoController@index');

	});

});


// Rotas para acesso a area do produtor
Route::group(['prefix' => 'produtor', ['middleware' => 'produtor']], function () {
	Route::get('/login', 'ProdutorController@showFormLogin');
	Route::post('/login', 'ProdutorController@login');
	Route::get('/logout', 'ProdutorController@logout');

	Route::group(['middleware' => 'auth.produtor'], function () {
		Route::get('/', 'ProdutorController@index');
	});

});
