<script type="text/javascript" src="<?php echo BASE_URL?>/assets/js/clientes.js"></script>
<br>
<h2>Lista de clientes cadastrados</h2> <br>
<?php if (!empty($error)): ?>
	<div style="width: 100%; height: 40px; background: #ff0000; color: #fff; text-align: center; font-size: 20px; padding: 10px">
		<?php echo $msgError; ?>
	</div>
<?php endif;?>
<div class="col mb-3">
	<button class="btn btn-primary"><a href="<?php echo BASE_URL ?>">Voltar</a></button>
	<button class="btn btn-primary"><a href="<?php echo BASE_URL ?>/cliente/Insert">Cadastrar Cliente</a></button><br><br>
</div>

<script>
	function finalizar(id){
		var input = document.getElementById('cod_cliente');
		document.getElementById('cod_cliente').value = id;
	}
</script>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th scope="col">Código do Cliente</th>
			<th scope="col">Nome do Cliente</th>
			<th scope="col">Total do Pedido</th>
			<th scope="col">Data do Pedido</th>
			<th></th>
		</tr>
	</thead>
	<?php foreach($cliente as $dados): ?>
		<tr>
		 	<td><?php echo $dados['cod_cliente'] ?></td>
		 	<td><?php echo $dados['nome_cliente'] ?></td>
		 	<td><?php echo 'R$ ' .number_format($dados['total_pedido'],2,',','.') ; ?></td>
		 	<td><?php echo date('d/m/Y', strtotime($dados['data'])) ?></td>
		 	<td>
		 		<a href="<?php echo BASE_URL . '/cliente/ConsultaPedido/' .$dados['cod_cliente'] ?>">
			 		<button class="btn btn-secondary btn-lg">
			 			<img src="https://img.icons8.com/windows/30/000000/search.png" class="pesquisar">   
		 			</button></a>

		 		<a href="<?php echo BASE_URL .'/cliente/Update/'.$dados['cod_cliente'] ?>" ><button class="btn btn-info btn-lg"><img src="https://img.icons8.com/windows/30/000000/edit-file.png" class="editar"></button></a>
		 		<button data-id="<?php echo $dados['cod_cliente'] ?>" class="btn btn-danger btn-lg bt-delete-cliente" data-toggle="modal" data-target="#modal-confirm">
		 			<img src="https://img.icons8.com/windows/30/000000/delete.png" class="excluir">
		 				<a href="<?php echo BASE_URL .'/cliente/Delete/'.$dados['cod_cliente'] ?>" data-toggle="modal" data-target="#modal-confirm"></a>
		 		</button>

		 		<button data-id="<?php echo $dados['cod_cliente'] ?>" class="btn btn-success btn-lg btn-finalizar"><img src="https://img.icons8.com/windows/30/000000/checkout.png" class="finalizar"><a href="<?php echo BASE_URL .'/cliente/FinalizarPedido/'.$dados['cod_cliente'] ?>"></a></button>

		 	</td>

		 	<div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				<div class="modal-dialog" role="document" id="exampleModalLong<?php echo $dados['cod_cliente'];?>">
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