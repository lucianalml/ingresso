@extends('layouts.master')

@section('title')
    Ingresso.Art
@endsection

@section('content')

<h1>Olá {{ $usuario->name}}!</h1>


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Dados de cadastro</h3>
	</div>
	<div class="panel-body">
		Nome: {{ $usuario->name }} <br>
		E-mail: {{ $usuario->email }} <br>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Pedidos</h3>
	</div>
	<!-- Table -->
	<table class="table">
	        <!-- Table Headings -->
	    <thead>
	        <th>Id</th>
	        <th>Status</th>
	        <th>Valor</th>
	        <th>Data</th>
	        <th>Detalhes</th>
	    </thead>

	    <!-- Table Body -->
	    <tbody>
	        @foreach ($usuario->pedidos as $pedido)
	            <tr>
	                <td class="table-text"><div>{{ $pedido->id }}</div></td>
					<td class="table-text"><div>{{ $pedido->status }}</div></td>
	                <td class="table-text"><div>R$ {{ $pedido->valor_total }}</div></td>
	                <td class="table-text"><div>{{ date('d/m/Y', strtotime($pedido->created_at)) }}</div></td>
	                <td>
	                    <a href="{{ url('areacliente/pedido/'.$pedido->id) }}" class="btn btn-primary">
	                    <i class="fa fa-eye" aria-hidden="true"></i></a>
	                </td>

	            </tr>
	        @endforeach
	    </tbody>
	</table>
</div>

@endsection