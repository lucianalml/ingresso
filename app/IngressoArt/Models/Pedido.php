<?php

namespace IngressoArt\Models;

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

    /**
     * Recupera o pagamento desse pedido
     */
    public function pagamento()
    {
        return $this->hasOne(Pagamento::class);
    }
}
