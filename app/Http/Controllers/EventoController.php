<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Evento;
use App\Models\Lote;
use App\Models\Produtor;
use App\Repositories\EventoRepository;
use Illuminate\Http\Request;
use Session;

class EventoController extends Controller
{

    /**
     * The evento repository instance.
     *
     * @var EventoRepository
     */
    protected $eventos;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EventoRepository $eventos)
    {
// Middleware valido para todos os métodos desse controler
//        $this->middleware('auth');

// Verificar como funciona essa pira de Repository
//         $this->eventos = $eventos;

// Listar eventos do usuário em EventoRepository
//        $eventos->forUser($user);
    }

	/**
	 * Lista todos os eventos
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function index(Request $request)
	{

        $eventos = Evento::get();
        return view('admin.eventos.index', compact('eventos'));

	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Recupera os produtors
        $produtores = Produtor::get();

        return view('admin.eventos.create-edit', compact('produtores'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Get all the validation rules for eventos and assign it to the evento Model
        $this->validate($request, [
            'nome' => 'required',
            'descricao' => 'required',
            'data' => 'required',
            'hora' => 'required',
            'local' => 'required',
        ]);
        
        $evento = new Evento();

        $evento->nome = $request->nome;
        $evento->descricao = $request->descricao;
        $evento->data = $request->data;
        $evento->hora = $request->hora;
        $evento->local = $request->local;
      
// Salva o evento no banco de dados
        $evento->save();

        flash()->success('Evento criado com sucesso!');

// Envia para a rota de edição do evento
        return redirect()->action('EventoController@edit', [$evento->id]);       
    }

/**
 *  ToDo
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {   

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {   

        // Recupera os produtors
        $produtores = Produtor::get();

        return view('admin.eventos.create-edit', compact('evento', 'produtores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required',
            'descricao' => 'required',
            'data' => 'required',
            'hora' => 'required',
            'local' => 'required',
        ]);


        $eventos = Evento::findOrFail($id);

        $eventos->update($request->all());

        flash()->success('Evento atualizado.');
        
        return redirect('admin/eventos');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
//        $sessionId = Session::getId();

        $ingressos = $this->recuperaIngressos($evento);
        $pedido = $this->recuperaPedido($evento);

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
     * @param  Evento $evento
     * @return [array] Pedido
     */
    public function recuperaPedido(Evento $evento)
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

}