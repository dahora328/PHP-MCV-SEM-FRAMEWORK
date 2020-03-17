<div>
	<?php if (!empty($error)): ?> 
		<?php if ($error == '1'):?>
			<h4><?php echo $msgError; ?></h4>
		<?php endif;?>
	<?php endif;?>
</div>
<h2>Cadastro de Produto</h2>
<div class="col-md-2 mb-3">
		<a class="btn btn-primary"href="<?php echo BASE_URL;?>/produto">Voltar</a>
		<button class="btn btn-primary">Salvar</button>
		<br><br>
	</div>
<form id="form-cad-prdouto" method="POST">
	
	<div class="col-md-2 mb-3">
		<label for="nome_produto">Nome do Produto</label>
        <input type="text" class="form-control" name="nome_produto" id="nome_produto" value="<?php echo !empty($nome_produto) ? $nome_produto : ''; ?>" required>
	</div>
	<div class="col-md-2 mb-3">
		<label for="valor_produto">Valor do Produto</label>
		<input type="text" class="form-control" name="valor_produto" onkeyup="somenteNumeros(this);" id="valor_produto" value="<?php echo !empty($valor_produto) ? $valor_produto : ''; ?>">
	</div>
	<div class="col-md-2 mb-3">
		<label for="valor_produto">Estoque Mínimo</label>
		<input type="text" class="form-control" name="estoque_minimo" onkeyup="somenteNumeros(this);" id="valor_produto" value="<?php echo !empty($estoque_minimo) ? $estoque_minimo : ''; ?>">
	</div>
	<div class="col-md-2 mb-3">
		<input type="hidden" class="form-control" name="cod_usuario" value="<?php echo $_SESSION['login']['cod_usuario'] ?>">
	</div>
</form>