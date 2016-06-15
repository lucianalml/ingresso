<?php 

namespace IngressoArt\Filtros;

class EventoFilters extends QueryFilter
{
	/**
	 * Filtra os evento por nome
	 */
	public function nome($nome = '')
	{
		return $this->builder->where('nome', 'like', "%$nome%");
	}

	/**
	 * Filtra os evento por local
	 */
	public function local($local)
	{
		return $this->builder->where('local', $local);
	}

	/**
	 * Filtra os evento por produtor
	 */
	public function produtor($produtor)
	{
		return $this->builder->where('produtor_id', $produtor);
	}
}