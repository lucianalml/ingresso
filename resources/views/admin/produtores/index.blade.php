@extends('admin.layouts.default')

@section('content')

	<a href="{{ url('admin/produtor/create') }}" class="btn btn-primary">Adicionar novo produtor</a>
	<br><br>

<!-- Lista todos os produtores -->
@if (count($produtores) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Produtores cadastrados
        </div>

        <div class="panel-body">
            <table class="table table-striped produtor-table">

                <!-- Table Headings -->
                <thead>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Celular</th>
                    <th></th>
                    <th></th>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @foreach ($produtores as $produtor)
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text"><div>{{ $produtor->user->name }}</div></td>
							<td class="table-text"><div>{{ $produtor->user->email }}</div></td>
							<td class="table-text"><div>{{ $produtor->celular }}</div></td>
                            <td>
                                <!-- Editar -->
                                <a href="{{ url('admin/produtor/'.$produtor->id.'/edit') }}" class="btn btn-primary">
                                <i class="fa fa-btn fa-edit"></i>Editar</a>
                            </td>

                            <td>
                                <!-- Visualizar eventos TODO enviar para rota-->
                                <a href="{{ url('admin/eventos') }}" class="btn btn-primary">
                                <i class="fa fa-btn fa-headphones"></i>Eventos</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection