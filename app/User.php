<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Admin;

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

    public function isAdmin()
    {

// Verifica se o usuário é Admin
        $admin = Admin::find($this->id);

        if ($admin == NULL) {
            return false ;
        }
        else {
            return true;
        }      

    }

}
