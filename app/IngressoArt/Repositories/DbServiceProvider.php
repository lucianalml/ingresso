<?php 

namespace IngressoArt\Repositories;
 
use Illuminate\Support\ServiceProvider;
 
class DbServiceProvider extends ServiceProvider {
 
  public function register()
  {
    $this->app->bind(
      'IngressoArt\Repositories\Evento\EventoRepositoryInterface',
      'IngressoArt\Repositories\Evento\DbEventoRepository'
    );
  }
 
}