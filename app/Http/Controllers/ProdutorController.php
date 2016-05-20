<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Produtor;

use App\User;

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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produtor $produtor)

    {
        $this->validate($request, [
            'nome' => 'required',
        ]);

// Atualiza os dados na tabela de produtor
        $produtor->celular = $request->celular;
        $produtor->update();

// Atualiza os dados na tabela de usuario
        $usuario = User::find($produtor->id);
        $usuario->name = $request->nome;
        $usuario->update();

        return redirect('admin/produtores');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

// TODO - Fazer uma busca pelo nome
    	$usuarios = User::get();

        return view('admin.produtores.create', compact('usuarios'));

    }


    /**
     * Cadastra um usuário como produtor
     *
     * @param  int  $userID
     * @return Response
     */
    public function store($userId)
    {

		$produtor = new Produtor();

        $produtor->id = $userId;

// Salva no banco de dados
        $produtor->save();

//        session()->flash('flash_message','Usuario adicionado como produtor');
//        session()->flash('message_important',true);
//        return back();
        

        flash()->success('Usuario adicionado como produtor');
//        flash('Usuario adicionado como produtor');

// Mensagem em um modal
//        flash()->overlay('Usuario adicionado como produtor');

        return back();

    }


    /**
     * Elimina um usuário da tabela de produtores
     *
     * @param  Produtor  $produtor
     * @return Response
     */
    public function destroy(Produtor $produtor)
    {
        $produtor->delete();

        flash()->success('Usuario removido dos produtores');

        return back();
    }

}
