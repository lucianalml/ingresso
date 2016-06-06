@extends('admin.layouts.master')

@section('content')

<a href="{{ url('admin/eventos') }}" class="btn btn-primary">Voltar</a>
<br><br>

<!-- Exibir as imagens-->
<div class="panel panel-default">
    <div class="panel-heading">
    	Imagens do evento {{ $evento->nome }}
    </div>

    <div class="panel-body">

        <!-- Erros de validação -->
        @include('common.errors')

        <!-- Exibir imagens cadastradas -->
        <div class="col-md-12 gallery">

            @foreach ($evento->imagens->chunk(4) as $set)
                <div class="row" id="image_row">
                    @foreach ($set as $imagem)
                        <div class="col-xs-6 col-sm-3 col-md-3 gallery_image">
                            <label>{{ $imagem->id }}</label>                            
                            <div class="img-wrap">
                                <form method="post" action="/admin/imagem/{{ $imagem->id }}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="close">&times;</button>
                                    <a href="{{ $imagem->path }}" data-lity>
                                        <img src="{{ $imagem->thumbnail_path }}" alt="" data-id="{{ $imagem->id }}">
                                    </a>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>

    <!-- Inserir imagens-->        
    <div class="panel panel-default">
        <div class="panel-heading">
            Cadastrar imagens
        </div>

        <div class="panel-body">

        {!! Form::open(array('url'=>'admin/evento/'.$evento->id.'/imagem','method'=>'POST', 'files'=>true)) !!}

        <div class="form-group">
            {!! Form::label('image', 'Escolha uma imagem') !!}
            {!! Form::file('image') !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Save', array( 'class'=>'btn btn-success' )) !!}
        </div>

        {!! Form::close() !!}

        </div>
	</div>
</div>
@endsection