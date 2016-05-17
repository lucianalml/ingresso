@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-sm-offset-2 col-sm-8">

  			<a href="{{ url('admin/eventos') }}" class="btn btn-primary">Voltar</a>
  			<br><br>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Editando {{ $evento->nome }}
                </div>

                <div class="panel-body">

			        <!-- Display Validation Errors -->
			        @include('common.errors')

			        <!-- Form para editar eventos -->

			        <form action="{{ url('admin/evento/'.$evento->id.'/edit') }}" method="POST" class="form-horizontal" id="form">
			            {{ csrf_field() }}

			            <!-- Nome -->
			            <div class="form-group">
			                <label for="nome" class="col-sm-3 control-label">Nome</label>

			                <div class="col-sm-6">
			                    <input type="text" name="nome" id="nome" class="form-control" value="{{ $evento->nome }}">
			                </div>
			            </div>

						<!-- Descrição -->
			            <div class="form-group">
			                <label for="descricao" class="col-sm-3 control-label">Descrição</label>

			                <div class="col-sm-6">
			                	<textarea name="descricao" id="descricao" class="form-control" form="form" rows="5">
			                		{{ $evento->descricao }}
			                	</textarea>
			                </div>
			            </div>


			            <!-- Data -->
			            <div class="form-group">
			                <label for="data" class="col-sm-3 control-label">Data</label>

			                <div class="col-sm-6">
			                    <input type="date" name="data" id="data" class="form-control" value="{{ $evento->data }}">
			                </div>
			            </div>

			            <!-- Hora -->
			            <div class="form-group">
			                <label for="hora" class="col-sm-3 control-label">Hora</label>

			                <div class="col-sm-6">
			                    <input type="time" name="hora" id="hora" class="form-control" value="{{ $evento->hora }}">
			                </div>
			            </div>

			            <!-- Local -->
			            <div class="form-group">
			                <label for="local" class="col-sm-3 control-label">Local</label>

			                <div class="col-sm-6">
			                    <input type="text" name="local" id="local" class="form-control" value="{{ $evento->local }}">
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

            <!-- Gerenciamento de lotes -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lotes
                </div>
				<div class="panel-body">


				<table class="table table-striped evento-table">
                    <thead>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th></th>
                    </thead>

                    <tbody>


                        @foreach ($evento->lotes as $lote)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text"><div>{{ $lote->descricao }}</div></td>
								<td class="table-text"><div>{{ $lote->preco }}</div></td>
                                <td>
                                    <!-- Editar -->
                                    <a href="{{ url('admin/evento/'.$evento->id.'/lote/'.$lote->id.'/edit' ) }}" class="btn btn-primary">
                                    <i class="fa fa-btn fa-edit"></i>Editar</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

        		<!-- Cadastrar novo lote -->               	
            	<div class="panel panel-default">
	                <div class="panel-heading">
	                    Novo Lote
	                </div>
				<div class="panel-body">
                	<form action="{{ url('admin/evento/'.$evento->id.'/lote') }}"  method="POST" class="form-horizontal">
	                    {{ csrf_field() }}

	                    <!-- Descrição -->
	                    <div class="form-group">
	                        <label for="lote-descricao" class="col-sm-3 control-label">Descrição</label>

	                        <div class="col-sm-6">
	                        	<input type="text" name="descricao" id="lote-descricao" class="form-control">
	                        </div>
	                    </div>

	                    <!-- Valor -->
	                    <div class="form-group">
	                        <label for="lote-preco" class="col-sm-3 control-label">Preço</label>

	                        <div class="col-sm-6">
	                        	<input type="number" name="preco" id="lote-preco" class="form-control">
	                        </div>
	                    </div>

	                    <!-- Botão Adicionar -->
	                    <div class="form-group">
	                        <div class="col-sm-offset-3 col-sm-6">
	                            <button type="submit" class="btn btn-default">
	                                <i class="fa fa-btn fa-plus"></i>Adicionar lote
	                            </button>
	                        </div>
	                    </div>
	                </form>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection