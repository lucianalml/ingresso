@extends('layouts.default')

@section('content')

<div class="panel panel-default">
    <div class="panel-body">
        @foreach ($eventos as $evento)
        <p> {{ $evento->nome }} </p>
	        @foreach ($evento->imagens as $imagem)
	        	<p> {{ $imagem->path }} </p>
	        @endforeach
        @endforeach
    </div>
</div>

@endsection


