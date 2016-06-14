<?php 

namespace IngressoArt\Db\Evento;

use App\Models\Evento;
 
class EloquentEventoRepository implements EventoRepository {

  public function all()
  {
    return Evento::get();
  }

  public function find($id)
  {
    return Evento::find($id);
  }

  public function create($input)
  {
    return Evento::create($input);
  }
  
}