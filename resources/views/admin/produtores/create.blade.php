@extends('admin.layouts.default')

@section('content')

    <!-- Lista todos os usuarios -->
    @if (count($usuarios) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Usuários
            </div>

            <div class="panel-body">
                <table class="table table-striped usuario-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Adicionar</th>
                        <th>Remover</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <!-- Dados do usuário -->
                                <td class="table-text"><div>{{ $usuario->name }}</div></td>
								<td class="table-text"><div>{{ $usuario->email }}</div></td>
                                <td>
                                    <!-- Adicionar produtor -->
					                @if( $usuario->isProdutor() == false )
										
									{!! Form::open(array('action' => array('ProdutorController@store', $usuario->id ))) !!}

											<button type="submit" name="add" class="btn btn-success"><i class="fa fa-plus" ></i></button>

									{!! Form::close() !!}

									@endif
                                </td>

                                <td>
                                	<!-- Eliminar produtor -->
                                    @if( $usuario->isProdutor() )

									{!! Form::open(array('action' => array('ProdutorController@destroy', $usuario->id))) !!}

					                {{ Form::hidden('_method', 'DELETE') }}

											<button type="submit" name="del" class="btn btn-danger"><i class="fa fa-minus" ></i></button>

									{!! Form::close() !!}

                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection