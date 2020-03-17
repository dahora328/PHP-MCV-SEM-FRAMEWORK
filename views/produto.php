<script type="text/javascript" src="<?php echo BASE_URL?>/assets/js/produtos.js"></script>
<h2>Lista de Produtos Cadastrados</h2>
<div class="col mb-3">
	<button class="btn btn-primary"><a href="<?php echo BASE_URL ?>">Voltar</a></button>
	<button class="btn btn-primary"><a href="<?php echo BASE_URL ?>/Produto/InsertProduto">Novo Produto</a></button>
	<br><br>
</div>
<?php if (!empty($error)): ?>
	<div style="width: 100%; height: 40px; background: #ff0000; color: #fff; text-align: center; font-size: 20px; padding: 10px">
		<?php echo $msgError; ?>
	</div>
<?php endif;?>
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
			 	<td><?php echo $dados['valor_produto'] ?'R$ '.number_format((float)$dados['valor_produto'],2,',','.') : '' ; ?></td>
			 	<td>
			 		<a href="<?php echo BASE_URL . '/produto/ConsultaEstoque/' .$dados['cod_produto'] ?>">
			 		<button class="btn btn-secondary btn-lg">
			 			<img src="https://img.icons8.com/windows/30/000000/search.png" class="pesquisar">   
		 			</button></a>
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