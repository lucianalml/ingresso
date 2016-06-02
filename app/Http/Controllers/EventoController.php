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
//        
//        
        // Recupera a variavel de sessão
        $carrinho = Session::get('carrinho');
        if (is_null($carrinho)) {
            $carrinho = [];
        }

        $ingressos = [];

        // Percorre todos os lotes existentes para preencher tabela de ingressos
        foreach ($evento->lotes as $lote) {

            // Verifica se o lote foi adicionado ao carrinho
            $key = array_search($lote->id, array_column($carrinho, 'lote_id'));

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
                            'quantidade' => $carrinho[$key]['quantidade'], 
                            'valor_total' => $carrinho[$key]['quantidade'] * $lote->preco ];
            }            
        
            array_push($ingressos, $ingresso);
        }

      

// TODO- nao passar a variavel carrinho, apenas para debug
        return view('shop.evento', compact('evento', 'carrinho', 'ingressos'));
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

        $carrinho = Session::get('carrinho'); 

        // Inicializa carrinho
        if (is_null($carrinho)) {
            $carrinho = [];
        }

        // Verificar se o usuário já havia adicionado um ingresso desse lote
        $key = array_search($item['lote_id'], array_column($carrinho, 'lote_id'));

        if ( $key === false ) {
            // Adiciona novo item no carrinho
            array_push($carrinho, $item);
        }
        else
        {
            // atualiza a quantidade
            $carrinho[$key]['quantidade'] = $item['quantidade'];
        }

        Session::put('carrinho', $carrinho);

        flash()->success('Ingressos adicionados!');
        
        return back();
    }

}