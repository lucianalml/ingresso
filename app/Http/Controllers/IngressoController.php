<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use IngressoArt\Models\Ingresso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class IngressoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingressos = Ingresso::orderBy('id', 'desc')->get();
        return view('admin.ingressos.index', compact('ingressos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Exibe um ingresso
     *
     * @param  Ingresso  $idingresso
     * @return \Illuminate\Http\Response
     */
    public function show(Ingresso $ingresso)
    {

        // Verifica se o ingresso pertence ao usuário logado
        if ($ingresso->pedidoItem->pedido->user->id == Auth::user()->id) {
            return view('shop.cliente.ingressos.show', compact('ingresso'));
        } 
        // Verifica se o usuário é administrador
        elseif (auth()->guard('admin')->check() ) 
        {
            return view('shop.cliente.ingressos.show', compact('ingresso'));
        } 
        else
        {
            abort(403, 'Unauthorized action.');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingresso $ingresso)
    {
        // Verifica se o ingresso pertence ao usuário logado
        if ($ingresso->pedidoItem->pedido->user->id == Auth::user()->id) {
            return view('shop.cliente.ingressos.edit', compact('ingresso'));
        } 
        else 
        {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingresso $ingresso)
    {

        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'documento' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                    ->withInput($request->input())
                    ->withErrors($validator);
        } 
        else {

            $ingresso->update($request->all());

            flash()->success('Dados do ingresso atualizados!');

            return redirect('/conta/pedido/'.$ingresso->pedidoItem->pedido->id);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
