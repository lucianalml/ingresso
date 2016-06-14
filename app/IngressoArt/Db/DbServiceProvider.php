<?php 

namespace IngressoArt\Db;
 
use Illuminate\Support\ServiceProvider;
 
class DbServiceProvider extends ServiceProvider {
 
  public function register()
  {
    $this->app->bind(
      'IngressoArt\Db\Evento\EventoRepository',
      'IngressoArt\Db\Evento\EloquentEventoRepository'
    );
  }
 
}