<?php

namespace IngressoArt\Shop;

use Illuminate\Support\Collection;
use IngressoArt\Models\Ingresso;
use IngressoArt\Models\Lote;
use IngressoArt\Models\Pedido;
use IngressoArt\Models\PedidoItem;
use Session;

class Carrinho
{

    const SESSION_DEFAULT = 'carrinho';

    public function __construct()
    {

    }

    /**
     * Recupera o conteudo do carrinho
     * Se não houverem itens retorna uma Collection vazia
     *
     * @return \Illuminate\Support\Collection
     */
    protected static function getConteudo()
    {
        $conteudo = Session::has(self::SESSION_DEFAULT)
            ? Session::get(self::SESSION_DEFAULT)
            : new Collection;

        return $conteudo;
    }

    /**
     * Recupera a quantidade de ingressos de um lote especifico 
     * que está no carrinho
     */
    public static function qtdItens($loteId)
    {

        $conteudo = self::getConteudo();        
        $item = $conteudo->where('lote_id', $loteId)->first();

        if ($item != null) {
            return $item['quantidade'];
        }

        return 0;
    }

    /**
     * Recupera a quantidade total de ingressos no carrinho
     */
    public static function getQtdTotalIngressos()
    {
        $conteudo = self::getConteudo();
        return $conteudo->sum('quantidade');
    }

    /**
     * Substitui todos os itens que estavam no carrinho pelos
     * itens passados por parâmetro
     */
    public static function atualizaItens(Collection $itens)
    {

        // Se já havian itens no carrinho verifica se eles sao do mesmo evento
        $conteudo = self::getConteudo();
        if (!$conteudo->isEmpty()) {
            if (self::getEvento($conteudo) <> self::getEvento($itens)) {
                flash()->error('Somente adicionar ao carrinho ingressos do mesmo evento!');
                return back();
            }
        }

        // Inicializa a uma collection
        $carrinho = collect([]);

        // Monta a estrutura que irá substituir todos os itens do carrinho
        foreach ($itens as $item) {

            // Adiciona no carrinho os itens com quantidade > 0
            if ($item['quantidade'] > 0) {
                $carrinho->push(['lote_id' => (int) $item['lote_id'],
                                'quantidade' => (int) $item['quantidade']]);
            }
        }

        Session::put(self::SESSION_DEFAULT, $carrinho);

        flash()->success('Carrinho atualizado!');

        return back();

    }

    /**
     * Recupera o evento dos itens do carrinho pois
     * só é permitido adicionar ao carrinho ingressos de um mesmo evento
     */
    private static function getEvento(Collection $itens)
    {
        // Recupera o primeiro item e retorna qual é o evento que ele pertence
        $item = $itens->first();
        $lote = Lote::find($item['lote_id']);

        return $lote->evento->id;
    }

    /**
     * Monta um pedido com os itens que estão armazenados no carrinho
     * TODO - Não sei sei deixar isso aqui é um bom lugar...
     * @return Pedido
     */
    public static function pedido()
    {

        // Se nao há itens no carrinho
        if (self::getQtdTotalIngressos() == 0) {
            return null;
        }

        $pedido = new Pedido();
      
        // Recupera o conteúdo do carrinho
        $conteudo = self::getConteudo();
        foreach ($conteudo as $item) {

            // Recupera dados do lote
            $lote = Lote::find($item['lote_id']);

            // Calcula valor total do pedido
            $pedido->valor_total = $pedido->valor_total + $item['quantidade'] * $lote->valor_total;

            $pedidoItem = new PedidoItem();
            $pedidoItem->lote_id = $lote->id;
            $pedidoItem->quantidade = $item['quantidade'];
            $pedidoItem->valor_unitario = $lote->valor_total;
            $pedidoItem->valor_total = $item['quantidade'] * $lote->valor_total;

            // Gera os ingressos para cada item do pedido
            for ($i=1; $i <= $item['quantidade'] ; $i++) {

                $ingresso = new Ingresso;
                $pedidoItem->ingressos[] = $ingresso;

            }

            // Atribui o item ao pedido
            $pedido->itens[] = $pedidoItem;

        }
           
        return $pedido;
    }

    public static function limpar()
    {
        Session::forget(self::SESSION_DEFAULT);
    }

}