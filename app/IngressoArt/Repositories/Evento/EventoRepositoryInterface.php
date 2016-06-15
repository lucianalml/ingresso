<?php 

namespace IngressoArt\Repositories\Evento;
 
interface EventoRepositoryInterface {
   
  public function all();

  public function getById($id);

}