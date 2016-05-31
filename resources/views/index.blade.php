@extends('layouts.app')

@section('content')

<h4 class="text-center">Próximos eventos</h4>

<div class="text-center">
    <div class="container-fluid">

        <div class="row">
            @foreach($eventos as $evento)

                <div class="col-sm-6 col-md-4">
                    <a href="{{ url('evento/'.$evento->id) }}">

                        <h3>{{ $evento->nome }}</h3>

                        @if ( $evento->imagens->count() > 0 )
                            <img src="{{ $evento->imagens->first()->thumbnail_path }}" 
                            style="width: 300px; height: 300px;"/>
                        @else
                            <img src="/ImagensEventos/img-nao-encontrada.jpg" 
                            style="width: 300px; height: 300px;"/>
                        @endif
                    </a>

                    <form action="/carrinho/add" method="post" name="add_to_cart">
                        {!! csrf_field() !!}
                        <input type="hidden" name="evento" value="{{$evento->id}}" />
                        <input type="hidden" name="qty" value="1" />
                        <br>
                        <button class="btn btn-primary">
                        <i class="fa fa-ticket" aria-hidden="true"></i> Ingressos</button>
                    </form>
                    <br>
                </div>
                @endforeach
			</div>

		</div>
	</div>
@endsection
