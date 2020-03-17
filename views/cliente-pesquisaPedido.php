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
<h2>Pesquisa pedido pelo código</h2>
<form id="form-cadastro-cliente" method="POST">
	<div class="col-md-2 mb-3">
		<button class="btn btn-primary"><a href="<?php echo BASE_URL ?>/cliente">Voltar</a></button>
		<button class="btn btn-primary">Procurar</button>
		<br><br>
	</div>
	<div class="col-md-2 mb-3">
		<label for="cod_pedido">Código do Usuário</label>
        <input type="text" class="form-control" name="cod_usuario" id="cod_usuario" required>
	</div>
</form>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th scope="col">Código do Pedido</th>
			<th scope="col">Código do Cliente</th>
			<th scope="col">Código do Usuário</th>
			<th scope="col">Nome do Produto</th>
			<th scope="col">Valor do Produto</th>
			<th></th>
		</tr>
	</thead>
	
	<?php foreach($pedido as $dados): ?>

		<tr>
		 	<td><?php echo $dados['cod_pedido'] ?></td>
		 	<td><?php echo $dados['cod_cliente'] ?></td>
		 	<td><?php echo $dados['cod_usuario'] ?></td>
		 	<td><?php echo $dados['nome_produto'] ?></td>
		 	<td><?php echo 'R$ ' .number_format($dados['valor_produto'],2,',','.') ; ?></td>	 	
		 	<td></td>
		 </tr>
	<?php endforeach;?>
</table>