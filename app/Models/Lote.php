<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{

	protected $fillable = array('descricao', 'preco');

    /**
     * Recupera o evento desse lote
     */
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
