<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;


class PedidoController extends Controller
{

	public function __construct()
    {
// Middleware valido para todos os métodos desse controler
//        $this->middleware('web');
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
            $ingressos = $request->get('ingresso');

            $pedido = new Pedido();

			$pedido->user_id = Auth::user();
			// $pedido->valor_total
			// $pedido->status = "NOVO";
			// 
			// $pedido->save();


         flash()->success('Sucesso das galaxias!');
//        $pedido = new Pedido();
			return back();

        }
       
//         $evento = new Evento();

//         $evento->nome = $request->nome;
//         $evento->descricao = $request->descricao;
//         $evento->data = $request->data;
//         $evento->hora = $request->hora;
//         $evento->local = $request->local;
      
// // Salva o evento no banco de dados
//         $evento->save();

//         flash()->success('Evento criado com sucesso!');

// // Envia para a rota de edição do evento
//         return redirect()->action('EventoController@edit', [$evento->id]);       
    }
}
