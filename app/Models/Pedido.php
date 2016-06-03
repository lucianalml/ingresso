<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'user_id', 'valor_total', 'status',
    ];

    /**
     * Usuário do pedido
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Recupera todos os itens desse pedido
     */
    public function itens()
    {
        return $this->hasMany(PedidoItem::class);
    }

}
