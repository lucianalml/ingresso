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

        $ingressos = $this->eventoRepo->recuperaIngressos($evento);
        
        $pedido = $this->carrinhoRepo->recuperaPedido();

        return view('shop.evento', compact('evento', 'ingressos', 'pedido'));
    }


    /**
     * Atualiza os ingressos no carrinho
     */
    public function atualizaCarrinho(Request $request)
    {        

        $this->carrinhoRepo->atualizaCarrinho($request->lote, $request->quantidade);

        flash()->success('Ingressos adicionados!');
        
        return back();
    }

}