<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
	protected $fillable = array('nome', 'descricao', 'data', 'hora', 'local', 'produtor_id');


    /**
     * Recupera o produtor desse evento
     */
    public function produtor()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Recupera todos os lotes desse evento
     */
    public function lotes()
    {
        return $this->hasMany(Lote::class,'evento_id', 'id');
    }
}
