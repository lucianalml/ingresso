@extends('layouts.master')

@section('title')
    Ingresso.Art
@endsection

@section('content')

<h4 class="text-center">Próximos eventos</h4>

@foreach(array_chunk($eventos->all(),4) as $row)
    <div class="row">
        @foreach($row as $evento)
            <div class="col-md-3">
                <div class="thumbnail">

                    @if ( $evento->imagens->count() > 0 )
                        <img src="{{ $evento->imagens->first()->thumbnail_path }}" alt="{{ $evento->nome }}">
                    @else
                        <img src="/ImagensEventos/img-nao-encontrada.jpg">
                    @endif

                    <div class="caption">
                        <h3>{{ $evento->nome }}</h3>
                        <p>{{ $evento->descricao }}</p>

                        <p><a href="{{ url('evento/'.$evento->id) }}" class="btn btn-success" role="button">
                        <i class="fa fa-ticket" aria-hidden="true"></i> Ingressos</a></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach

@endsection