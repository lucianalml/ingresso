<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use IngressoArt\QueryFilter;

class Evento extends Model
{

    use SoftDeletes;

	protected $fillable = array('nome', 'descricao', 'data', 'hora', 'local', 'produtor_id');

    protected $dates = ['deleted_at'];


    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }

    /**
     * Produtor do evento
     */
    public function produtor()
    {
        return $this->belongsTo(Produtor::class);
    }

    /**
     * Lotes do evento
     */
    public function lotes()
    {
        return $this->hasMany(Lote::class);
    }

    /**
     * Imagens do evento
     */
    public function imagens()
    {
        return $this->hasMany(EventoImagem::class);
    }

}
