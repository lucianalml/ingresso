<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use IngressoArt\Models\Produtor;
use IngressoArt\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProdutorController extends Controller
{

    public function index()
    {
        return view('produtor.index');
    }

    public function showFormLogin()
    {
        return view('produtor.auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|min:3|max:100',
            'password' => 'required|min:3|max:100'
        ]);

        $credentials = [ 'email' => $request->email, 
            'password' => $request->password ];

        if ( auth()->guard('produtor')->attempt($credentials ) ) {
            return redirect('/produtor');
        } else {
            return back()
                ->withErrors(['email' => 'Usuário ou senha inválidos!'])
                ->withInput();
        }

    }

    public function logout()
    {
        auth()->guard('produtor')->logout();

        return redirect('/produtor/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.produtores.register');
    }

    /**
     * Cadastra um usuário como produtor
     *
     * @param  int  $userID
     * @return Response
     */
    public function store(Request $request)
    {

//        dd($request);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|min:3|max:100',
            'password' => 'required|min:3|max:100|confirmed',
            'password_confirmation' => 'required'
        ]);

        
        $produtor = new Produtor();

        $produtor->name = $request->name;
        $produtor->email = $request->email;
        $produtor->password = Hash::make($request->password);

        $produtor->save();

        flash()->success('Produtor criado com sucesso!');

        return redirect('admin/produtores');


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
            'name' => 'required',
        ]);

        // Atualiza os dados na tabela de produtor
        $produtor->name = $request->name;
        $produtor->update();

        return redirect('admin/produtores');

    }

    /**
     * Desativa um produtor
     *
     * @param  Produtor  $produtor
     * @return Response
     */
    public function destroy(Produtor $produtor)
    {
        $produtor->ativo = false;

        $produtor->update();

        return redirect('admin/produtores');

        flash()->success('Produtor inativo.');

        return back();
    }
}