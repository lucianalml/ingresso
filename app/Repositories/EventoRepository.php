<?php

namespace App\Repositories;

use App\User;

class EventoRepository
{
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