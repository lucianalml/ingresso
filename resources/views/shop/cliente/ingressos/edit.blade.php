@extends('layouts.master')

@section('title')
    Ingresso.Art
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Alterando dados do ingresso para {{ $ingresso->pedidoItem->lote->evento->nome }}</h3>
	</div>
	<div class="panel-body">
		
		<!-- Form para edição -->
	    <form action="{{ url('/ingresso/'.$ingresso->id.'/edit') }}" method="POST" class="form-horizontal" id="form">

			{{ csrf_field() }}

	        <!-- Nome -->
	        <div class="form-group">
				<label for="nome" class="col-sm-3 control-label">Nome</label>
				<div class="col-sm-6">
		    		<input type="text" name="nome" id="nome" class="form-control" 
		    		value="{{ old('nome', $ingresso->nome) }}">
		    	</div>
			</div>
			
	        <!-- Documento -->
	        <div class="form-group">
				<label for="documento" class="col-sm-3 control-label">Documento</label>
				<div class="col-sm-6">
		    		<input type="text" name="documento" id="documento" class="form-control" value="{{ old('documento', $ingresso->documento) }}">
		    	</div>
			</div>

            <!-- Botão de salvar -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-floppy-o"></i> Salvar
                    </button>
                </div>
            </div>

		</form>
	</div>
</div>

@endsection