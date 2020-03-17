<div class="card bg-light mb-3 fundo" style="max-width: 40rem;">
  <div class="card-header"><h2>Editar conta do <?php echo $_SESSION['login']['nome_usuario'] ?></h2></div>
  <div class="card-body">
    <h5 class="card-title" style="text-align: center;">Dados do Usuário</h5>

    <form id="form-editar-usuario" method="POST">
    	<div class="col-md-12 mb-3">
			<button class="btn btn-primary"><a href="<?php echo BASE_URL ?>">Voltar</a></button>
			<button class="btn btn-primary">Salvar</button>
			<br>
		</div>
		<div>
			<?php if (!empty($error)): ?> 
				<div class="alert alert-primary alert-dismissible fade show" role="alert" style="text-align: center;">
		        	<h4><?php echo $msg; ?></h4>
		       		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            	<span aria-hidden="true">&times;</span>
		      		</button>
		   		</div>
			<?php endif;?>
		</div>
		<div class="col-md-12 mb-3">
			<label for="login">Nome</label>
	        <input type="text" class="form-control" name="nome_usuario" id="nome_usuario" value="<?php echo $_SESSION['login']['nome_usuario']; ?>" required>
		</div>
		<div class="col-md-12 mb-3">
			<label for="login">Login</label>
	        <input type="text" class="form-control" name="login" id="login" value="<?php echo $_SESSION['login']['login_usuario']; ?>" required>
		</div>
		<div class="col-md-12 mb-3">
			<label for="senha">Senha</label>
	        <input type="password" class="form-control" name="senha" id="senha">
		</div>

		<div class="col-md-12 mb-3">
			<label for="senha">Repita sua Senha</label>
	        <input type="password" class="form-control" name="confirma_senha" id="confirma_senha">
		</div>
	</form>
</div>