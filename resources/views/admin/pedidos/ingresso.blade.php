<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title">{{ $ingresso->pedidoItem->lote->evento->nome }} 
        - Dia {{ $ingresso->pedidoItem->lote->evento->data }} </h2>
    </div>

    <div class="panel-body">

    	<h3>Lote</h3>
    		{{ $ingresso->pedidoItem->lote->descricao }}
    		Valor R$ {{ $ingresso->pedidoItem->valor_unitario }}

        <h3>Dados do evento</h3>
			<b>Local:</b> {{ $ingresso->pedidoItem->lote->evento->local }} <br>
			<b>Data:</b> {{ $ingresso->pedidoItem->lote->evento->data }} <br>
			<b>Hora:</b> {{ $ingresso->pedidoItem->lote->evento->hora }} <br>

    	<h3>Dados do Portador do Ingresso</h3>
	        <b>Nome:</b> {{ $ingresso->nome }} <br>
	        <b>Documento:</b> {{ $ingresso->documento }}
        
        <h3>Código</h3>
        	{{ $ingresso->qr_code }}

    </div>
</div>