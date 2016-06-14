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

    protected $carrinho;
    protected $eventoCarrinho;
    protected $qtdTotal;

    public function __construct()
    {
        // Instancia o carrinho
        $this->carrinho = $this->getCarrinho();

        // Quantidade total de ingressos no carrinho
        $this->qtdTotal = $this->getQtdTotal();

        // Um carrinho pode ter apenas ingressos de um evento
        $this->eventoCarrinho = $this->getEventoCarrinho();

    }



    public function getCarrinho()
    {
        // Recupera a variavel de sessão
        $carrinho = Session::get('carrinho');
        if (is_null($carrinho)) {
            $carrinho = [];
        }

        return $carrinho;
    }

    public function getQtdTotal()
    {

        $qtdTotal = 0;
        foreach ($this->carrinho as $item) {
            if (! empty($item)) {
                $qtdTotal = $qtdTotal + $item['quantidade'];
            }
        }
        return $qtdTotal;
    }


    public function getEventoCarrinho()
    {
        // Se o carrinho está vazio não retorna nada
        if ($this->qtdTotal > 0) {
            $lote = Lote::find($this->carrinho[0]['lote_id']);
            return $lote->evento;
        }

    }

    /**
     * Recupera a quantidade de ingressos adicionado ao carrinho de um Lote
     * @return Int quantidade
     */
    public function recuperaQtdLoteCarrinho(Lote $lote)
    {

        // Verificar se o usuário já havia adicionado um ingresso desse lote
        $key = array_search($lote->id, array_column($this->carrinho, 'lote_id'));

        // Não encontrou
        if ( $key === false ) {
            return 0;
        }
        
        return $this->carrinho[$key]['quantidade'];           

    }

    /**
     * Recupera dados do pedido que estão armazenados no carrinho da sessão
     * @return Pedido
     */
    public function recuperaPedido()
    {

        $pedido = new Pedido();

        // Se nao há itens no carrinho
        if ($this->qtdTotal == 0) {
            return $pedido;
        }
      
        // itemCarrinho = array com campos lote_id e quantidade
        foreach ($this->carrinho as $itemCarrinho) {

            // Recupera dados do lote
            $lote = Lote::find($itemCarrinho['lote_id']);

            // Calcula valor total do pedido
            $pedido->valor_total = $pedido->valor_total + $itemCarrinho['quantidade'] * $lote->valor_total;

            $pedidoItem = new PedidoItem();
            $pedidoItem->lote_id = $itemCarrinho['lote_id'];
            $pedidoItem->quantidade = $itemCarrinho['quantidade'];
            $pedidoItem->valor_unitario = $lote->valor_total;
            $pedidoItem->valor_total = $itemCarrinho['quantidade'] * $lote->valor_total;

            // Gera os ingressos para cada item do pedido
            for ($i=1; $i <= $itemCarrinho['quantidade'] ; $i++) {

                $ingresso = new Ingresso;
                $pedidoItem->ingressos[] = $ingresso;

            }

            // Atribui o item ao pedido
            $pedido->itens[] = $pedidoItem;

        }
           
        return $pedido;
    }


    public function validaCarrinho($ingressos)
    {
        if (empty($ingressos)) {
            return "Selecionar pelo menos um ingresso";
        }
        
        // Verifica se está adicionando apenas ingressos do mesmo evento
        $lote = Lote::find($ingressos[0]['lote_id']);

        if (! empty($this->eventoCarrinho) AND 
            $this->eventoCarrinho != $lote->evento ) {

            return "Permitido adicionar ao carrinho apenas ingressos do mesmo evento";
        }

        return true;
    }
    /**
     * Adiciona um ingresso na variavel de sessão do carrinho
     * Formato array de ['lote_id' => , 'quantidade' => ]
     */
    public function atualizaCarrinho($ingressos)
    {

        $valida = $this->validaCarrinho($ingressos);

        if ( $valida !== true ) {

            flash()->error($valida);

            return back()->withInput();

        }
        
        // Sobrescreve os itens do carrinho
        $carrinho = [];
        $totalIngressos = 0;

        foreach ($ingressos as $key => $ingresso) {
            
            // Se a quantidade do item for maior que zero insere no carrinho
            if ($ingresso['quantidade'] > 0) {
                $carrinhoItem = ['lote_id' => $ingresso['lote_id'],
                                'quantidade' => $ingresso['quantidade']];

                $carrinho[] = $carrinhoItem;
                $totalIngressos = $totalIngressos + $ingresso['quantidade'];
            }
        }
        
        flash()->success('Ingressos atualizados!');

        // Atualiza as variáveis de sessão
        Session::put('carrinho', $carrinho);
        Session::put('totalcarrinho', $totalIngressos);

    }


    /**
     * Recupera os ingressos do evento considerando as quantidade
     * de itens adicionados ao carrinho
     * @param  Evento $evento
     * @return [array] Ingressos
     */
    public function recuperaIngressos(Evento $evento)
    {

        $ingressos = [];

        // Monta um array com todos os lotes do evento e qtdades no carrinho
        foreach ($evento->lotes as $lote) {

            $ingresso = ['lote_id' => $lote->id,
                        'quantidade' => $this->recuperaQtdLoteCarrinho($lote) ];

            // Adiciona o item ao array
            $ingressos[] = $ingresso;

        }
       
        return $ingressos;
    }

}