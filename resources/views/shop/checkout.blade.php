@extends('layouts.master')

@section('title')
    Ingresso.Art
@endsection

@section('content')

	<!-- Resumo do pedido -->
	<div class="panel panel-default">
        <div class="panel-heading">
        	<h4><i class="fa fa-shopping-bag" aria-hidden="true"></i><b> Checkout</b></h4>
        </div>
		<div class="panel-body">

			{!! Form::open(array('url'=>'/checkout','method'=>'POST')) !!}

        	@foreach ($ingressos as $ingresso)
			
				<h4> {{ $ingresso['evento_nome'] }} - {{ $ingresso['lote_descricao'] }} </h4>

				<br>

				<!-- Nome -->
	            <div class="form-group">
	                <label for="nome" class="control-label">Nome</label>
	                <input type="text" name="ingresso[{{ $ingresso['id'] }}][nome]" class="form-control">
				</div>
					<!-- Documento -->
				<div class="form-group">
	                <label for="documento" class="control-label">Documento</label>
	                <input type="text" name="ingresso[{{ $ingresso['id'] }}][documento]" class="form-control">
	            </div>
				<br><br>

			@endforeach

				<div class="pull-right">
				{!! Form::submit('Fechar pedido', array( 'class'=>'btn btn-success' )) !!}
				</div>

			{!! Form::close() !!}
		</div>
	</div>

@endsection