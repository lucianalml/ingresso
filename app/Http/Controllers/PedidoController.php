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
            ['itens.*.*.nome' => 'required|string',
            'itens.*.*.documento' => 'required',
        	]);

        if ($validator->fails()) {

            return back()->withErrors($validator)
                        ->withInput();
        }
        else
        {

            $dadosIngressos = $request->get('itens');

            // Recupera o pedido e salva
 			$pedido = $this->carrinhoRepo->recuperaPedido();
 			$pedido->user_id = Auth::user()->id;
 			$pedido->status = "NOVO";
 			$pedido->save();      	

            // Salva os itens
 			foreach ($pedido->itens as $itemKey => $item) {
 				
                $pedido->itens()->save($item);

                // Salva os ingressos
 				foreach ($item->ingressos as $ingressoKey => $ingresso) {

 						$ingresso->nome = $dadosIngressos[$itemKey][$ingressoKey]['nome'];
 						$ingresso->documento = $dadosIngressos[$itemKey][$ingressoKey]['documento'];
 						$ingresso->qr_code = str_random(100);
						
 						$item->ingressos()->save($ingresso);
 					}
					
 				}

			flash()->success('Sucesso das galaxias!');
        }
        
		return back();
	}
}
