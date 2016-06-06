@extends('admin.layouts.master')

@section('content')


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

        <!-- Form para editar eventos -->
		@if( isset($evento) )
		    <form action="{{ url('admin/evento/'.$evento->id.'/edit') }}" method="POST" class="form-horizontal" id="form">
		@else
		<!-- Form para criar eventos -->
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


            <!-- Produtor -->
            <div class="form-group">
                <label for="produtor" class="col-sm-3 control-label">Produtor</label>

                <div class="col-sm-6">


                <select class="form-control" name="produtor_id" id="produtor_id">
                    @if( isset($evento) )
                        <option value="{{ $evento->propdutor_id }}"></option>

                        @foreach($produtores as $produtor)
                            <option value="{{ $produtor->id }}" {{ $evento->produtor_id == $produtor->id ? "selected" : "" }}>{{ $produtor->name }}</option>
                        @endforeach

                    @else
                        <option value="{{ old('produtor_id') }}"></option>
                        @foreach($produtores as $produtor)
                            <option value="{{ $produtor->id }}"
                            {{ old('produtor_id') == $produtor->id ? "selected" : "" }}>
                                {{ $produtor->name }}
                            </option>
                        @endforeach

                    @endif
                </select>
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

        @if( isset($evento) )
            @include('admin.lotes.evento-lotes')
        @endif

	</div>
</div>


@endsection