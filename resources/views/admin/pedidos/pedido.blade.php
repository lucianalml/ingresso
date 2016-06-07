@extends('admin.layouts.master')

@section('content')

<!-- Dados do pedido -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title">Pedido {{ $pedido->id }}</h2>
    </div>

    <div class="panel-body">
        <p><b>Usuario:</b> {{ $pedido->user->id }}</p>
        <p><b>Nome:</b> {{ $pedido->user->name }}</p>
        <p><b>Email:</b> {{ $pedido->user->email }}</p>
        <p><b>Data de criação:</b> {{ $pedido->created_at }}</p>
        <p><b>Data de atualização:</b> {{ $pedido->updated_at }}</p>
        <p><b>Status:</b> {{ $pedido->status }}</p>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Itens do Pedido</h3>
        </div>

        <div class="panel-body">
            <!-- Lista todos os itens do pedido -->
            <table class="table table-striped">

                <!-- Cabeçalho -->
                <thead>
                    <th>#</th>
                    <th>Lote</th>
                    <th>Quantidade</th>
                    <th>Valor Total</th>
                </thead>

                <!-- Rodapé -->
                  <tfoot>
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th>R$ {{ $pedido->valor_total }}</th>
                    </tr>
                  </tfoot>

                <!-- Tabela -->
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
    </div>

    
    <br>
    <!-- Lista todos os ingressos do pedido -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Ingressos</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">

                <!-- Cabeçalho -->
                <thead>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Documento</th>
                    <th>Ingresso</th>
                </thead>

                <!-- Tabela -->
                <tbody>
                    @foreach ($pedido->itens as $item)
                        @foreach ($item->ingressos as $ingresso)
                            <tr>
                                <td class="table-text"><div>{{ $ingresso->id }}</div></td>
                                <td class="table-text"><div>{{ $ingresso->nome }}</div></td>
                                <td class="table-text"><div>{{ $ingresso->documento }}</div></td>
                                <!-- Ver ingresso -->
                                <td>
                                    <a href="{{ url('admin/ingresso/'.$ingresso->id) }}" class="btn btn-primary">
                                    <i class="fa fa-qrcode" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
