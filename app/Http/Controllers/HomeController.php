<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use IngressoArt\Carrinho;
use IngressoArt\Filtros\EventoFilters;
use IngressoArt\Models\Evento;
use IngressoArt\Models\Ingresso;
use IngressoArt\Models\Lote;
use IngressoArt\Models\Pedido;

class HomeController extends Controller
{

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

//        $ingressos = Carrinho::recuperaIngressos($evento);
        
        // // Se não há itens no pedido não exibe pedido
        // if (Carrinho::getQtdIngressos() == 0) {
        //     return view('shop.evento', compact('evento', 'ingressos'));
        // }

//        $pedido = Carrinho::pedido();
//        return view('shop.evento', compact('evento', 'ingressos', 'pedido'));
        

//        $ingressos = $evento->getIngressos();
//        

        // foreach ($evento->lotes as $key => $lote) {
        //     $lote->descricao --- Carrinho::qtdItens($lote->id)
        // }
     
        return view('shop.evento', compact('evento'));
    }


    /**
     * Atualiza os ingressos no carrinho
     */
    public function atualizaCarrinho(Request $request)
    {   

        // Cria uma collection com os ingressos
        $itens = collect($request->get('itens'));

        Carrinho::atualizaItens($itens);
        
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