<!DOCTYPE html>
<html>
    <head>
      <title>Login</title>
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>/assets/login/css/login.css">
    </head>
    <?php if (!empty($error)): ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert" style="text-align: center;">
            <h4><?php echo $msg; ?></h4>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
          </button>
        </div>
	<?php endif?>
<h2 style="text-align: center;">Cadastrar novo usuário</h2>
<br>
<body style="font-family:'Bookman'; font-size: 13pt;">
	<form id="form-cadastro-usuario" method="POST">
		<div class="col-md-4 mb-3">
			<button class="btn btn-primary">Salvar</button>
			<button class="btn btn-primary"><a href="<?php echo BASE_URL ?>">Voltar</a></button><br><br>
		</div>
		<div class="col-md-4 mb-3">
			<label for="login">Nome do Usuário</label>
	        <input type="text" class="form-control" name="nome" id="nome" value="<?php echo !empty($nome) ? $nome_usuario : ''; ?>" required>
		</div>
		<div class="col-md-4 mb-3">
			<label for="login">Login do Usuário</label>
	        <input type="text" class="form-control" name="login" id="login" value="<?php echo !empty($login) ? $login_usuario : ''; ?>" required>
		</div>
		<div class="col-md-4 mb-3">
			<label for="senha">Senha do Usuário</label>
			<input type="password" class="form-control" name="senha" id="senha" value="<?php echo !empty($senha) ? $senha : ''; ?>">
		</div>
	</form>
</body>