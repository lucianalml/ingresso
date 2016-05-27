<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Evento;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
// TODO - Verificar....
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $eventos = Evento::get();

        return view('index', compact('eventos'));
    }
}
