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
    <body id="LoginForm" style="background-color: #DCDCDC; font-family:'Bookman'; font-size: 13pt;">
        <div class="container">
            <h1 class="form-heading"></h1>
            <div class="login-form">
                <div class="main-div">
                    <div class="panel">
                        <h1>Bem vindo ao nosso sistema</h1>
                        <p>Entre com seu usuário e sua senha</p>
                    </div>
                    <form method="post" class="conteudo">
                        <div class="form-group">
                            <input type="text" class="form-control" name="login" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control"name="senha" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary botao">Login</button><br><br>

                        <a href="<?php echo BASE_URL ?>/CadastroUsuario/InsertUsuario">Cadastre-se</a>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>