@extends('admin.layouts.master')

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
                    <th>Ativo</th>
                    <th></th>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @foreach ($produtores as $produtor)
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text"><div>{{ $produtor->name }}</div></td>
							<td class="table-text"><div>{{ $produtor->email }}</div></td>
                            

                            @if ($produtor->ativo == 1)
                                <td class="table-text"><div>
                                <input name="ativo" type="checkbox" checked="checked" disabled readonly>
                                </div></td>
                            @else
                                <td class="table-text"><div>
                                <input name="ativo" type="checkbox" disabled readonly>
                                </div></td>
                            @endif


                            <td>
                                <!-- Editar -->
                                <a href="{{ url('admin/produtor/'.$produtor->id.'/edit') }}" class="btn btn-primary">
                                <i class="fa fa-btn fa-edit"></i>Editar</a>
                            </td>

                            <td>
                                <!-- Eventos do produtor - TODO-->
                                <a href="{{ action('EventoController@index', 
                                ['produtor' => $produtor->id ]) }}" class="btn btn-primary">
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