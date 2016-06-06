<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Pedido;
use App\Models\Produtor;
use App\User;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function showFormLogin()
    {
    	return view('admin.auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|min:3|max:100',
            'password' => 'required|min:3|max:100'
        ]);

        $credentials = [ 'email' => $request->email, 
            'password' => $request->password ];

        if ( auth()->guard('admin')->attempt($credentials ) ) {
            return redirect('/admin');
        } else {
            return back()
                ->withErrors(['email' => 'Usuário ou senha inválidos!'])
                ->withInput();
        }

    }

    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect('/admin/login');
    }

    public function listarProdutores()
    {
        $produtores = Produtor::get();
        return view('admin.produtores.index', compact('produtores'));
    }

    public function listarUsuarios()
    {
        $users = User::get();
        return view('admin.usuarios', compact('users'));
    }

    public function listarPedidos()
    {
        $pedidos = Pedido::get();
        return view('admin.pedidos', compact('pedidos'));
    }
}
