<h2>Editar Pedido</h2>

<form id="form-editar-cliente-pedido" method="POST">
	<div class="col-md-2 mb-3">
		<a class="btn btn-primary" href="<?php echo BASE_URL. '/cliente/ConsultaPedido/' .$pedidos['cod_cliente'] ?>">Voltar</a>
		<button class="btn btn-primary">Atualizar</button>
	</div>
	<div class="col-md-2 mb-3">
		<label for="cod_produto">Codigo do produto</label>
		<input type="text" class="form-control" name="cod_produto" id="cod_produto" value="<?php echo $pedidos['cod_produto'] ?>" required>
	</div>
	<div class="col-md-2 mb-3">
		<label for="nome_produto">Nome do Produto</label>
		<input type="text" class="form-control" name="nome_produto" id="nome_produto" value="<?php echo $pedidos['nome_produto']?>" required readonly>
	</div>
	<div class="col-md-2 mb-3">
		<label for="quantidade">Quantidade</label>
		<input type="text" class="form-control" name="quantidade" id="quantidade"  onkeyup="somenteNumeros(this);" value="<?php echo $pedidos['quantidade'] ?>" required>
	</div>
	<div class="col-md-2 mb-3">
		<label for="valor_produto">Valor do Produto</label>
		<input type="text" class="form-control" name="valor_produto" id="valor_produto" value="<?php echo $pedidos['valor_produto'] ?>" required readonly>
	</div>
	<div class="col-md-2 mb-3">
		<label for="total_item">Total do Item</label>
		<input type="text" class="form-control" name="total_item" id="total_item" value="<?php echo $pedidos['total_item'] ?>" required readonly>
	</div>
		<input type="hidden" class="form-control" name="estoque" id="estoque"  readonly required>
		<input type="hidden" class="form-control" name="resultado" id="resultado"  readonly required>
		<input type="hidden" class="form-control" name="cod_produto" id="cod_produto" value="<?php echo $pedidos['cod_produto'] ?>" required readonly>
</form>