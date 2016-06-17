<?php

namespace IngressoArt\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $fillable = [
        'tipo', 'pedido_id', 'transacao',
    ];

    /**
     * Usuário do pedido
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }


}
