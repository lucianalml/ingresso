<?php 

namespace IngressoArt\Cobranca;

use IngressoArt\Models\Pedido;

class StripeCobranca extends Cobranca implements CobrancaInterface {

	function __construct()
	{
	}  

	public function cobrar(Pedido $pedido){

	}

	public function verificaTransacao($id){

	}

}