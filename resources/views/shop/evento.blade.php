@extends('layouts.app')

@section('content')


    <div class="panel panel-default">
    	<!-- Dados do evento -->
        <div class="panel-heading">
            Eventos cadastrados
        </div>

        <div class="panel-body">
			
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

			<!-- Ingressos disponíveis -->
			<div class="panel panel-default">
		        <div class="panel-heading">
		            Ingressos disponíveis
		        </div>	        

		        <div class="panel-body">

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

		                    <td>
		                    	<input type="number" name="quantidade" value="{{ $ingresso['quantidade'] }}" />
		                    </td>

		                    <td>
		                    	<input type="number" name="valor_total" value="{{ $ingresso['valor_total'] }}" readonly/>
		                    </td>

		                    <td>
							<!-- Adicionar ao carrinho -->
		                    	<button class="btn" name="lote" value="{{ $ingresso['lote_id'] }}">
		                    		<i class="fa fa-shopping-cart"></i>
		                    	</button>
		                    </td>

			                </tr>
						{!! Form::close() !!}
			            @endforeach
			        </tbody>
				    </table>
			    </div>
			</div>

		<!-- Resumo do pedido -->
			<div class="panel panel-default">
		        <div class="panel-heading">
		            Resumo do pedido
		        </div>

		        <div class="panel-body">
					@if( isset($carrinho) )

					Testes carrinho
					<br>

						@foreach ($carrinho as $item)
						{{ $item['lote_id'] }} - {{ $item['quantidade'] }}
						<br>
						@endforeach

					@endif

				</div>
			</div>

		</div>
	</div>

@endsection
