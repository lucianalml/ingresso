<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Evento;
use App\Models\Ingresso;
use App\Models\Lote;
use App\Models\Pedido;
use App\Repositories\CarrinhoRepository;
use App\Repositories\EventoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{

    /**
     * Instancia dos repositórios
     */
    protected $carrinhoRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CarrinhoRepository $carrinhoRepo)
    {
        // Instancia os repositórios
        $this->carrinhoRepo = $carrinhoRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

// TODO mudar pra recuperar os dados do repositorio
//        $eventos = $this->eventoRepo->getAll();
        $eventos = Evento::get();
        return view('shop.index', compact('eventos'));
    }

    /**
     * Exibe a pagina para comprar ingressos de um evento
     */
    public function exibirEvento(Evento $evento)
    {        

        $pedido = $this->carrinhoRepo->recuperaPedido();
        $ingressos = $this->carrinhoRepo->recuperaIngressos($evento);

        return view('shop.evento', compact('evento', 'ingressos', 'pedido'));
        
    }


    /**
     * Atualiza os ingressos no carrinho
     */
    public function atualizaCarrinho(Request $request)
    {   

        $ingressos = $request->get('ingressos');

        $this->carrinhoRepo->atualizaCarrinho($ingressos);
        
        return back();
    }

    /**
     * Exibe a área do cliente
     */
    public function areaCliente()
    {
        $usuario = Auth::user();
        $pedidos = Pedido::where('user_id', $usuario->id)
                    ->orderBy('id', 'desc')->get();

        return view('shop.cliente.conta', compact('usuario', 'pedidos'));
        
    }

    /**
     * Exibe a pagina com detalhes de um pedido para o cliente
     */
    public function clientePedido(Pedido $pedido)
    {
    
        // Verifica se o pedido pertence ao usuário logado
        if ($pedido->user->id == Auth::user()->id) {
            return view('shop.cliente.pedido', compact('pedido'));
        } 
        else 
        {
            abort(403, 'Unauthorized action.');
        }
        
    }

    public function verIngresso(Ingresso $ingresso)
    {
    
        // Verifica se o ingresso pertence ao usuário logado
        // if ($pedido->user->id == Auth::user()->id) {
        //     return view('shop.cliente.pedido', compact('pedido'));
        // } 
        // else 
        // {
        //     abort(403, 'Unauthorized action.');
        // }
    }

}