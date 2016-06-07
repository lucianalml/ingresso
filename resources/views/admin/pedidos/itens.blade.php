@extends('admin.layouts.master')

@section('content')

<!-- Dados do pedido -->
<div class="panel panel-default">
    <div class="panel-heading">Pedido {{ $pedido->id }}</div>

    <div class="panel-body">
    <p><b>Usuario:</b> {{ $pedido->user->name }}</p>
    <p><b>Data de criação:</b> {{ $pedido->created_at }}</p>
    <p><b>Data de atualização:</b> {{ $pedido->updated_at }}</p>
    <p><b>Status:</b> {{ $pedido->status }}</p>

    <a href="{{ url('admin/pedido/'.$pedido->id.'/ingressos') }}" class="btn btn-primary">
        Ingressos <i class="fa fa-ticket" aria-hidden="true"></i></a>

  </div>

<!-- Lista todos os itens do pedido -->
    <table class="table table-striped">

        <!-- Table Headings -->
        <thead>
            <th>#</th>
            <th>Lote</th>
            <th>Quantidade</th>
            <th>Valor Total</th>
        </thead>

        <!-- Table Body -->
        <tbody>
            @foreach ($pedido->itens as $key => $item)
                <tr>
                    <td class="table-text"><div>{{ $key + 1 }}</div></td>
    				<td class="table-text"><div>{{ $item->lote->descricao }}</div></td>
                    <td class="table-text"><div>{{ $item->quantidade }}</div></td>
                    <td class="table-text"><div>R$ {{ $item->valor }}</div></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>

@endsection
