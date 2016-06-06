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
     * Recupera os ingressos do evento considerando as quantidade
     * de itens adicionados ao carrinho
     * @param  Evento $evento
     * @return [array] Ingressos
     */
    public function recuperaIngressos(Evento $evento)
    {
        // Recupera a variavel de sessão
        $itensCarrinho = Session::get('carrinho');
        if (is_null($itensCarrinho)) {
            $itensCarrinho = [];
        }

        $ingressos = [];

        // Percorre todos os lotes existentes para preencher tabela de ingressos
        foreach ($evento->lotes as $lote) {

            // Verifica se o lote foi adicionado ao carrinho
            $key = array_search($lote->id, array_column($itensCarrinho, 'lote_id'));

            // Se ainda não foi adicionado insere com quantidade zero
            if ($key === false) { 

                $ingresso = [ 'lote_id' => $lote->id,
                            'descricao' => $lote->descricao, 
                            'valor' => $lote->preco, 
                            'quantidade' => 0, 
                            'valor_total' => 0];
            } else {             

                $ingresso = [ 'lote_id' => $lote->id,
                            'descricao' => $lote->descricao,
                            'valor' => $lote->preco, 
                            'quantidade' => $itensCarrinho[$key]['quantidade'], 
                            'valor_total' => $itensCarrinho[$key]['quantidade'] * $lote->preco ];
            }            
        
            array_push($ingressos, $ingresso);
        }

        return $ingressos;
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