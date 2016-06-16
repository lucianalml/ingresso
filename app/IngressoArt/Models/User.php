<?php

namespace IngressoArt\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use IngressoArt\Models\Pedido;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Recupera todos os pedidos do usuário
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
