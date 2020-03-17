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
<script type="text/javascript" src="<?php echo BASE_URL?>/assets/js/estoque.js"></script>
<h2>Entrada do Estoque do Produto </h2>
<form id="form-consultaPedido-cliente" method="POST">	
<div class="col-md-3 mb-3">
	<button class="btn btn-primary"><a href="<?php echo BASE_URL ?>/produto">Voltar</a></button>
	<button class="btn btn-primary">Adicionar Estoque</button>
</div>
	<div class="form-row col-md-12 mb-3">
		<div class="col-md-2 mb-3">
			<label for="quantidade_entrada">Entrada de Estoque</label>
			<input type="text" class="form-control" onkeyup="somenteNumeros(this);" name="quantidade_entrada" id="quantidade_entrada" required>
		</div>
		<div class="col-md-2 mb-3">
			<label for="data_entrada"> Data de Entrada</label>
			<input type="date" class="form-control" onkeyup="somenteNumeros(this);" name="data_entrada" id="quantida_entrada" required>
		</div>
		<input type="hidden" class="form-control" name="cod_produto" value="<?php echo $cod_produto ?>" readonly>
		<input type="hidden" class="form-control" name="cod_usuario" value="<?php echo $_SESSION['login']['cod_usuario'] ?>">
		<!--cod_cliente vem do ClienteController-->
	</div>
</form>
<table class="table table-striped table-hover"><br>
	<thead>
		<tr>
			<th scope="col">Código do Produto</th>
			<th scope="col">Nome do Produto</th>
			<th scope="col">Data do Estoque</th>
			<th scope="col">Entrada em Estoque</th>
			<th></th>
	</thead>
	<?php foreach($estoque as $dados): ?>
		<tr>
			<td><?php echo $dados['cod_produto'] ?></td>
			<td><?php echo $dados['nome_produto'] ?></td>
			<td><?php echo date('d/m/Y', strtotime($dados['data_entrada'])) ?></td>
			<td><?php echo $dados['quantidade_entrada'] ?></td>
		 	<td>
		 		<a href="<?php echo BASE_URL .'/produto/UpdateEstoque/' .$dados['cod_estoque'] ?>" ><button class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#modal-confirm"><img src="https://img.icons8.com/windows/30/000000/edit-file.png" class="editar"></button></a>
		 		<button data-id="<?php echo $dados['cod_estoque'] ?>" class="btn btn-danger btn-lg bt-delete-produto" data-toggle="modal" data-target="#exampleModal">
		 			<img src="https://img.icons8.com/windows/30/000000/delete.png" class="excluir">
		 				<a href="<?php echo BASE_URL .'/produto/DeleteEstoque/' .$dados['cod_estoque'] ?>" data-toggle="modal" data-target="#exampleModal"></a></button>
		 	</td>
		 	<div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				<div class="modal-dialog" role="document" id="exampleModalLong<?php echo $dados['cod_estoque'];?>">
					<div class="modal-content">
						<div class="modal-header">
							
							<h5 class="modal-title" id="exampleModalLongTitle">Atenção</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<h4 id="modal-conteudo">Confirma exclusão do cliente?</h4>
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
		 </tr>
	<?php endforeach;?>
</table>