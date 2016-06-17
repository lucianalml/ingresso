<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use IngressoArt\Models\Pagamento;
use IngressoArt\Models\Pedido;
use IngressoArt\Shop\Cobranca;
use Validator;

class PagamentoController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $cobranca = App::make('IngressoArt\Cobranca\CobrancaInterface');
        $cobranca->cobrar($pedido);

        // Salva no banco de dados
        $pagamento = new Pagamento();
        $pagamento->tipo = $cobranca->getTipoTransacao();
        $pagamento->transacao = $cobranca->getCodTransacao();;
        $pedido->pagamento()->save($pagamento);

        return redirect($cobranca->getLink());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        return view('shop.cliente.confirmacao');

    }

}
