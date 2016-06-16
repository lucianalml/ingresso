<?php

namespace IngressoArt;

use Illuminate\Support\Collection;
use IngressoArt\Models\Evento;
use IngressoArt\Models\Lote;
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
     * Recupera a quantidade de ingressos de um lote que está
     * no carrinho
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
     * Substitui todos os itens que estavam no carrinho pelos
     * itens passados por parâmetro
     */
    public static function atualizaItens(Collection $itens)
    {

        // Se já havian itens no carrinho verifica se eles sao do mesmo evento
        $conteudo = self::getConteudo();
        if (!$conteudo->isEmpty()) {
            if (self::getEvento($conteudo) <> self::getEvento($itens)) {
                flash()->error('Somente adicionar ao carrinho ingressos para o mesmo evento!');
                return back();
            }
        }

        // Inicializa a uma collection
        $carrinho = collect([]);

        // Monta a estrutura que irá substituir todo o carrinho
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
    public static function getEvento(Collection $itens)
    {
        // Recupera o primeiro item e retorna qual é o evento que ele pertence
        $item = $itens->first();
        return Evento::find($item['lote_id']);
    }


    // public static function getCarrinho()
    // {
    //     // Recupera a variavel de sessão
    //     $carrinho = Session::get('carrinho');
    //     if (is_null($carrinho)) {
    //         $carrinho = [];
    //     }

    //     return $carrinho;
    // }

    // public static function getQtdIngressos()
    // {

    //     $qtdIngressos = 0;
    //     foreach ($this->carrinho as $item) {
    //         if (! empty($item)) {
    //             $qtdIngressos = $qtdIngressos + $item['quantidade'];
    //         }
    //     }
    //     return $qtdIngressos;
    // }

    // /**
    //  * Recupera a quantidade de ingressos adicionado ao carrinho de um Lote
    //  * @return Int quantidade
    //  */
    // public static function recuperaQtdLoteCarrinho(Lote $lote)
    // {

    //     // Verificar se o usuário já havia adicionado um ingresso desse lote
    //     $key = array_search($lote->id, array_column($this->carrinho, 'lote_id'));

    //     // Não encontrou
    //     if ( $key === false ) {
    //         return 0;
    //     }
        
    //     return $this->carrinho[$key]['quantidade'];           

    // }

    // /**
    //  * Recupera dados do pedido que estão armazenados no carrinho da sessão
    //  * @return Pedido
    //  */
    // public static function pedido()
    // {

    //     $pedido = new Pedido();

    //     // Se nao há itens no carrinho
    //     if ($this->qtdIngressos == 0) {
    //         return $pedido;
    //     }
      
    //     // itemCarrinho = array com campos lote_id e quantidade
    //     foreach ($this->carrinho as $itemCarrinho) {

    //         // Recupera dados do lote
    //         $lote = Lote::find($itemCarrinho['lote_id']);

    //         // Calcula valor total do pedido
    //         $pedido->valor_total = $pedido->valor_total + $itemCarrinho['quantidade'] * $lote->valor_total;

    //         $pedidoItem = new PedidoItem();
    //         $pedidoItem->lote_id = $itemCarrinho['lote_id'];
    //         $pedidoItem->quantidade = $itemCarrinho['quantidade'];
    //         $pedidoItem->valor_unitario = $lote->valor_total;
    //         $pedidoItem->valor_total = $itemCarrinho['quantidade'] * $lote->valor_total;

    //         // Gera os ingressos para cada item do pedido
    //         for ($i=1; $i <= $itemCarrinho['quantidade'] ; $i++) {

    //             $ingresso = new Ingresso;
    //             $pedidoItem->ingressos[] = $ingresso;

    //         }

    //         // Atribui o item ao pedido
    //         $pedido->itens[] = $pedidoItem;

    //     }
           
    //     return $pedido;
    // }


    // public static function validaCarrinho($ingressos)
    // {
    //     if (empty($ingressos)) {
    //         return "Selecionar pelo menos um ingresso";
    //     }
        
    //     // Verifica se está adicionando apenas ingressos do mesmo evento
    //     $lote = Lote::find($ingressos[0]['lote_id']);

    //     if (! empty($this->eventoCarrinho) AND 
    //         $this->eventoCarrinho != $lote->evento ) {

    //         return "Permitido adicionar ao carrinho apenas ingressos do mesmo evento";
    //     }

    //     return true;
    // }
    // /**
    //  * Adiciona um ingresso na variavel de sessão do carrinho
    //  * Formato array de ['lote_id' => , 'quantidade' => ]
    //  */
    // public static function atualizaCarrinho($ingressos)
    // {

    //     $valida = $this->validaCarrinho($ingressos);

    //     if ( $valida !== true ) {

    //         flash()->error($valida);

    //         return back()->withInput();

    //     }
        
    //     // Sobrescreve os itens do carrinho
    //     $carrinho = [];
    //     $totalIngressos = 0;

    //     foreach ($ingressos as $key => $ingresso) {
            
    //         // Se a quantidade do item for maior que zero insere no carrinho
    //         if ($ingresso['quantidade'] > 0) {
    //             $carrinhoItem = ['lote_id' => $ingresso['lote_id'],
    //                             'quantidade' => $ingresso['quantidade']];

    //             $carrinho[] = $carrinhoItem;
    //             $totalIngressos = $totalIngressos + $ingresso['quantidade'];
    //         }
    //     }
        
    //     flash()->success('Ingressos atualizados!');

    //     // Atualiza as variáveis de sessão
    //     Session::put('carrinho', $carrinho);
    //     Session::put('totalcarrinho', $totalIngressos);

    // }


    // /**
    //  * Recupera os ingressos do evento considerando as quantidade
    //  * de itens adicionados ao carrinho
    //  * @param  Evento $evento
    //  * @return [array] Ingressos
    //  */
    // public static function recuperaIngressos(Evento $evento)
    // {

    //     // $ingressos = [];

    //     // // Monta um array com todos os lotes do evento e qtdades no carrinho
    //     // foreach ($evento->lotes as $lote) {

    //     //     $ingresso = ['lote_id' => $lote->id,
    //     //                 'quantidade' => Carrinho::recuperaQtdLoteCarrinho($lote) ];

    //     //     // Adiciona o item ao array
    //     //     $ingressos[] = $ingresso;

    //     // }
       
    //     // return $ingressos;
    // }

}