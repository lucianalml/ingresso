<?php 

namespace IngressoArt\Cobranca;

abstract class Cobranca {

	protected $tipo_transacao;

	protected $cod_transacao;

	protected $link;

	public function getTipoTransacao()
	{
		return $this->tipo_transacao;
	}

	public function getCodTransacao()
	{
		return $this->cod_transacao;
	}

	public function setCodTransacao($codigo)
	{
		$this->cod_transacao = $codigo;
	}

	public function getLink()
	{
		return $this->link;
	}

	public function setLink($link)
	{
		$this->link = $link;
	}
	
}
