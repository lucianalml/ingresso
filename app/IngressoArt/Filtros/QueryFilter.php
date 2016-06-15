<?php

namespace IngressoArt\Filtros;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilter
{

	protected $request;
	protected $builder;
	
	function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function apply(Builder $builder)
	{
		$this->builder = $builder;

		foreach ($this->filters() as $name => $value) {
			if (method_exists($this, $name)) {
				if (trim($value)) {
					$this->$name($value);
				} else {
					$this->$name();
				}	
			}
		}

		return $this->builder;
	}

	public function filters()
	{
		return $this->request->all();
	}
}