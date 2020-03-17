<div>
	<?php if (!empty($error)): ?> 
		<?php if ($error == '1'):?>
			<h4><?php echo $msgError; ?></h4>
		<?php endif;?>
	<?php endif;?>
</div>
<h2>Cadastrar novo cliente</h2>

<form id="form-cadastro-cliente" method="POST">
	<div class="col-md-2 mb-3">
		<a class="btn btn-primary" href="<?php echo BASE_URL ?>/cliente">Voltar</a>
		<button class="btn btn-primary">Salvar</button>
		<br><br>
	</div>
	<div class="col-md-2 mb-3">
		<label for="nome_cliente">Nome do Cliente</label>
        <input type="text" class="form-control" name="nome_cliente" id="nome_cliente" value="<?php echo !empty($nome_cliente) ? $nome_cliente : ''; ?>" required>
	</div>
	<div class="col-md-2 mb-3">
		<label for="data">Data do Pedido</label>
		<input type="date" class="form-control" name="data" id="data" value="<?php echo !empty($data) ? $data : ''; ?>" required>
	</div>
	<div class="col-md-2 mb-3">
		<input type="hidden" class="form-control" name="cod_usuario" id="cod_usuario" value="<?php echo $_SESSION['login']['cod_usuario'] ?>">
	</div>
</form>