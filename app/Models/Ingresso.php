<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingresso extends Model
{
	protected $fillable = [
        'pedido_item_id', 'nome', 'documento', 'qd_code'
    ];

    /**
     * Pedido do item
     */
    public function pedidoItem()
    {
        return $this->belongsTo(PedidoItem::class, 'pedido_item_id');
    }

}
