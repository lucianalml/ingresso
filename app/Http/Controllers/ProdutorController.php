<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Produtor;

class ProdutorController extends Controller
{
   	//Retorna todos os produtores
   	public function index()
   	{

		$produtores = Produtor::get();
        return $produtores;
		//return view('admin.produtor.index', compact('produtores'));
   	}
}
