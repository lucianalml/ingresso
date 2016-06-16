<?php

namespace IngressoArt\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{

	protected $fillable = array('descricao', 'preco', 'taxa_adm', 'valor_total');

    /**
     * Recupera o evento desse lote
     */
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    /**
     * Recupera todos os itens de pedidos desse lote
     */
    public function pedidoItens()
    {
        return $this->hasMany(PedidoItem::class);
    }

}
