<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\EventoRepository;

use App\Models\Evento;
use App\Models\Produtor;

class EventoController extends Controller
{

    /**
     * The evento repository instance.
     *
     * @var EventoRepository
     */
    protected $eventos;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EventoRepository $eventos)
    {
        $this->middleware('auth');
        $this->eventos = $eventos;
    }

	/**
	 * Retorna uma lista com todos os eventos
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function index(Request $request)
	{


        $eventos = Evento::get();
        return view('admin.eventos.index', compact('eventos'));

	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $evento = new Evento;
        return view('admin.eventos.create-edit');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Get all the validation rules for eventos and assign it to the evento Model
        $this->validate($request, [
            'nome' => 'required',
            'descricao' => 'required',
            'data' => 'required',
            'hora' => 'required',
            'local' => 'required',
        ]);
        
        $evento = new Evento();

        $evento->nome = $request->nome;
        $evento->descricao = $request->descricao;
        $evento->data = $request->data;
        $evento->hora = $request->hora;
        $evento->local = $request->local;
      
// Salva o evento no banco de dados
        $evento->save();

        flash()->success('Evento criado com sucesso!');

        // Redirect back to Show all eventos page.
        return redirect('admin/eventos');
        
    }

/**
 *  ToDo
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {   

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $evento = Evento::findOrFail($id);

        // Recupera os produtors
        $produtores = Produtor::get();

        return view('admin.eventos.create-edit', compact('evento', 'produtores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {
        $this->validate($request, [
            'nome' => 'required',
            'descricao' => 'required',
            'data' => 'required',
            'hora' => 'required',
            'local' => 'required',
        ]);


        $eventos = Evento::findOrFail($id);

        $eventos->update($request->all());

        return redirect('admin/eventos');

    }
}