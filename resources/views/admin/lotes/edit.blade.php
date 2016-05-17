@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-sm-offset-2 col-sm-8">

  			<a href="{{ url('admin/evento/'.$evento->id .'/lotes'  ) }}" class="btn btn-primary">Voltar</a>
  			<br><br>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Editando {{ $lote->descricao }}
                </div>

                <div class="panel-body">

			        <!-- Display Validation Errors -->
			        @include('common.errors')

			        <!-- Form para editar o lote -->
			        <form action="{{ url('admin/evento/'.$evento->id.'/lote/'.$lote->id.'/edit' ) }}" method="POST" class="form-horizontal" id="form">
			            {{ csrf_field() }}

						<!-- Descrição -->
			            <div class="form-group">
			                <label for="descricao" class="col-sm-3 control-label">Descrição</label>


			                <div class="col-sm-6">
			                	<input type="text" name="descricao" id="descricao" class="form-control" value ="{{ $lote->descricao }}">
			                </div>
			            </div>


			            <!-- Valor -->
			            <div class="form-group">
			                <label for="preco" class="col-sm-3 control-label">Preço</label>

			                <div class="col-sm-6">
			                    <input type="number" name="preco" id="preco" class="form-control" value="{{ $lote->preco }}">
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