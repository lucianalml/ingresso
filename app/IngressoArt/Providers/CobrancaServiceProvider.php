<?php 

namespace IngressoArt\Providers;
 
use Illuminate\Support\ServiceProvider;
 
class CobrancaServiceProvider extends ServiceProvider {
 
  public function register()
  {
    $this->app->bind(
      'IngressoArt\Cobranca\CobrancaInterface',
      'IngressoArt\Cobranca\PagSeguroCobranca'
    );
  }
 
}