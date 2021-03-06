<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use IngressoArt\Models\Ingresso;
use IngressoArt\Models\Lote;
use IngressoArt\Models\Pedido;
use IngressoArt\Models\PedidoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use IngressoArt\Shop\Carrinho;
use Session;

class PedidoController extends Controller
{

    /**
     * Lista todos os pedidos
     */
    public function index(Request $request)
    {
        // TODO -> Depois colocar os selecs em um repositório
        $pedidos = Pedido::orderBy('id', 'desc')->Paginate(20);
        return view('admin.pedidos.index', compact('pedidos'));
    }

    /**
     * Exibe um pedido
     */
    public function show(Pedido $pedido)
    {        
        // Verifica se o pedido pertence ao usuário logado
        if ($pedido->user->id <> Auth::user()->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('shop.cliente.pedido', compact('pedido'));

    }


    /**
     * Exibe a pagina de checkout
     */
    public function create()
    {

        // Se não há itens no carrinho
        if (Carrinho::getQtdTotalIngressos() == 0) {
            flash()->error('Seu carrinho está vazio :( Coloque alguma coisa nele :)');
            return back();
        }
        
        $pedido = Carrinho::pedido();
        return view('shop.checkout', compact('pedido'));

    }

    /**
     * Salva um novo pedido
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), 
            ['itens.*.*.nome' => 'required|string',
            'itens.*.*.documento' => 'required',
        	]);

        if ($validator->fails()) {

            return back()->withErrors($validator)
                        ->withInput();
        }
        else
        {

            $dadosIngressos = $request->get('itens');

            // Recupera o pedido e salva
 			$pedido = Carrinho::pedido();
 			$pedido->user_id = Auth::user()->id;
 			$pedido->status = "Novo";
 			$pedido->save();      	

            // Salva os itens
 			foreach ($pedido->itens as $itemKey => $item) {
 				
                $pedido->itens()->save($item);

                // Salva os ingressos
 				foreach ($item->ingressos as $ingressoKey => $ingresso) {

 						$ingresso->nome = $dadosIngressos[$itemKey][$ingressoKey]['nome'];
 						$ingresso->documento = $dadosIngressos[$itemKey][$ingressoKey]['documento'];
 						$ingresso->qr_code = str_random(100);
						
 						$item->ingressos()->save($ingresso);
 					}
					
 				}

			flash()->success('Sucesso das galaxias!');

            // Limpa o carrinho
            Carrinho::limpar();

            // Envia para controller de pagamento
            return redirect()->action('PagamentoController@create', $pedido);

        }
	}

    /**
     * Atualiza dados do pedido
     *
     */
    public function update(Request $request, Pedido $pedido)
    {

        // Verifica se o usuário é admin
        if (! auth()->guard('admin')->check()) {
            abort(403, 'Unauthorized action.');
        }

        $pedido->status = $request->get('status');

        $pedido->save();

        flash()->success('Pedido atualizado!');

        return back();

    }
}
