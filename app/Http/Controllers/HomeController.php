<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Evento;
use App\Models\Ingresso;
use App\Models\Lote;
use App\Models\Pedido;
use App\Repositories\CarrinhoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use IngressoArt\EventoFilters;

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
    public function index(EventoFilters $filters)
    {
        // Filtra os eventos
        $eventos = Evento::filter($filters)->simplePaginate(8);
        
        return view('shop.index', compact('eventos'));
    }

    /**
     * Exibe a pagina para comprar ingressos de um evento
     */
    public function exibirEvento(Evento $evento)
    {        

        $ingressos = $this->carrinhoRepo->recuperaIngressos($evento);
        
        // Se não há itens no pedido
        if ($this->carrinhoRepo->getQtdTotal() == 0) {
            return view('shop.evento', compact('evento', 'ingressos'));
        }

        $pedido = $this->carrinhoRepo->recuperaPedido();
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
    public function conta()
    {
        $usuario = Auth::user();
        $pedidos = Pedido::where('user_id', $usuario->id)
                    ->orderBy('id', 'desc')->get();

        return view('shop.cliente.conta', compact('usuario', 'pedidos'));
        
    }

}