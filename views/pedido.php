<table class="table table-striped"><br>
	<thead>
		<tr>
			<th scope="col">Código do Cliente</th>
			<th scope="col">Nome do Cliente</th>
			<th scope="col">Total do Pedido</th>
			<th scope="col">Data do Pedido</th>
			<th></th>
		</tr>
	</thead>
	<?php foreach($pedido as $dados): ?>
		<tr>
		 	<td><?php echo $dados['cod_produto'] ?></td>
		 	<td><?php echo $dados['nome_produto'] ?></td>
		 	<td></td>
		 </tr>
	<?php endforeach;?>
</table>