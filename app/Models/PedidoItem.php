<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $table = 'pedido_itens';

    public $timestamps = false;

    protected $fillable = [
        'pedido_id', 'lote_id', 'quantidade', 'valor_unitario', 'valor_total'
    ];

    /**
     * Pedido do item
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    /**
     * Lote do item
     */
    public function lote()
    {
        return $this->belongsTo(Lote::class);
    }

    /**
     * Ingressos do item
     */
    public function ingressos()
    {
        return $this->hasMany(Ingresso::class);
    }

}
