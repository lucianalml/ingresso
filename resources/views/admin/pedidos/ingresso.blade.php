<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title">{{ $ingresso->pedidoItem->lote->evento->nome }} 
        - {{ date('d/m/Y', strtotime($ingresso->pedidoItem->lote->evento->data)) }}
        </h2>

    </div>

    <div class="panel-body">

    	<h3>Ingresso</h3>
    		<b>Lote:</b>{{ $ingresso->pedidoItem->lote->descricao }} <br>
    		<b>Valor:</b> R$ {{ $ingresso->pedidoItem->valor_unitario }}

        <h3>Dados do evento</h3>
			<b>Local:</b> {{ $ingresso->pedidoItem->lote->evento->local }} <br>
			<b>Data:</b> {{ $ingresso->pedidoItem->lote->evento->data }} <br>
			<b>Hora:</b> {{ $ingresso->pedidoItem->lote->evento->hora }} <br>

    	<h3>Dados do Portador do Ingresso</h3>
	        <b>Nome:</b> {{ $ingresso->nome }} <br>
	        <b>Documento:</b> {{ $ingresso->documento }}

        <p>
            Esse ingresso é possoal e intransferível. Obrigatório apresentar
            um documento com foto. Blablabla blablabla.
        </p>
        
        <h3>Código</h3>
        <div class="visible-print text-center">
            {!! QrCode::size(100)->generate($ingresso->qr_code); !!}
        </div>

        <p>
        Venda: {{ $ingresso->pedidoItem->pedido->id }}.{{ $ingresso->pedidoItem->id }}
        </p>

    </div>
</div>