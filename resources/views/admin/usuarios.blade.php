@extends('admin.layouts.master')

@section('content')

<!-- Lista todos os produtores -->
@if (count($users) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Usuários cadastrados
        </div>

        <div class="panel-body">
            <table class="table table-striped produtor-table">

                <!-- Table Headings -->
                <thead>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Pedidos</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text"><div>{{ $user->name }}</div></td>
							<td class="table-text"><div>{{ $user->email }}</div></td>

                            <td>
                                <!-- TODO Pedidos -->
                                <a href="{{ url('admin/pedidos/'.$user->id) }}" class="btn btn-primary">
                                <i class="fa fa-shopping-bag"></i></a>
                            </td>

                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

@endsection
