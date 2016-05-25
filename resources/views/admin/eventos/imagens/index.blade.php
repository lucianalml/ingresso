@extends('admin.layouts.default')

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

        <!-- Imagens cadastradas -->
        <div class="col-md-12 gallery">
            @foreach ($evento->imagens->chunk(4) as $set)
                <div class="row" id="image_row">
                    @foreach ($set as $photo)
                        <div class="col-xs-6 col-sm-3 col-md-3 gallery_image">
                            <label>{{ $photo->id }}</label>                            
                            <div class="img-wrap">
                                <form method="post" action="/store/admin/products/photos/{{ $photo->id }}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="close">&times;</button>
                                    <a href="{{ $photo->path }}" data-lity>
                                        <img src="{{ $photo->thumbnail_path }}" alt="" data-id="{{ $photo->id }}">
                                    </a>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <!-- Form para inserir novas imagens-->        
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