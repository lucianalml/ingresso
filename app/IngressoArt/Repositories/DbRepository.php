<?php 

namespace IngressoArt\Repositories;

abstract class DbRepository {
	
	public function getById($id)
	{
		return $this->model->find($id);
	}

	public function all()
	{	
		return $this->model->get();
	}
}
