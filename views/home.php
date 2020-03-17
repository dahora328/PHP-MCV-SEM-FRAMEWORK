<div class="card-deck">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title" style="text-align: center;">Últimos usuários cadastrados do sistema</h5>
		<table class="table table-hover"><br>
			<thead>
				<tr>
					<th scope="col">Codigo do Usuário</th>
					<th scope="col">Nome do Usuário</th>
					<th></th>
				</tr>
			</thead>
			<?php foreach ($usuario as $user): ?>
				<tr>
					<td><?php echo $user['cod_usuario'] ?></td>
					<td><?php echo $user['nome_usuario'] ?></td>
				 	<td></td>
				 </tr>
			<?php endforeach;?>
		</table>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title" style="text-align: center;">Últimos pedidos finalizados</h5>
      <table class="table table-hover"><br>
			<thead>
				<tr>
					<th scope="col">Código do cliente</th>
					<th scope="col">Nome do cliente</th>
					<th></th>
				</tr>
			</thead>
			<?php foreach ($cliente as $dados): ?>
				<tr>
					<td><?php echo $dados['cod_cliente'] ?></td>
					<td><?php echo $dados['nome_cliente'] ?></td>
				 	<td></td>
				 </tr>
			<?php endforeach;?>
		</table>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title" style="text-align: center;">Produtos mais vendidos</h5>
      <table class="table table-hover"><br>
			<thead>
				<tr>
					<th scope="col">Código do produto</th>
					<th scope="col">Nome do Produto</th>
					<th></th>
				</tr>
			</thead>
			<?php foreach ($pedido as $dados): ?>
				<tr>
					<td><?php echo $dados['cod_produto'] ?></td>
					<td><?php echo $dados['nome_produto'] ?></td>
				 	<td></td>
				 </tr>
			<?php endforeach;?>
		</table>
    </div>
  </div>
</div>

