<?php

namespace App\Repositories;

use App\Models\Evento;
use App\Models\Ingresso;
use App\Models\Lote;
use App\Models\Pedido;
use App\Models\PedidoItem;
use Session;

class CarrinhoRepository
{
    /**
     * Recupera dados do pedido que estão armazenados no carrinho da sessão
     * @return [array] Pedido
     */
    public function recuperaPedido()
    {

        $totalIngressos = 0;

        // Recupera a variavel de sessão
        $itensCarrinho = Session::get('carrinho');
        if (is_null($itensCarrinho)) {
            $itensCarrinho = [];
        }

        $pedido = new Pedido();

        // itemCarrinho = array com lote_id e quantidade
        foreach ($itensCarrinho as $itemCarrinho) {

            // Recupera dados do lote
            $lote = Lote::find($itemCarrinho['lote_id']);

            // Calcula valor total do pedido
            $pedido->valor_total = $pedido->valor_total + $itemCarrinho['quantidade'] * $lote->preco;

            $pedidoItem = new PedidoItem();
            $pedidoItem->lote_id = $itemCarrinho['lote_id'];
            $pedidoItem->quantidade = $itemCarrinho['quantidade'];
            $pedidoItem->valor = $itemCarrinho['quantidade'] * $lote->preco;

            // Gera os ingressos para cada item do pedido
            for ($i=1; $i <= $itemCarrinho['quantidade'] ; $i++) {
                $totalIngressos = $totalIngressos + 1;

                $ingresso = new Ingresso;
                $pedidoItem->ingressos[] = $ingresso;

            }

            // Atribui o item ao pedido
            $pedido->itens[] = $pedidoItem;

        }
        
        // Atualiza a quantidade total de ingressos no carrinho
         Session::put('totalcarrinho', $totalIngressos);
   
        return $pedido;
    }

    /**
     * Adiciona um ingresso na variavel de sessão do carrinho
     * Formato array de ['lote_id' => , 'quantidade' => ]
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
            // Se a quantidade foi zerada elimina do carrinho
            if ($item['quantidade'] == 0) {
                unset($itensCarrinho[$key]);
                $temp = array_values($itensCarrinho);
                $itensCarrinho = $temp;
            }
            // Senão atualiza a quantidade
            else {
                $itensCarrinho[$key]['quantidade'] = $item['quantidade'];    
            }
            
        }

        // Atualiza variável de sessão
        Session::put('carrinho', $itensCarrinho);

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

}