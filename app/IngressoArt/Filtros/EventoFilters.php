<?php 

namespace IngressoArt\Filtros;

class EventoFilters extends QueryFilter
{
	/**
	 * Filtro por nome do evento
	 */
	public function nome($nome = '')
	{
		return $this->builder->where('nome', 'like', "%$nome%");
	}

	/**
	 * Filtro por local
	 */
	public function local($local)
	{
		return $this->builder->where('local', $local);
	}

	/**
	 * Filtro por estado
	 */
	public function estado($estado)
	{
		return $this->builder->where('estado', $estado);
	}

	/**
	 * Filtro por cidade
	 */
	public function cidade($cidade)
	{
		return $this->builder->where('cidade', $cidade);
	}

	/**
	 * Filtro por genero
	 */
	public function genero($genero)
	{
		return $this->builder->where('genero', $genero);
	}

	/**
	 * Filtra os evento por produtor
	 */
	public function produtor($produtor)
	{
		return $this->builder->where('produtor_id', $produtor);
	}
}