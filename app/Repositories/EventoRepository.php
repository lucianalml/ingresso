<?php

namespace App\Repositories;

use App\Models\Evento;
use App\User;
use Session;

class EventoRepository
{

    /**
     * Recupera todos os eventos 
     */
    public function getAll()
    {
        return Evento::get();
    }

   
    /**
     * Recupera todos os eventos de um produtor
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->eventos()
                    ->get();
    }
}