<?php

namespace App\Repositories;

use App\Models\Evento;
use App\Models\Lote;
use Session;

class CarrinhoRepository
{

    /**
     * Recupera dados do pedido que estão armazenados no carrinho da sessão
     * @return [array] Pedido
     */
    public function recuperaPedido()
    {

        // Recupera a variavel de sessão
        $itensCarrinho = Session::get('carrinho');
        if (is_null($itensCarrinho)) {
            $itensCarrinho = [];
        }

        // Monta o array com os itens do carrinho
        $pedido = [];

        foreach ($itensCarrinho as $item) {
   
            $lote = Lote::find($item['lote_id']);

            $pedidoItem = ['lote_id' => $item['lote_id'],
                            'evento_nome' => $lote->evento->nome,
                            'lote_descricao' => $lote->descricao,
                            'quantidade' => $item['quantidade'],
                            'valor_total' => $item['quantidade'] * $lote->preco ,
            ];

            array_push($pedido, $pedidoItem);
        }

        return $pedido;
    }

    /**
     * Adiciona um ingresso ao carrinho
     */
    public function adicionarIngresso($loteId, $quantidade)
    {
        $item = ['lote_id' => $loteId, 
                'quantidade' => $quantidade];

        $itensCarrinho = Session::get('carrinho'); 

        // Inicializa carrinho
        if (is_null($itensCarrinho)) {
            $itensCarrinho = [];
        }

        // Verificar se o usuário já havia adicionado um ingresso desse lote
        $key = array_search($item['lote_id'], array_column($itensCarrinho, 'lote_id'));

        if ( $key === false ) {
            // Adiciona novo item ao carrinho
            array_push($itensCarrinho, $item);
        }
        else
        {
            // atualiza a quantidade
            $itensCarrinho[$key]['quantidade'] = $item['quantidade'];
        }

        // Atualiza variável de sessão
        Session::put('carrinho', $itensCarrinho);

        // Atualiza a quantidade total de ingressos no carrinho
        $totalCarrinho = $this->totalCarrinho();
        Session::put('totalcarrinho', $totalCarrinho);


    }

    public function totalCarrinho()
    {
        $itensCarrinho = Session::get('carrinho'); 

        if (is_null($itensCarrinho)) {
            $itensCarrinho = [];
        }

        $totalCarrinho = 0;

        foreach ($itensCarrinho as $item) {
            $totalCarrinho = $totalCarrinho + $item['quantidade'];
        }

        return $totalCarrinho;
    }

    /**
     * Recupera todos os ingressos do pedido
     */
    public function ingressosPedido()
    {
        // Recupera os itens do pedido
        $pedido = $this->recuperaPedido();

        $ingressos = [];

        $id = 0;

        // Abre os itens de cada pedido por quantidade
        foreach ($pedido as $pedidoItem) {
            
            $lote = Lote::find($pedidoItem['lote_id']);

            for ($i=1; $i <= $pedidoItem['quantidade'] ; $i++) {

                $id = $id + 1;

                $ingresso = ['id' => $id,
                            'evento_nome' => $lote->evento->nome,
                            'lote_id' => $lote->id,
                            'lote_descricao' => $lote->descricao
                ];

                array_push($ingressos, $ingresso);
            }
        }

        return $ingressos;
    }

    public function valorTotal()
    {

        $valorTotal = 0;
        $pedido = $this->recuperaPedido();

        foreach ($pedido as $item) {
            $valorTotal = $valorTotal + $item['valor_total'];
        }

        return $valorTotal;
    }
}