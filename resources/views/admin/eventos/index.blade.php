@extends('admin.layouts.app')

@section('content')


<a href="{{ url('admin/evento/create') }}" class="btn btn-primary">Criar novo evento</a>
<br><br>

<!-- Lista todos os eventos existentes -->
@if (count($eventos) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Eventos cadastrados
        </div>

        <div class="panel-body">
            <table class="table table-striped evento-table">

                <!-- Cabeçalhos da tabela -->
                <thead>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Local</th>
                    <th>Editar</th>
                    <th>Imagens</th>
                </thead>

                <!-- Dados da tabela -->
                <tbody>
                    @foreach ($eventos as $evento)
                        <tr>
                            <td class="table-text"><div>{{ $evento->nome }}</div></td>
							<td class="table-text"><div>{{ $evento->data }}</div></td>
							<td class="table-text"><div>{{ $evento->hora }}</div></td>
							<td class="table-text"><div>{{ $evento->local }}</div></td>

                            <!-- Botão de editar -->
                            <td>
                                <a href="{{ url('admin/evento/'.$evento->id.'/edit') }}" class="btn btn-primary">
                                <i class="fa fa-btn fa-edit" aria-hidden="true"></i></a>
                            </td>
                            
                            <!-- Botão de inserir imagens -->
                            <td>
                                <a href="{{ url('admin/evento/'.$evento->id.'/imagens') }}" class="btn btn-primary">
                                <i class="fa fa-camera-retro" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

@endsection