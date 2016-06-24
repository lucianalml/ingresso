@extends('admin.layouts.master')

@section('content')

<!-- Lista todos os pagamentos -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Pagamentos</h4>
        </div>

        <div class="panel-body">

            <table class="table table-striped">

                <!-- Cabeçalho -->
                <thead>
                    <th>Id</th>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Código</th>
                    <th>Status</th>
                    <th>Pedido</th>
                    <th>Detalhes</th>
                </thead>

                <!-- Itens -->
                <tbody>
                    @foreach ($pagamentos as $pagamento)
                        <tr>
                            <td class="table-text"><div>{{ $pagamento->id }}</div></td>
                            <td class="table-text"><div>{{ date('d/m/Y', strtotime($pagamento->created_at)) }}</div></td>

							<td class="table-text"><div>{{ $pagamento->tipo }}</div></td>
                            <td class="table-text"><div>{{ $pagamento->transacao }}</div></td>

                            <td class="table-text"><div></div></td>

                            <td>
                                <a href="{{ url('admin/pedido/'.$pagamento->pedido_id) }}" class="btn btn-primary">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                            </td>

                            <td>
                                <a href="{{ url('admin/pagamento/'.$pagamento->id) }}" class="btn btn-primary">
                                <i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $pagamentos->appends(Request::except('page'))->links() }}

    </div>



@endsection
