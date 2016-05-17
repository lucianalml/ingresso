@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-sm-offset-2 col-sm-8">

		<a href="{{ url('admin/eventos') }}" class="btn btn-primary">Voltar</a>
		<br><br>

        <div class="panel panel-default">
            <div class="panel-heading">
                
                @if( isset($evento) )
					Editando {{ $evento->nome }}
				@else
				    Novo evento
				@endif

            </div>

            <div class="panel-body">

		        <!-- Exibe os erros de validação -->
		        @include('common.errors')

		        <!-- Form para criar/editar eventos -->
				@if( isset($evento) )
				    <form action="{{ url('admin/evento/'.$evento->id.'/edit') }}" method="POST" class="form-horizontal" id="form">
				@else
				    <form action="{{ url('admin/evento/create') }}" method="POST" class="form-horizontal" id="form">
				@endif

		            {{ csrf_field() }}

		            <!-- Nome -->
		            <div class="form-group">
		                <label for="nome" class="col-sm-3 control-label">Nome</label>

		                <div class="col-sm-6">

				@if( isset($evento) )
				    <input type="text" name="nome" id="nome" class="form-control" value="{{ $evento->nome }}">
				@else
				    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}">
				@endif

		                    
		                </div>
		            </div>

					<!-- Descrição -->
		            <div class="form-group">
		                <label for="descricao" class="col-sm-3 control-label">Descrição</label>

		                <div class="col-sm-6">
		                	<textarea name="descricao" id="descricao" class="form-control" form="form" rows="5">
							@if( isset($evento) )
							    {{ $evento->descricao }}
							@else
							    {{ old('descricao') }}
							@endif		          
		                	</textarea>
		                </div>
		            </div>


		            <!-- Data -->
		            <div class="form-group">
		                <label for="data" class="col-sm-3 control-label">Data</label>

		                <div class="col-sm-6">
							@if( isset($evento) )
							    <input type="date" name="data" id="data" class="form-control" value="{{ $evento->data }}">
							@else
								<input type="date" name="data" id="data" class="form-control" value="{{ old('data') }}">
							@endif		                		
		                    
		                </div>
		            </div>

		            <!-- Hora -->
		            <div class="form-group">
		                <label for="hora" class="col-sm-3 control-label">Hora</label>

		                <div class="col-sm-6">
							@if( isset($evento) )
							    <input type="time" name="hora" id="hora" class="form-control" value="{{ $evento->hora }}">
							@else
								<input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora') }}">
							@endif
		                    
		                </div>
		            </div>

		            <!-- Local -->
		            <div class="form-group">
		                <label for="local" class="col-sm-3 control-label">Local</label>

		                <div class="col-sm-6">

							@if( isset($evento) )
		                    	<input type="text" name="local" id="local" class="form-control" value="{{ $evento->local }}">
							@else
		                    	<input type="text" name="local" id="local" class="form-control" value="{{ old('local') }}">
							@endif

		                </div>
		            </div>


		            <!-- Botão de salvar -->
		            <div class="form-group">
		                <div class="col-sm-offset-3 col-sm-6">
		                    <button type="submit" class="btn btn-success">
		                        <i class="fa fa-floppy-o"></i> Salvar
		                    </button>

		                    <!-- Botão de gerenciar lotes -->
		                    @if( isset($evento) )
                            	<a href="{{ url('admin/evento/'.$evento->id.'/lotes') }}" class="btn btn-primary">
                            	<i class="fa fa-ticket"></i> Gerenciar Lotes</a>
							@endif
		                </div>
		            </div>

		        </form>
			</div>
        </div>
	</div>
</div>

@endsection