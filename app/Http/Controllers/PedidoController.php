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


    public function rules(Request $request)
    {
        $rules = [];

        foreach($request->get('nome') as $key => $val)
        {
//            $rules['nome['.$key.']'] = 'required';
            $rules['nome.' . $key] = 'required';
        }

        foreach($request->get('documento') as $key => $val)
        {
//            $rules['documento['.$key.']'] = 'required';
            $rules['documento.' . $key] = 'required';
        }

        return $rules;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = $this->rules($request);

        $validator = Validator::make($request->all(), 
            $rules
        );

        // NAO SEI PQ NAO EXIBE OS ERROS :'(
        if ($validator->fails()) {
            return redirect('/checkout')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
        	// tambem nao exibe msg de sucesso
        	flash()->error('sucesso das galsxias!');
            // Entao vamos supor q esta tudo preenchido certo...
            $nomes = $request->get('nome');
            $documentos = $request->get('documento');

        
//        $pedido = new Pedido();
			return Redirect::to('/checkout')->with('message', 'uhuu');

        }


//         // Get all the validation rules for eventos and assign it to the evento Model
//         $this->validate($request, [
//             'nome' => 'required',
//             'descricao' => 'required',
//             'data' => 'required',
//             'hora' => 'required',
//             'local' => 'required',
//         ]);
        
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
