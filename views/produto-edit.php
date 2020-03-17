<h2>Editar Dados do Produto</h2>
<form id="form-editar-produto" method="POST">
	<div class="col-md-2 mb-3">
		<button class="btn btn-primary"><a href="<?php echo BASE_URL ?>/produto">Voltar</a></button>
		<button class="btn btn-primary">Atualizar</button>
		<br><br>
	</div>
	<div>
		<?php if (!empty($error)): ?> 
			<?php if ($error == '1'):?>
				<h4><?php echo $msgError; ?></h4>
			<?php endif;?>
		<?php endif;?>
	</div>
	<div class="col-md-2 mb-3">
		<label for="nome_produto">Nome do Produto</label>
        <input type="text" class="form-control" name="nome_produto" id="nome_produto" value="<?php echo $produto['nome_produto'] ?>" required>
	</div>
	<div class="col-md-2 mb-3">
	<label for="valor_produto">Valor do Produto</label>
        <input type="text" class="form-control" name="valor_produto" onkeyup="somenteNumeros(this);" id="valor_produto" value="<?php echo $produto['valor_produto']; ?>" required>
	</div>
	<div class="col-md-2 mb-3">
	<label for="estoque_minimo">Estoque Mínimo</label>
        <input type="text" class="form-control" name="estoque_minimo" onkeyup="somenteNumeros(this);" id="estoque_minimo" value="<?php echo $produto['estoque_minimo']; ?>" required>
	</div>
</form>