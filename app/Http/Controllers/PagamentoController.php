<?php

namespace App\Http\Controllers;

use Cielo\Cielo;
use Cielo\CieloException;
use Cielo\Transaction;
use Cielo\Holder;
use Cielo\PaymentMethod;

use App\Http\Requests;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Validator;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {

        // TODO - verificar se o pagamento é do usuario logado
	
        return view('shop.pagamento', compact('pedido'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$validator = Validator::make($request->all(), 
            ['cartao' => 'required',
            ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)
                        ->withInput();
        }
        else
        {   
            
            flash()->success('Parabens! Pagamento do pedido '. 
                $request->get('pedido'). ' confirmado!');

            return redirect('/');
        }*/

	$mid = '12345678'; //seu merchant id
	$key = 'xxxx'; //sua chave

	$cielo = new Cielo($mid, $key, Cielo::TEST);

	$holder = $cielo->holder('4012001037141112', 2018, 5, Holder::CVV_INFORMED, 123);
	$order = $cielo->order('178148599', 1000);
	$paymentMethod = $cielo->paymentMethod(PaymentMethod::VISA, PaymentMethod::CREDITO_A_VISTA);


	
	
	$transaction = $cielo->transaction($holder,
                                   $order,
                                   $paymentMethod,
                                   'http://localhost/cielo.php',
                                   Transaction::AUTHORIZE_WITHOUT_AUTHENTICATION,
                                   true);

	try {

    		$transaction = $cielo->transactionRequest($transaction);

      		if ($transaction->getAuthorization()->getLR() == 0)
          		printf("Transação autorizada com sucesso. TID=%s\n", $transaction->getTid());

 	 }	 
	catch (CieloException $e) {

      		printf("Opz[%d]: %s\n", $e->getCode(), $e->getMessage());
		dd($transaction);
 	 }	
    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
