<?php

namespace IngressoArt;

class CarrinhoItem
{

	public $lote_id;

	public $quantidade;

    public function __construct($loteId, $quantidade)
    {
        $this->lote_id = $id;
        $this->quantidade = $quantidade;

    }

}
