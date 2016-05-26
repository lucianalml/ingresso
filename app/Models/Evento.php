<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{

    use SoftDeletes;

	protected $fillable = array('nome', 'descricao', 'data', 'hora', 'local', 'produtor_id');

    protected $dates = ['deleted_at'];


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

    /**
     * Recupera todas as imagens desse evento
     */
    public function imagens()
    {
//        return $this->hasMany(EventoImagem::class);
        return $this->hasMany(EventoImagem::class,'evento_id', 'id');
    }
}
