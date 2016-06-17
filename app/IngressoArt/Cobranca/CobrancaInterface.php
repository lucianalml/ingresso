<?php 

namespace IngressoArt\Cobranca;

use IngressoArt\Models\Pedido;
 
interface CobrancaInterface {
   
  public function cobrar(Pedido $pedido);

  public function verificaTransacao($id);

}