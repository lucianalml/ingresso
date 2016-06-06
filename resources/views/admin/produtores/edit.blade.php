@extends('admin.layouts.master')

@section('content')

<a href="{{ url('admin/produtores') }}" class="btn btn-primary">Voltar</a>
<br>

<!-- Desativar um produtor -->
<form method="post" action="/admin/produtor/{{ $produtor->id }}">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-danger">Desativar</button>
</form>

<br><br>

<div class="panel panel-default">
    <div class="panel-heading">
        
			Editando {{ $produtor->name }}
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

		    	<input type="text" name="name" id="name" class="form-control" value="{{ $produtor->name }}">
                    
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