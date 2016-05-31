<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-ticket" aria-hidden="true"></i> Gerenciar lotes
    </div>

    <div class="panel-body">

        <!-- Erros de validação -->
        @include('common.errors')

        <table class="table table-striped">
            <thead>
                <th>Descrição</th>
                <th>Valor</th>
                <th></th>
            </thead>

            <tbody>
                @foreach ($evento->lotes as $lote)
                    <tr>
                        <!-- Task Name -->
                        <td class="table-text"><div>{{ $lote->descricao }}</div></td>
                        <td class="table-text"><div>{{ $lote->preco }}</div></td>
                        <td>
                            <!-- Editar -->
                            <a href="{{ url('admin/lote/'.$lote->id.'/edit' ) }}" class="btn btn-primary">
                            <i class="fa fa-btn fa-edit"></i>Editar</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <!-- Cadastrar novo lote -->                
        <div class="panel panel-default">
            <div class="panel-heading">
                Novo Lote
            </div>
            <div class="panel-body">
                <form action="{{ url('admin/evento/'.$evento->id.'/lote') }}"  method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Descrição -->
                    <div class="form-group">
                        <label for="lote-descricao" class="col-sm-3 control-label">Descrição</label>

                        <div class="col-sm-6">
                            <input type="text" name="descricao" id="lote-descricao" class="form-control">
                        </div>
                    </div>

                    <!-- Valor -->
                    <div class="form-group">
                        <label for="lote-preco" class="col-sm-3 control-label">Preço</label>

                        <div class="col-sm-6">
                            <input type="number" name="preco" id="lote-preco" class="form-control">
                        </div>
                    </div>

                    <!-- Botão Adicionar -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>Adicionar lote
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>