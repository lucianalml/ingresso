@extends('layouts.master')

@section('title')
    Ingresso.Art
@endsection

@section('content')

<div class="page-header">
  <h1>Próximos eventos</h1>
</div>

@forelse(array_chunk($eventos->all(),4) as $row)
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

                        <div class="text-center">
                        <p><a href="{{ url('evento/'.$evento->id) }}" class="btn btn-success" role="button">
                        <i class="fa fa-ticket" aria-hidden="true"></i> Ingressos</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@empty
    <p>Nenhum evento localizado</p>
@endforelse

{{ $eventos->appends(Request::except('page'))->links() }}

@endsection