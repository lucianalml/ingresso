<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\EventoRepository;

use App\Models\Evento;

class EventoController extends Controller
{

    /**
     * The task repository instance.
     *
     * @var TaskRepository
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
        return view('admin.eventos.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'nome' => 'required',
            'descricao' => 'required',
            'data' => 'required',
            'hora' => 'required',
            'local' => 'required',
        ]);
        
        // Get all the validation rules for eventos and assign it to the evento Model
        $evento = new Evento();

        $evento->nome = $request->nome;
        $evento->descricao = $request->descricao;
        $evento->data = $request->data;
        $evento->hora = $request->hora;
        $evento->local = $request->local;
      
/*
        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot create Evento because you are signed in as a test user.');
        } else {
            // Save the Eventos in DB
            $eventos->save();

            // Flash a success message
            flash()->success('Success', 'Evento created successfully!');
        }

*/

        // Save the Eventos in DB
        $evento->save();

        // Flash a success message
//        flash()->success('Success', 'Evento created successfully!');

        // Redirect back to Show all eventos page.
        return redirect('admin/eventos');
        
    }

}