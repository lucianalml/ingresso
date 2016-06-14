<?php 

namespace IngressoArt;

class EventoFilters extends QueryFilter
{

	public function local($local)
	{
		return $this->builder->where('local', $local);
	}

	public function evento($nome = '')
	{
		return $this->builder->where('nome', 'like', "%$nome%");
	}
}