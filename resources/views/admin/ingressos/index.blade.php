@extends('admin.layouts.master')

@section('content')

<!-- Lista todos os pedidos -->
    <div class="panel panel-default">
        <div class="panel-heading">
            Ingressos
        </div>

        <div class="panel-body">
            <table class="table table-striped">

                <!-- Table Headings -->
                <thead>
                    <th>Evento</th>
                    <th>Lote</th>
                    <th>Valor</th>
                    <th>Nome</th>
                    <th>Pedido</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @foreach ($ingressos as $ingresso)
                        <tr>
                            <td class="table-text"><div>{{ $ingresso->pedidoItem->lote->evento->nome }}</div></td>
							<td class="table-text"><div>{{ $ingresso->pedidoItem->lote->descricao }}</div></td>
                            <td class="table-text"><div>R$ {{ $ingresso->pedidoItem->valor_unitario }}</div></td>
                            <td class="table-text"><div>{{ $ingresso->nome }}</div></td>
                            <td>
                                <a href="{{ url('admin/pedido/'.$ingresso->pedidoItem->pedido->id) }}" class="btn btn-primary">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
