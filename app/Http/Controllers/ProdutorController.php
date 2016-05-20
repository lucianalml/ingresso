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
		return view('admin.produtores.index', compact('produtores'));
   	}

/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produtor $produtor)
    {   
        return view('admin.produtores.edit', compact('produtor'));
    }
}
