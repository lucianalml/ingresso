<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Evento;
use App\Models\Lote;
use App\Repositories\CarrinhoRepository;
use App\Repositories\EventoRepository;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{

    /**
     * Instancia dos repositórios
     */
    protected $eventoRepo;
    protected $carrinhoRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EventoRepository $eventoRepo, CarrinhoRepository $carrinhoRepo)
    {
        // Instancia os repositórios
        $this->eventoRepo = $eventoRepo;
        $this->carrinhoRepo = $carrinhoRepo;
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
     * Exibe a pagina para comprar ingressos de um evento
     */
    public function exibirEvento(Evento $evento)
    {

        $ingressos = $this->eventoRepo->recuperaIngressos($evento);
        
        $pedido = $this->carrinhoRepo->recuperaPedido();

        return view('shop.evento', compact('evento', 'ingressos', 'pedido'));
    }


    /**
     * Adiciona um ingresso ao carrinho
     */
    public function adicionarIngresso(Request $request)
    {        

        $this->carrinhoRepo->adicionarIngresso($request->lote, $request->quantidade);

        flash()->success('Ingressos adicionados!');
        
        return back();
    }



    /**
     * Exibe pagina de checkout
     */
    public function checkout()
    {

        $pedido = $this->carrinhoRepo->recuperaPedido();

        return view('shop.checkout', compact('pedido'));
    }

}