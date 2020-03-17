<div>
	<?php if (!empty($error)): ?> 
		<?php if ($error == '1'):?>
			<h4><?php echo $msgError; ?></h4>
		<?php endif;?>
	<?php endif;?>
</div>
<script type="text/javascript" src="<?php echo BASE_URL?>/assets/js/pedidos.js"></script>
<h2>Pedido do cliente <?php echo $cliente['nome_cliente'] ?></h2>
<!--$cliente vem da função consulta pedido do clientecontroller de onde esta vindo  
$dados['cliente'] = $ClienteModel->getByCodigo($cod_cliente);
-->
<form id="form-consultaPedido-cliente" method="POST">
	<div class="col-md-3 mb-3">
		<a class="btn btn-primary" href="<?php echo BASE_URL ?>/cliente">Voltar</a>
		<button class="btn btn-primary">Adicionar</button><br><br>
	</div>
	<div class="form-row col-md-12 mb-3">
		<div class="col-md-2 mb-3">
			<label for="cod_produto">Código do Produto</label>
			<input type="text" class="form-control" onkeyup="somenteNumeros(this);" name="cod_produto" id="cod_produto" required>
		</div>
		<div class="col-md-3 mb-3">
			<label for="nome_produto"> Nome do Produto</label>
			<input type="text" class="form-control" name="nome_produto" id="nome_produto" readonly required>
		</div>
		
		<div class="col-md-3 mb-3">
			<label for="quantidade">Quantidade</label>
			<input type="text" class="form-control" onkeyup="somenteNumeros(this);" name="quantidade" id="quantidade" required>
		</div>
		<div class="col-md-3 mb-3">
			<label for="valor_produto">Valor do Produto</label>
			<input type="text" class="form-control" name="valor_produto" id="valor_produto" readonly required>
		</div>
		<div class="col-md-2 mb-3">
			<label for="total_item">Valor Total do Item</label>
			<input type="text" class="form-control" name="total_item" id="total_item" readonly required>
		</div>
		<input type="hidden" class="form-control" name="estoque" id="estoque"  readonly required>
		<input type="hidden" class="form-control" name="resultado" id="resultado"  readonly required>
		<input type="hidden" class="form-control" name="cod_cliente" value="<?php echo $cod_cliente ?>">
		<input type="hidden" class="form-control" name="cod_usuario" value="<?php echo $_SESSION['login']['cod_usuario'] ?>">
		<!--cod_cliente vem do ClienteController-->
	</div>
</form>

<table class="table table-striped table-hover"><br>
	<thead>
		<tr>
			<th scope="col">Código do Pedido</th>
			<th scope="col">Codigo do Produto</th>
			<th scope="col">Nome do Produto</th>
			<th scope="col">Quantidade</th>
			<th scope="col">Valor do Produto</th>
			<th scope="col">Total do Item</th>
			<th></th>
		</tr>
	</thead>
	<?php foreach($pedidos as $dados): ?>
		<!--pedidos vem do ClienteController em dados['pedidos']-->
		<tr>
			<td><?php echo $dados['cod_pedido'] ?></td>
		 	<td><?php echo $dados['cod_produto'] ?></td>
		 	<td><?php echo $dados['nome_produto'] ?></td>
		 	<td><?php echo $dados['quantidade']?></td>
		 	<td><?php echo $dados['valor_produto'] ? 'R$ '.number_format((float)$dados['valor_produto'],2,',','.') : '' ;?></td>
		 	<td><?php echo $dados['total_item'] ? 'R$ '.number_format((float)$dados['total_item'],2,',','.') : '' ;?></td>
		 	<td>
		 		<a href="<?php echo BASE_URL .'/cliente/UpdatePedido/' .$dados['cod_pedido'] ?>" ><button class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#modal-confirm"><img src="https://img.icons8.com/windows/30/000000/edit-file.png" class="editar"></button></a>
		 		<button data-id="<?php echo $dados['cod_pedido'] ?>" data-produto="<?php echo $dados['cod_produto'] ?>"class="btn btn-danger btn-lg bt-delete-pedido" data-toggle="modal" data-target="#exampleModal">
		 			<img src="https://img.icons8.com/windows/30/000000/delete.png" class="excluir">
		 				<a href="<?php echo BASE_URL .'/cliente/DeletePedido/' .$dados['cod_pedido'] ?>" data-toggle="modal" data-target="#exampleModal"></a></button>
		 	</td>
		 	<div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				<div class="modal-dialog" role="document" id="exampleModalLong<?php echo $dados['cod_pedido'];?>">
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