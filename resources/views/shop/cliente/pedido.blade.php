@extends('layouts.master')

@section('title')
    Ingresso.Art
@endsection

@section('content')

<!-- Dados do pedido -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title">Pedido #{{ $pedido->id }} - 
        {{ date('d/m/Y', strtotime($pedido->created_at)) }}</h2>
    </div>

    <div class="panel-body">       
        <p><b>Atualizado:</b> {{ date('d/m/Y', strtotime($pedido->updated_at)) }}</p>
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
                    <th>Evento</th>
                    <th>Lote</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Valor Total</th>
                </thead>

                <!-- Rodapé -->
                  <tfoot>
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th></th>
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
                            <td class="table-text"><div>{{ $item->lote->evento->nome }}</div></td>
            				<td class="table-text"><div>{{ $item->lote->descricao }}</div></td>
                            <td class="table-text"><div>{{ $item->quantidade }}</div></td>
                            <td class="table-text"><div>R$ {{ $item->valor_unitario }}</div></td>
                            <td class="table-text"><div>R$ {{ $item->valor_total }}</div></td>
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
                    <th>Evento</th>
                    <th>Lote</th>
                    <th>Nome</th>
                    <th>Documento</th>
                    <th>Editar</th>
                    <th>Imprimir</th>
                </thead>

                <!-- Tabela -->
                <tbody>
                    @foreach ($pedido->itens as $item)
                        @foreach ($item->ingressos as $ingresso)
                            <tr>
                                <td class="table-text"><div></div></td>
                                <td class="table-text"><div>{{ $ingresso->pedidoItem->lote->evento->nome }}</div></td>
                                <td class="table-text"><div>{{ $ingresso->pedidoItem->lote->descricao }}</div></td>
                                <td class="table-text"><div>{{ $ingresso->nome }}</div></td>
                                <td class="table-text"><div>{{ $ingresso->documento }}</div></td>

                                <!-- Editar dados do portador do ingresso -->
                                <td>
                                    <a href="{{ url('/ingresso/'.$ingresso->id.'/edit') }}" class="btn btn-primary">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                </td>
                                
                                <!-- Imprimir ingresso -->
                                <td>
                                    <a href="{{ url('/ingresso/'.$ingresso->id) }}" class="btn btn-primary">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
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
