<?php

namespace IngressoArt\Models;

use Illuminate\Database\Eloquent\Model;

class EventoImagem extends Model
{
    protected $table = 'evento_imagens';

   	public $timestamps = false;

    protected $fillable = array('path', 'thumbnail_path');

	/**
     * Recupera o evento da imagem
     */
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

}
