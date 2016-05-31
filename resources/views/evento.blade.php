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
				            <th></th>
				            <th>Quantidade</th>
				            <th></th>
				            <th>Total</th>
				        </thead>

				        <tbody>
				            @foreach ($evento->lotes as $lote)
				                <tr>
			                    <td class="table-text"><div>{{ $lote->descricao }}</div></td>
			                    <td class="table-text"><div>{{ $lote->preco }}</div></td>

			                    <td>
		                            <button type="submit" class="btn btn-default">
		                                <i class="fa fa-minus" aria-hidden="true"></i>
		                            </button>
			                    </td>
	
			                    <td>
			                    	Qtdade
			                    </td>

			                    <td>
		                            <button type="submit" class="btn btn-default">
		                                <i class="fa fa-plus" aria-hidden="true"></i>
		                            </button>
			                    </td>

			                    <td>
			                    	Valor Total
			                    </td>		                    

				                </tr>
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

				</div>
			</div>

		</div>
	</div>

@endsection
