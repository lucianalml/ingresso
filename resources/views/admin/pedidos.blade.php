@extends('admin.layouts.master')

@section('content')

<!-- Lista todos os produtores -->
    <div class="panel panel-default">
        <div class="panel-heading">
            Pedidos
        </div>

        <div class="panel-body">
            <table class="table table-striped produtor-table">

                <!-- Table Headings -->
                <thead>
                    <th>Id</th>
                    <th>Status</th>
                    <th>Valor</th>
                    <th>Criado</th>
                    <th>Cliente</th>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
