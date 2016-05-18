@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Administração</div>

                <div class="panel-body">
                    <a href="{{ url('admin/eventos') }}">Gerenciar Eventos</a>
                    <a href="{{ url('admin/produtores') }}">Gerenciar Produtores</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
