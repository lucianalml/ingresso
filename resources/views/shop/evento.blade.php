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
		
		{!! Form::open(array('url'=>'carrinho/add','method'=>'POST')) !!}
		<table class="table table-striped">
		<thead>
			<th>Descrição</th>
			<th>Valor</th>
			<th>Quantidade</th>
			<th>Valor total</th>
		</thead>

        <tbody>
            @foreach ($evento->lotes as $key => $lote)
				<input type="hidden" name="ingressos[{{$key}}][lote_id]"
                 value="{{ $ingressos[$key]['lote_id'] }}" />

                <tr>
                <td class="table-text"><div>{{ $lote->descricao }}</div></td>
                <td class="table-text"><div>R$ {{ $lote->valor_total }}</div></td>
				
				<!-- Recupera o valor que está no carrinho -->
                <td><input type="number" name="ingressos[{{$key}}][quantidade]"
                 min="0" value="{{ $ingressos[$key]['quantidade'] }}" /></td>

                <td>R$ {{ $lote->valor_total * $ingressos[$key]['quantidade'] }} </td>
				
                </tr>
			
            @endforeach
        </tbody>
	    </table>

		<!-- Atualizar carrinho -->
		<div class="pull-right">
		{!! Form::submit('Atualizar Carrinho', array( 'class'=>'btn btn-success' ))!!}
		</div>

	    {!! Form::close() !!}
    </div>

	<!-- Resumo do pedido -->
	@if (isset($pedido))
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

	    <!-- Rodapé -->
		<tfoot>
			<tr>
				<th>Total</th>
				<th></th>
				<th></th>
				<th></th>
				<th>R$ {{ $pedido->valor_total }}</th>
			</tr>
		</tfoot>

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
	
	@endif


@endsection
