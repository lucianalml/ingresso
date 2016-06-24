<?php 

namespace IngressoArt\Cobranca;

use IngressoArt\Models\Pedido;
use laravel\pagseguro\Platform\Laravel5\PagSeguro;

class PagSeguroCobranca extends Cobranca implements CobrancaInterface {

	function __construct()
	{
		$this->setTipoTransacao('PagSeguro');
	}  

	public function cobrar(Pedido $pedido)
	{

		// Preenche os itens do pedido
		$itens_pedido = [];

		foreach ($pedido->itens as $key => $item) {
			$id = $key + 1;
			$item_pedido = [
		            'id' => $id,
		            'description' => $item->lote->evento->nome . ' ' . $item->lote->descricao,
		            'quantity' => $item->quantidade,
		            'amount' => $item->valor_unitario,
		            // 'weight' => '45',
		            // 'shippingCost' => '3.5',
		            // 'width' => '50',
		            // 'height' => '45',
		            // 'length' => '60',
		        ];

		    $itens_pedido[] = $item_pedido;
		}



		$data = [
		    'items' => $itens_pedido,
		    // 'shipping' => [
		    //     'address' => [
		    //         'postalCode' => '06410030',
		    //         'street' => 'Rua Leonardo Arruda',
		    //         'number' => '12',
		    //         'district' => 'Jardim dos Camargos',
		    //         'city' => 'Barueri',
		    //         'state' => 'SP',
		    //         'country' => 'BRA',
		    //     ],
		    //     'type' => 2,
		    //     'cost' => 30.4,
		    // ],
		    'sender' => [
		        'email' => $pedido->user->email,
		        // TODO - cadastrar mais campos do usuário
		        'name' => $pedido->user->name . ' ' . $pedido->user->name,
		        'documents' => [
		            [
		                'number' => '01234567890',
		                'type' => 'CPF'
		            ]
		        ],
		        'phone' => '11985445522',
		        'bornDate' => '1988-03-21',
		    ]
		];


		$checkout = PagSeguro::checkout()->createFromArray($data);

		$credentials = PagSeguro::credentials()->get();
		$information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information

		if ($information) {

			// TODO - ta errado, esse nao é o codigo da transacao, só do token
			$this->setCodTransacao($information->getCode());

			$this->setLink($information->getLink());

			$this->setData($information->getDate());

		}

		// Colocar tratamento de erros

		return true;

	}

	public function verificaTransacao($id){

	}

}