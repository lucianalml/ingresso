<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Produtor extends Model
{
	protected $table = 'produtores';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id');
    }

    /**
     * Recupera todos os eventos desse produtor
     */
    public function eventos()
    {
        return $this->hasMany(Evento::class,'produtor_id', 'id');
    }
}
