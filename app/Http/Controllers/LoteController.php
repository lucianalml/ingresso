<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Evento;
use App\Models\Lote;
use App\Models\Produtor;
use Illuminate\Http\Request;

class LoteController extends Controller
{

    /**
     * Retorna uma lista com todos os lotes do evento
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request, Evento $evento)
    {
        return view('admin.lotes.index', compact('evento'));
    }

    /**
     * Cria um novo lote
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, Evento $evento)
    {

        $this->validate($request, [
            'descricao' => 'required|max:255',
            'preco' => 'required',
        ]);

        
        $lote = new Lote();

        $lote->descricao = $request->descricao;
        $lote->preco = $request->preco;

// Salva no banco de dados
        $evento->lotes()->save($lote);

        flash()->success('Lote atualizado.');

        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lote $lote)
    {   

        return view('admin.lotes.edit', compact('lote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lote $lote)
    {

        $this->validate($request, [
            'descricao' => 'required',
            'preco' => 'required',
        ]);


        $lote->update($request->all());

        flash()->success('Lote atualizado.');
            
// Envia para edição do evento
        return redirect()->action('EventoController@edit', [$lote->evento->id]);

    }

}
