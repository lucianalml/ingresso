<?php 

namespace IngressoArt\Db\Evento;
 
interface EventoRepository {
   
  public function all();

  public function find($id);
 
  public function create($input);
 
}