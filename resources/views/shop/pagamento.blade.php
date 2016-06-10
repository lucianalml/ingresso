@extends('layouts.master')

@section('title')
    Ingresso.Art
@endsection

@section('content')

<!-- Cadastrar novo lote -->
<div class="panel panel-default">
    <div class="panel-heading">
        Pagamento do Pedido #{{ $pedido->id }}
    </div>
    <div class="panel-body">
        <form action="{{ url('/pagamento/'.$pedido->id) }}"  method="POST" class="form-horizontal">
            {{ csrf_field() }}
            
            <!-- Pedido -->
            <input type="hidden" name="pedido" value="{{$pedido->id}}">
            
            <!-- Descrição -->
            <div class="form-group">
                <label for="cartao" class="col-sm-3 control-label">Cartao de crédito</label>

                <div class="col-sm-6">
                    <input type="text" name="cartao" id="cartao" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="Ano" class="col-sm-3 control-label">Ano</label>

                <div class="col-sm-6">
                    <input type="text" name="ano" id="ano" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="mes" class="col-sm-3 control-label">Mes</label>

                <div class="col-sm-6">
                    <input type="text" name="mes" id="mes" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="cvv" class="col-sm-3 control-label">CVV</label>

                <div class="col-sm-6">
                    <input type="text" name="cvv" id="cvv" class="form-control">
                </div>
            </div>

            <!-- Botão de salvar -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-floppy-o"></i> Salvar
                    </button>
                </div>
            </div>

        </form>


</div>
</div>


@endsection
