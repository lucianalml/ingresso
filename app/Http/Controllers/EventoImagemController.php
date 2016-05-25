<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Evento;
use App\Models\EventoImagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;

class EventoImagemController extends Controller
{
    /**
     * Retorna todas as imagens do evento
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request, Evento $evento)
    {
        return view('admin.eventos.imagens.index', compact('evento'));
    }


    /**
     * Adiciona uma nova imagem
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, Evento $evento)
	{

        $this->validate($request, [
            'image' => 'required'
        ]);

        $file = Input::file('image');

        // Gera um nome criptografado para a imagem
        $name = sha1 (
            time() . $file->getClientOriginalName()
        );

        // Recupera a extensão
        $extension = $file->getClientOriginalExtension();
        
        $name = $name.'.'.$extension;

        $path = public_path().'/ImagensEventos/';

        // Salva a imagem original no diretório /public/ImagensEventos
        $file->move($path, $name);

        // Gera uma miniatura da imagem e salva no diretório 
        // public/ImagensEventos/Thumbnail
        $image = Image::make($path.$name)
            ->resize(200, 200)
            ->save($path.'Thumbnail/'.$name);

        // Atribui a imagem ao evento
        $eventoImage = new EventoImagem();

        $eventoImage->path = '/ImagensEventos/'.$name;
        $eventoImage->thumbnail_path = '/ImagensEventos/Thumbnail/'.$name;

        $evento->imagens()->save($eventoImage);

        flash()->success('Imagem carregada com sucesso!');
        return back();
	}

}
