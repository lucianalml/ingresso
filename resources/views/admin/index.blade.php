@extends('admin.layouts.default')

@section('content')
    
<h1 class="page-header">Dashboard</h1>

<div class="panel panel-default">
    <div class="panel-heading">Administração</div>

    <div class="panel-body">
        <a href="{{ url('admin/eventos') }}">Gerenciar Eventos</a>
        <br>
        <a href="{{ url('admin/produtores') }}">Gerenciar Produtores</a>
    </div>

</div>


@endsection
