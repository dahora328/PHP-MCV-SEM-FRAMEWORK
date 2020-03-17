<?php  
class Pedido{
	public function getAllPedidos(){
		$dados = array();
		$sql = 'select * from pedido order by cod_pedido';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function getByIdPedido($cod_pedido){
		$dados = array();
		$sql = 'select * from pedido where cod_pedido = :cod_pedido';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_pedido', addslashes($cod_pedido));
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$dados = $stm->fetch(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function insertPedido($pedidos=array()){
		$sql = 'insert into pedido set ';
		$sql .= 'cod_produto = :cod_produto, ';
		$sql .= 'nome_produto = :nome_produto, ';
		$sql .= 'quantidade = :quantidade, ';
		$sql .= 'valor_produto = :valor_produto, ';
		$sql .= 'total_item = :total_item, ';
		// $sql .= 'estoque = :estoque ,';
		// $sql .= 'estoque_atual = :estoque_atual, ';
		$sql .= 'cod_cliente = :cod_cliente,';
		$sql .= 'cod_usuario = :cod_usuario ';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_produto', addslashes($pedidos['cod_produto']));
		$stm->bindValue(':nome_produto', addslashes($pedidos['nome_produto']));
		$stm->bindValue(':quantidade', addslashes($pedidos['quantidade']));
		$stm->bindValue(':valor_produto', addslashes($pedidos['valor_produto']));
		$stm->bindValue(':total_item', addslashes($pedidos['total_item']));
		// $stm->bindValue(':estoque', addslashes($pedidos['estoque']));
		// $stm->bindValue(':estoque_atual', addslashes($pedidos['estoque_atual']));
		$stm->bindValue(':cod_cliente', addslashes($pedidos['cod_cliente']));
		$stm->bindValue(':cod_usuario', addslashes($pedidos['cod_usuario']));
		$stm->execute();
	}
	public function updatePedido($pedidos=array()){
		$sql = 'update pedido set ';
		$sql .= 'cod_produto = :cod_produto, ';
		$sql .= 'nome_produto = :nome_produto, ';
		$sql .= 'quantidade = :quantidade, ';
		$sql .= 'valor_produto = :valor_produto, ';
		$sql .= 'total_item = :total_item ';
		// $sql .= 'estoque = :estoque ,';
		// $sql .= 'estoque_atual = :estoque_atual ';
		$sql .= 'where cod_pedido = :cod_pedido';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_produto', addslashes($pedidos['cod_produto']));
		$stm->bindValue(':nome_produto', addslashes($pedidos['nome_produto']));
		$stm->bindValue(':quantidade', addslashes($pedidos['quantidade']));
		$stm->bindValue(':valor_produto', addslashes($pedidos['valor_produto']));
		$stm->bindValue(':total_item', addslashes($pedidos['total_item']));
		// $stm->bindValue(':estoque', addslashes($pedidos['estoque']));
		// $stm->bindValue(':estoque_atual', addslashes($pedidos['estoque_atual']));
		$stm->bindValue(':cod_pedido', addslashes($pedidos['cod_pedido']));
		$stm->execute();
	}
	public function deletePedido($cod_pedido){
		$sql = 'delete from pedido where cod_pedido = :cod_pedido';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_pedido' , addslashes($cod_pedido));
		$stm->execute();
	}
	public function somaTotalItem($cod_cliente){
		$dados = array();
		$sql = 'select p.cod_cliente, sum(total_item) as total from pedido p inner join cliente c on p.cod_cliente = c.cod_cliente where p.cod_cliente = :cod_cliente group by :cod_cliente';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_cliente', addslashes($cod_cliente));
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$dados = $stm->fetch(PDO::FETCH_ASSOC);
			return $dados['total'];
		}
		return 0;
	}
	public function maisVendido(){
		$dados = array();
		$sql = 'select cod_produto, nome_produto,sum(quantidade) as quantidade from pedido GROUP by nome_produto desc ORDER BY quantidade DESC LIMIT 5';
		// echo $sql; exit();
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->execute();
		if ($stm->rowCount() > 0){
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function pesquisaPedido($cod_usuario){
		$dados = array();
		$sql = 'select * from pedido where cod_usuario = :cod_usuario';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_usuario', addslashes($cod_usuario));
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
}
?>