<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use IngressoArt\Shop\Carrinho;
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

        $pedido = Carrinho::pedido();

        return view('shop.evento', compact('evento', 'pedido'));
        
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