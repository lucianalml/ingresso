@extends('layouts.master')

@section('title')
    Ingresso.Art
@endsection

@section('content')
			
	<h1> {{ $evento->nome }} </h1>

    @if ( $evento->imagens->count() > 0 )
        <img src="{{ $evento->imagens->first()->path }}"
        style="width: 600px; height: 400px;" />
    @else
        <img src="/ImagensEventos/img-nao-encontrada.jpg" 
        style="width: 200px; height: 200px;">
    @endif
    <br>
    			
	<p><b>Data:</b> {{ $evento->data }} </p>
	<p><b>Hora:</b> {{ $evento->hora }} </p>
	<p><b>Local:</b> {{ $evento->local }} </p>

	<p><b>Detalhes do eventos</b></p>
	{{ $evento->descricao }}
	
	<br><br>

	<!-- Ingressos disponíveis -->
	<div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-ticket" aria-hidden="true"></i><b> Ingressos disponíveis</b></h4>
        </div>	        

		<table class="table table-striped">
		<thead>
			<th>Descrição</th>
			<th>Valor</th>
			<th>Quantidade</th>
			<th>Valor total</th>
			<th></th>
		</thead>

        <tbody>
            @foreach ($ingressos as $ingresso)
			{!! Form::open(array('url'=>'carrinho/add','method'=>'POST')) !!}
                <tr>
                <td class="table-text"><div>{{ $ingresso['descricao'] }}</div></td>
                <td class="table-text"><div>{{ $ingresso['valor'] }}</div></td>

                <td><input type="number" name="quantidade" min="0" value="{{ $ingresso['quantidade'] }}" /></td>

                <td>R$ {{ $ingresso['valor_total'] }}</td>
				
				<!-- Adicionar ao carrinho -->
                <td><button class="btn btn-success" name="lote" value="{{ $ingresso['lote_id'] }}"><i class="fa fa-cart-plus" aria-hidden="true"></i>
                	</button></td>

                </tr>
			{!! Form::close() !!}
            @endforeach
        </tbody>
	    </table>
    </div>

	<!-- Resumo do pedido -->
	<div class="panel panel-default">
        <div class="panel-heading">
        	<h4><i class="fa fa-shopping-bag" aria-hidden="true"></i><b> Resumo do pedido</b></h4>
        </div>

		<table class="table table-striped">
		<thead>
			<th>Evento</th>
			<th>Lote</th>
			<th>Quantidade</th>
			<th>Valor total</th>
		</thead>

        <tbody>
        	@foreach ($pedido->itens as $item)
        	<tr>
			<td>{{ $item->lote->evento->nome }}</td>
			<td> {{ $item->lote->descricao }} </td>
			<td> {{ $item->quantidade }} </td>
			<td>R$ {{ $item->valor_total }} </td>
			</tr>
			@endforeach
		</tbody>
		</table>
		
		<br>
		<div class="pull-right">
		<a href="{{ url('checkout') }}" class="btn btn-success" role="button">
			<i class="fa fa-check" aria-hidden="true"></i> Prosseguir</a>	
		</div>
		<br>

	</div>


@endsection
