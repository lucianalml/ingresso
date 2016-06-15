<?php 

namespace IngressoArt\Repositories\Evento;

use App\Models\Evento;
use IngressoArt\Repositories\DbRepository;

class DbEventoRepository extends DbRepository implements EventoRepositoryInterface {

  protected $model;

  function __construct(Evento $model)
    {
      $this->model = $model;
    }  
}