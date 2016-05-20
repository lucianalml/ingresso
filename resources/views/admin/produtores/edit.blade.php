@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-sm-offset-2 col-sm-8">

		<a href="{{ url('admin/produtores') }}" class="btn btn-primary">Voltar</a>
		<br><br>

        <div class="panel panel-default">
            <div class="panel-heading">
                
					Editando {{ $produtor->user->name }}
            </div>

            <div class="panel-body">

		        <!-- Exibe os erros de validação -->
		        @include('common.errors')

		        <!-- Form para editar produtors -->
				    <form action="{{ url('admin/produtor/'.$produtor->id.'/edit') }}" method="POST" class="form-horizontal" id="form">

		            {{ csrf_field() }}

		            <!-- Nome -->
		            <div class="form-group">
		                <label for="nome" class="col-sm-3 control-label">Nome</label>

		                <div class="col-sm-6">

				    	<input type="text" name="nome" id="nome" class="form-control" value="{{ $produtor->user->name }}">
		                    
		                </div>
		            </div>

		            <!-- Celular -->
		            <div class="form-group">
		                <label for="celular" class="col-sm-3 control-label">Celular</label>

		                <div class="col-sm-6">
	                    	<input type="text" name="celular" id="celular" class="form-control" value="{{ $produtor->celular }}">
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
	</div>
</div>

@endsection