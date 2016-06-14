@extends('admin.layouts.master')

@section('content')

<!-- Lista todos os pedidos -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Pedidos</h4>
        </div>

        <div class="panel-body">

            <div class="container-fluid">
            <form class="form-horizontal" role="form">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email" for="pedido">Pedido:
                    </label>
                    <div class="col-sm-10">
                        <input type="tex" class="form-control" id="pedido">
                    </div>
                </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-default" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i> Buscar
                        </button>
                    </div>
                </div>

            </form>

            </div>

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

        {{ $pedidos->appends(Request::except('page'))->links() }}

    </div>



@endsection
