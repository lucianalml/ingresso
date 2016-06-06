<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Ingresso;
use App\Models\Lote;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Repositories\CarrinhoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PedidoController extends Controller
{

	/**
     * Instancia dos repositórios
     */
	protected $carrinhoRepo;

	public function __construct(CarrinhoRepository $carrinhoRepo)
    {
// Middleware valido para todos os métodos desse controler
//        $this->middleware('web');
        $this->carrinhoRepo = $carrinhoRepo;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), 
            ['ingresso.*.nome' => 'required|string',
            'ingresso.*.documento' => 'required',
        	]);

        if ($validator->fails()) {

            return back()->withErrors($validator)
                        ->withInput();
        }
        else
        {

			// Recupera os itens do pedido
			$itens = $this->carrinhoRepo->recuperaPedido();

			// Recupera os ingressos de cada item e os dados dos portadores ingressos
			$ingressosPedido = $this->carrinhoRepo->ingressosPedido();
        	$dadosIngressos = $request->get('ingresso');

        	// Salva o pedido
            $pedido = new Pedido();
			$pedido->user_id = Auth::user()->id;
			$pedido->valor_total = $this->carrinhoRepo->valorTotal();
			$pedido->status = "NOVO";
			$pedido->save();      	

			foreach ($itens as $item) {
				$pedidoItem = new PedidoItem();
				$pedidoItem->lote_id = $item['lote_id'];
				$pedidoItem->quantidade = $item['quantidade'];
				$pedidoItem->valor = $item['valor_total'];

				$pedido->itens()->save($pedidoItem);

				// Isso ficou bem tosco...
				foreach ($ingressosPedido as $ingressoPed) {

					if ($ingressoPed['lote_id'] == $item['lote_id']) {

						$ingresso = new Ingresso;

						$ingresso->nome = $dadosIngressos[$ingressoPed['id']]['nome'];
						$ingresso->documento = $dadosIngressos[$ingressoPed['id']]['documento'];
						$ingresso->qr_code = str_random(100);
						
						$pedidoItem->ingressos()->save($ingresso);
					}
					
				}

			}

			flash()->success('Sucesso das galaxias!');
        }
        
		return back();
	}
}
