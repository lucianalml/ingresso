<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtor extends Model
{
	protected $table = 'produtores';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id');
    }
}
