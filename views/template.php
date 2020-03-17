<!DOCTYPE html>
<html>
<head>
	<title>Pedidos</title>
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/assets/css/template.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
  <script type="text/javascript" src="<?php echo BASE_URL?>/assets/js/template.js"></script>
</head>
<body style="font-family:'Bookman'; font-size: 13pt;">
  
    <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
    <a class="navbar-brand" href="<?php echo BASE_URL ?>/home">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Cliente
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo BASE_URL ?>/cliente">Consultar Clientes</a>
              <a class="dropdown-item" href="<?php echo BASE_URL ?>/cliente/Insert">Cadastrar Cliente</a>
              <a class="dropdown-item" href="<?php echo BASE_URL ?>/cliente/PesquisarNome">Pesquisar Clientes</a>
              <a class="dropdown-item" href="<?php echo BASE_URL ?>/cliente/PesquisaPedido">Pesquisar Pedido</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Produto
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo BASE_URL ?>/produto">Consultar Produtos</a>
              <a class="dropdown-item" href="<?php echo BASE_URL ?>/produto/InsertProduto">Cadastrar Produto</a>
              <a class="dropdown-item" href="<?php echo BASE_URL ?>/produto/PesquisaProduto">Pesquisar Produtos</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Estoque
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo BASE_URL ?>/produto/InsertProduto">Cadastrar Estoque</a>
            </div>
          </li>
            <!-- <a class="navbar-brand" href="<?php echo BASE_URL ?>/home">Relatório</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
        </ul>
      </div>
      <ul class="navbar-nav mr-auto sair">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['login']['nome_usuario'] ?>
              </a>
              <div class="dropdown-menu tela-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo BASE_URL .'/CadastroUsuario/UpdateUsuario/' .$_SESSION['login']['cod_usuario'] ?>">Minha Conta</a>
                <button data-id="<?php echo $_SESSION['login']['cod_usuario'] ?>" class="btn btn-link btn-deletar" data-toggle="modal" data-target="#modal-confirm">
                  <a class="nav-item nav-link" data-toggle="modal" data-target="#modal-confirm">
                    Deletar conta
                  </a>
                </button>
                <button data-id="<?php echo $_SESSION['login']['cod_usuario'] ?>" class="btn btn-link btn-sair" data-toggle="modal" data-target="#modal-confirm">
                  <a class="nav-item nav-link" data-toggle="modal" data-target="#modal-confirm">
                    Sair da Conta
                  </a>
                </button>   
            </div>
          </li>
        </ul>
    </nav>
  	<nav>
      <h1>Sistema emissor de pedidos</h1>
      <hr>
  	</nav>

    <div class="conteudo">
      <?php $this->loadView($viewName,$viewData); ?>
    </div>
    <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document" id="exampleModalLong">
          <div class="modal-content">
            <div class="modal-header">
              
              <h5 class="modal-title" id="exampleModalLongTitle">Atenção</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h4 id="modal-conteudo"></h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
              <button type="button" id="btn-modal-sim" class="btn btn-primary">
                Sim
              </button>
            </div>
          </div>
        </div>
      </div>
    <script type="text/javascript">
        var BASE_URL = '<?php echo BASE_URL; ?>';
    </script>
    <footer>

      <script src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.min.js"></script>
      <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </footer>
</body>
</html>