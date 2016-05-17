@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-sm-offset-2 col-sm-8">

  			<a href="{{ url('admin/eventos') }}" class="btn btn-warning">Cancelar</a>
  			<br><br>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Novo evento
                </div>

                <div class="panel-body">

			        <!-- Display Validation Errors -->
			        @include('common.errors')

			        <!-- Form para novos eventos -->
			        <form action="{{ url('admin/evento/create') }}" method="POST" class="form-horizontal" id="formcreate">
			            {{ csrf_field() }}

			            <!-- Nome -->
			            <div class="form-group">
			                <label for="nome" class="col-sm-3 control-label">Nome</label>

			                <div class="col-sm-6">
			                    <input type="text" name="nome" id="nome" class="form-control">
			                </div>
			            </div>

						<!-- Descrição -->
			            <div class="form-group">
			                <label for="descricao" class="col-sm-3 control-label">Descrição</label>

			                <div class="col-sm-6">
			                	<textarea name="descricao" id="descricao" class="form-control" form="formcreate" rows="5"></textarea>
			                </div>
			            </div>


			            <!-- Data -->
			            <div class="form-group">
			                <label for="data" class="col-sm-3 control-label">Data</label>

			                <div class="col-sm-6">
			                    <input type="date" name="data" id="data" class="form-control">
			                </div>
			            </div>

			            <!-- Hora -->
			            <div class="form-group">
			                <label for="hora" class="col-sm-3 control-label">Hora</label>

			                <div class="col-sm-6">
			                    <input type="time" name="hora" id="hora" class="form-control">
			                </div>
			            </div>

			            <!-- Local -->
			            <div class="form-group">
			                <label for="local" class="col-sm-3 control-label">Local</label>

			                <div class="col-sm-6">
			                    <input type="text" name="local" id="local" class="form-control">
			                </div>
			            </div>


			            <!-- Botão adicionar evento -->
			            <div class="form-group">
			                <div class="col-sm-offset-3 col-sm-6">
			                    <button type="submit" class="btn btn-default">
			                        <i class="fa fa-plus"></i> Adicionar
			                    </button>
			                </div>
			            </div>

			        </form>
				</div>
            </div>

	</div>
</div>
@endsection