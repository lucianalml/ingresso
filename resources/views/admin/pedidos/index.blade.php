@extends('admin.layouts.master')

@section('content')

<!-- Lista todos os pedidos -->
    <div class="panel panel-default">
        <div class="panel-heading">
            Pedidos
        </div>

        <div class="panel-body">
            <table class="table table-striped">

                <!-- Table Headings -->
                <thead>
                    <th>Id</th>
                    <th>Status</th>
                    <th>Valor</th>
                    <th>Criado</th>
                    <th>Cliente</th>
                    <th>Detalhes</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <td class="table-text"><div>{{ $pedido->id }}</div></td>
							<td class="table-text"><div>{{ $pedido->status }}</div></td>
                            <td class="table-text"><div>R$ {{ $pedido->valor_total }}</div></td>
                            <td class="table-text"><div>{{ $pedido->created_at }}</div></td>
                            <td class="table-text"><div>{{ $pedido->user->name }}</div></td>
                            <td>
                                <a href="{{ url('admin/pedido/'.$pedido->id) }}" class="btn btn-primary">
                                <i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
