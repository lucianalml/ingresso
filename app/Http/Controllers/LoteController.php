<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Lote;
use App\Models\Evento;

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
//        $lotes = $evento->lotes;
//        return view('admin.lotes.index', compact(['evento','lotes']));
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

// Recupera o id do evento
//        $lote->evento_id = $evento->id
//        $lote->save();


//        return $request->all();
//        return redirect('/admin');
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento, $loteId)
    {   

// Recupera o lote
        $lote = Lote::where('evento_id',$evento->id)
                        ->where('id',$loteId)->first();

        return view('admin.lotes.edit', compact(['evento','lote']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento, Lote $lote)
    {

        $this->validate($request, [
            'descricao' => 'required',
            'preco' => 'required',
        ]);


        $lote->update($request->all());

        return redirect('admin/evento/'. $evento->id . '/lotes');

    }

}