@extends('admin.layouts.master')

@section('content')

	<a href="{{ url('admin/evento/'.$lote->evento->id .'/edit'  ) }}" class="btn btn-primary">Voltar</a>
	<br><br>

    <div class="panel panel-default">
        <div class="panel-heading">
            Editando {{ $lote->descricao }}
        </div>

        <div class="panel-body">

	        <!-- Form para editar o lote -->
	        <form action="{{ url('admin/lote/'.$lote->id.'/edit' ) }}" method="POST" class="form-horizontal" id="form">
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

                <!-- Taxa Administrativa -->
                <div class="form-group">
                    <label for="lote-taxa" class="col-sm-3 control-label">Taxa Adm.</label>

	                <div class="col-sm-6">

	                <input type="number" name="taxa_adm" id="taxa_adm" class="form-control" min="0" max="15" value="{{ $lote->taxa_adm }}">
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