<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Evento;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function index(Request $request)
	{

		$this->validate($request, [
            'evento' => 'required'
        ]);

        $search = $request->get('evento');

		$eventos = Evento::where('nome', 'like', '%' . $search . '%')
			->Paginate(8);

		// returns a view and passes the view the list of articles and the original query.
		return view('shop.index', compact('eventos'));
	}
}
