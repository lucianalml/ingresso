<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use IngressoArt\Models\Pagamento;
use IngressoArt\Models\Pedido;
use IngressoArt\Shop\Cobranca;
use Validator;

class PagamentoController extends Controller
{

    /**
     * Lista os pagamentos
     */
    public function index(Request $request)
    {

        $pagamentos = Pagamento::orderBy('id', 'desc')->Paginate(20);
        return view('admin.pagamentos.index', compact('pagamentos'));
    }


    /**
     * Exibe um pagamento
     */
    public function show(Pagamento $pagamento)
    {        
        return view('admin.pagamentos.show', compact('pagamento'));

    }


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
        $pagamento->transacao = $cobranca->getCodTransacao();
        $pagamento->data_transacao = $cobranca->getaData();

        $pedido->pagamento()->save($pagamento);

        // Envia para o link de cobrança
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


// Quando retorna da cobrança vai cair aqui
// 
        if ($request->has('transaction_id')) {
            // // TODO - pensar se isso vai funcionar....
            // // Recupera o ultimo pagamento criado para o usuário logado
            // $pagamento = Pagamento::where('user_id', Auth::user()->id)->last();
            // $pagamento->transacao = $transacao;
            // $pagamento->save();
        }              

        return view('shop.cliente.confirmacao');

    }

}
