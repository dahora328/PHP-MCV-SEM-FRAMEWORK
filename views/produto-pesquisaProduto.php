<script type="text/javascript" src="<?php echo BASE_URL?>/assets/js/produtos.js"></script>
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
<h2>Pesquisar produto pelo nome</h2>

<form id="form-cadastro-cliente" method="POST">
	<div class="col-md-2 mb-3">
		<button class="btn btn-primary"><a href="<?php echo BASE_URL ?>/produto">Voltar</a></button>
		<button class="btn btn-primary">Procurar</button>
		<br><br>
	</div>
	<div class="col-md-2 mb-3">
		<label for="nome_produto">Nome do Cliente</label>
        <input type="text" class="form-control" name="nome_produto" id="nome_produto" required>
	</div>
</form>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th scope="col">Código do Produto</th>
			<th scope="col">Nome do Produto</th>
			<th scope="col">Valor do Produto</th>
			<th></th>
		</tr>
	</thead>
	<?php foreach($produto as $dados): ?>
			<tr>
			 	<td><?php echo $dados['cod_produto'] ?></td>
			 	<td><?php echo $dados['nome_produto'] ?></td>
			 	<td><?php echo 'R$ '.number_format($dados['valor_produto'],2,',','.') ; ?></td>
			 	<td>
			 		<a href="<?php echo BASE_URL .'/produto/UpdateProduto/'.$dados['cod_produto'];?>">
			 			<button class="btn btn-info btn-lg"><img src="https://img.icons8.com/windows/30/000000/edit-file.png" class="editar"></button></a>
			 		<button data-id="<?php echo $dados['cod_produto'] ?>" class="btn btn-danger btn-lg bt-delete-produto" data-toggle="modal" data-target="#modal-confirm">
			 			<img src="https://img.icons8.com/windows/30/000000/delete.png" class="excluir">
			 				<a href="<?php echo BASE_URL .'/produto/DeleteProduto/'.$dados['cod_produto'] ?>" data-toggle="modal" data-target="#modal-confirm"></button></a>
			 	</td>
			 	<div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
					<div class="modal-dialog" role="document" id="exampleModalLong<?php echo $dados['cod_produto'];?>">
						<div class="modal-content">
							<div class="modal-header">
								
								<h5 class="modal-title" id="exampleModalLongTitle">Atenção</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<h4 id="modal-conteudo">Confirma exclusão do produto?></h4>
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