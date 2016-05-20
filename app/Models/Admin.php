<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Admin extends Model
{
	
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id');
    }
}
