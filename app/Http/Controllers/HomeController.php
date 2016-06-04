<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Evento;
use App\Models\Lote;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
// TODO - Verificar....
//        $this->middleware('auth');
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $eventos = Evento::get();

        return view('shop.index', compact('eventos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exibirEvento(Evento $evento)
    {
//        $sessionId = Session::getId();

        $ingressos = $this->recuperaIngressos($evento);
        $pedido = $this->recuperaPedido();

// TODO- nao passar a variavel carrinho, apenas para debug
        return view('shop.evento', compact('evento', 'ingressos', 'pedido'));
    }

    /**
     * Recupera os ingressos do evento considerando os itens adicionados ao carrinho
     * @param  Evento $evento
     * @return [array] Ingressos
     */
    public function recuperaIngressos(Evento $evento)
    {
        // Recupera a variavel de sessão
        $itensCarrinho = Session::get('carrinho');
        if (is_null($itensCarrinho)) {
            $itensCarrinho = [];
        }

        $ingressos = [];

        // Percorre todos os lotes existentes para preencher tabela de ingressos
        foreach ($evento->lotes as $lote) {

            // Verifica se o lote foi adicionado ao carrinho
            $key = array_search($lote->id, array_column($itensCarrinho, 'lote_id'));

            // Se ainda não foi adicionado insere com quantidade zero
            if ($key === false) { 

                $ingresso = [ 'lote_id' => $lote->id,
                            'descricao' => $lote->descricao, 
                            'valor' => $lote->preco, 
                            'quantidade' => 0, 
                            'valor_total' => 0];
            } else {             

                $ingresso = [ 'lote_id' => $lote->id,
                            'descricao' => $lote->descricao,
                            'valor' => $lote->preco, 
                            'quantidade' => $itensCarrinho[$key]['quantidade'], 
                            'valor_total' => $itensCarrinho[$key]['quantidade'] * $lote->preco ];
            }            
        
            array_push($ingressos, $ingresso);
        }

        return $ingressos;
    }

    /**
     * Recupera dados do pedido que estão armazenados na sessão
     * @return [array] Pedido
     */
    public function recuperaPedido()
    {

        // Recupera a variavel de sessão
        $itensCarrinho = Session::get('carrinho');
        if (is_null($itensCarrinho)) {
            $itensCarrinho = [];
        }

        // Monta o array com os itens do pedido
        $pedido = [];

        foreach ($itensCarrinho as $item) {
   
            $lote = Lote::find($item['lote_id']);

            $pedidoItem = ['lote_id' => $item['lote_id'],
                            'evento_nome' => $lote->evento->nome,
                            'lote_descricao' => $lote->descricao,
                            'quantidade' => $item['quantidade'],
                            'valor_total' => $item['quantidade'] * $lote->preco ,
            ];

            array_push($pedido, $pedidoItem);
        }

        return $pedido;
    }

    /**
     * Adiciona um ingresso ao carrinho
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adicionarIngresso(Request $request)
    {        

        $item = ['lote_id' => $request->lote, 
                'quantidade' => $request->quantidade];

        $itensCarrinho = Session::get('carrinho'); 

        // Inicializa carrinho
        if (is_null($itensCarrinho)) {
            $itensCarrinho = [];
        }

        // Verificar se o usuário já havia adicionado um ingresso desse lote
        $key = array_search($item['lote_id'], array_column($itensCarrinho, 'lote_id'));

        if ( $key === false ) {
            // Adiciona novo item ao carrinho
            array_push($itensCarrinho, $item);
        }
        else
        {
            // atualiza a quantidade
            $itensCarrinho[$key]['quantidade'] = $item['quantidade'];
        }

        // Atualiza variável de sessão
        Session::put('carrinho', $itensCarrinho);

        // Atualiza a quantidade total de ingressos no carrinho
        $totalCarrinho = $this->totalCarrinho();
        Session::put('totalcarrinho', $totalCarrinho);

// TODO: Nao sei pq nao está exibindo a msg
        flash()->success('Ingressos adicionados!');
        
        return back();
    }

    public function totalCarrinho()
    {
        $itensCarrinho = Session::get('carrinho'); 

        if (is_null($itensCarrinho)) {
            $itensCarrinho = [];
        }

        $totalCarrinho = 0;

        foreach ($itensCarrinho as $item) {
            $totalCarrinho = $totalCarrinho + $item['quantidade'];
        }

        return $totalCarrinho;
    }

    /**
     * Exibe pagina de checkout
     */
    public function checkout()
    {

        // Recupera os itens do pedido
        $pedido = $this->recuperaPedido();

        $ingressos = [];

        $id = 0;

        // Abre os itens de cada pedido por quantidade
        foreach ($pedido as $pedidoItem) {
            
            $lote = Lote::find($pedidoItem['lote_id']);

            for ($i=1; $i <= $pedidoItem['quantidade'] ; $i++) {

                $id = $id + 1;

                $ingresso = ['id' => $id,
                            'evento_nome' => $lote->evento->nome,
                            'lote_descricao' => $lote->descricao
                ];

                array_push($ingressos, $ingresso);
            }
        }

        return view('shop.checkout', compact('ingressos'));
    }


//     /**
//      * Exibe pagina de checkout
//      */
//     public function fecharPedido(Request $request)
//     {

// // NAO SEI PQ DIABOS NAO FUNCIONA
// // nao aparece as msgs de erro, parece q é só qdo é chamado via post??...
// // 
//         $rules = $this->rules($request);

//         $validator = Validator::make($request->all(), 
//             $rules
//         );

//         if ($validator->fails()) {
//             return redirect('/checkout')
//                         ->withErrors($validator)
//                         ->withInput();
//         }
//         else
//         {
//             // Entao vamos supor q esta tudo preenchido certo...
//             $nomes = $request->get('nome');
//             $documentos = $request->get('documento');

        
//         $pedido = new Pedido();

//         return back();
//         }

//     }
}