<div>
	<?php if (!empty($error)): ?> 
		<?php if ($error == '1'):?>
			<h4><?php echo $msgError; ?></h4>
		<?php endif;?>
	<?php endif;?>
</div>
<h2>Editar Estoque</h2>
<form id="form-consultaPedido-cliente" method="POST">	
<div class="col-md-3 mb-3">
	<button class="btn btn-primary"><a href="<?php echo BASE_URL. '/produto/ConsultaEstoque/' .$estoque['cod_produto'] ?>">Voltar</a></button>
	<button class="btn btn-primary">Atualizar Estoque</button>
</div>
	
		<div class="col-md-2 mb-3">
			<label for="quantidade_entrada">Quantidade de Estoque</label>
			<input type="text" class="form-control" onkeyup="somenteNumeros(this);" name="quantidade_entrada" id="quantidade_entrada"  value="<?php echo $estoque['quantidade_entrada'] ?>" required>
		</div>
		<div class="col-md-2 mb-3">
			<label for="data_entrada">Data do Estoque</label>
			<input type="date" class="form-control" onkeyup="somenteNumeros(this);" name="data_entrada" id="data_entrada"  value="<?php echo $estoque['data_entrada'] ?>" required>
		</div>
		<input type="hidden" class="form-control" name="cod_usuario" value="<?php echo $_SESSION['login']['cod_usuario'] ?>">
		<!--cod_cliente vem do ClienteController-->
	
</form>