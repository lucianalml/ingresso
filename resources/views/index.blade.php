@extends('layouts.app')

@section('content')

<h4 class="text-center animated zoomIn" id="featured-eventos-heading">Próximos eventos</h4>

<div class="text-center">
    <div class="container-fluid" id="Index-Main-Container">

        <div id="featured-eventos-sub-container">
            <div class="row">
                @foreach($eventos as $evento)

                    <div class="col-sm-6 col-md-3 animated zoomIn" id="featured-container">
                        <a href="{{ url('evento/'.$evento->id) }}">

                        @if ( $evento->imagens->count() > 0 )
                            <img src="{{ $evento->imagens->first()->thumbnail_path }}" />
                        @else
                            <img src="/ImagensEventos/img-nao-encontrada.jpg" 
                            style="width: 200px; height: 200px;">
                        @endif

                            <div id="featured-evento-name-container">
                                <h6 class="center-on-small-only" id="featured-evento-name"><br>{{ $evento->nome }}</h6>
                            </div>

                        </a>

                        <form action="/carrinho/add" method="post" name="add_to_cart">
                            {!! csrf_field() !!}
                            <input type="hidden" name="evento" value="{{$evento->id}}" />
                            <input type="hidden" name="qty" value="1" />
                            <button class="btn btn-default waves-effect waves-light">Se divertir!</button>
                        </form>
                        <br>
                    </div>
                    @endforeach
				</div>
			</div>
		</div>
	</div>
@endsection
