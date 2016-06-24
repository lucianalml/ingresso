@extends('admin.layouts.master')

@section('content')

<!-- Dados do pagamento -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title">Pagamento #{{ $pagamento->id }} - 
    </div>

    <div class="panel-body">
        <p><b>Data:</b> {{ date('d/m/Y', strtotime($pagamento->data)) }}</p>
        <p><b>Data de criação:</b> {{ date('d/m/Y', strtotime($pagamento->created_at)) }}</p>
        <p><b>Útima atualização:</b> {{ date('d/m/Y', strtotime($pagamento->updated_at)) }}</p>
        <p><b>Tipo:</b> {{ $pagamento->tipo }}</p>
        <p><b>Transacao:</b> {{ $pagamento->transacao }}</p>

        <p><b>Status:</b>  </p>
        
        <p><b>Última atualização:</b> {{ date('d/m/Y', strtotime($pagamento->updated_at)) }}</p>
       

    </div>
</div>

@endsection
