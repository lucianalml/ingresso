@extends('admin.layouts.default')

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

		                    <!-- Table Headings -->
		                    <thead>
		                        <th>Nome</th>
		                        <th>Data</th>
		                        <th>Hora</th>
		                        <th>Local</th>
		                        <th></th>
		                    </thead>

		                    <!-- Table Body -->
		                    <tbody>
		                        @foreach ($eventos as $evento)
		                            <tr>
		                                <!-- Task Name -->
		                                <td class="table-text"><div>{{ $evento->nome }}</div></td>
										<td class="table-text"><div>{{ $evento->data }}</div></td>
										<td class="table-text"><div>{{ $evento->hora }}</div></td>
										<td class="table-text"><div>{{ $evento->local }}</div></td>
		                                <td>
		                                    <!-- Editar -->
		                                    <a href="{{ url('admin/evento/'.$evento->id.'/edit') }}" class="btn btn-primary">
		                                    <i class="fa fa-btn fa-edit"></i>Editar</a>
		                                </td>
		                            </tr>
		                        @endforeach
		                    </tbody>
		                </table>
		            </div>
		        </div>
		    @endif

@endsection