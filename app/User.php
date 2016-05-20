<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Admin;
use App\Models\Evento;
use App\Models\Produtor;

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
     * Verifica se o usuário é Admin
     */
    public function isAdmin()
    {
        $admin = Admin::find($this->id);

        if ($admin == NULL) {
            return false ;
        }
        else {
            return true;
        }      

    }

    /**
     * Verifica se o usuário é Produtor
     */
    public function isProdutor()
    {
        $produtor = Produtor::find($this->id);

        if ($produtor == NULL) {
            return false ;
        }
        else {
            return true;
        }      

    }

    /**
     * Recupera todos os eventos desse usuário
     */
    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

}
