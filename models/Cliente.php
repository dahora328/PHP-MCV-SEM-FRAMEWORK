<?php  
class Cliente{
	public function getAllClientes($cod_usuario){
		$dados = array();
		$sql = "select distinct cod_cliente, nome_cliente, total_pedido, data, (select sum(total_item) from pedido where cod_cliente = c.cod_cliente ) as total_pedido from cliente c inner join usuario on c.cod_usuario = $cod_usuario where coalesce(estado, 0) <> 1 order by cod_cliente asc";
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->execute();
		if ($stm->rowCount() > 0){
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function getByCodigo($codigo){
		$dados = array();
		$sql = "select * from cliente where cod_cliente = :codigo";
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(":codigo", addslashes($codigo));
		$stm->execute();

		if ($stm->rowCount() > 0){
			$dados = $stm->fetch(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function insertCliente($cliente=array()){
		$sql = "insert into cliente set ";
		$sql .= "nome_cliente = :nome_cliente, ";
		$sql .= "data = :data, ";
		$sql .= "cod_usuario = :cod_usuario";
	
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(":nome_cliente", addslashes($cliente['nome_cliente']));
		$stm->bindValue(":data", addslashes($cliente['data']));
		$stm->bindValue(":cod_usuario", addslashes($cliente['cod_usuario']));
		$stm->execute();
	}
	public function deleteCliente($codigo){
		$sql = "delete from cliente where cod_cliente = :cod_cliente";
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(":cod_cliente", addslashes($codigo));
		$stm->execute();
	}
	public function updateCliente($cliente=array()){
		$sql = "update cliente set ";
		$sql .= "nome_cliente = :nome_cliente, ";
		$sql .= "data = :data ";
		$sql .= "where cod_cliente = :cod_cliente";

		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(":nome_cliente", addslashes($cliente['nome_cliente']));
		$stm->bindValue(":data", addslashes($cliente['data']));
		$stm->bindValue(":cod_cliente", addslashes($cliente['cod_cliente']));
		$stm->execute();
	}
	public function consultaPedido($codigo){
		$dados = array();
		$sql = 'SELECT * FROM pedido p inner join cliente c on p.cod_cliente = :cod_cliente where p.cod_cliente = c.cod_cliente';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_cliente', addslashes($codigo));
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function updateTotalPedido($cod_cliente, $total_pedido){
		$sql = 'update cliente set ';
		$sql .= 'total_pedido = :total_pedido ';
		$sql .= 'where cod_cliente = :cod_cliente';

		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':total_pedido', addslashes($total_pedido));
		$stm->bindValue(':cod_cliente', addslashes($cod_cliente));
		$stm->execute();
	}
	public function finalizarPedido($cod_cliente){
		$sql = 'update cliente set ';
		$sql .= 'estado = 1 ';
		$sql .= 'where cod_cliente = :cod_cliente';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_cliente', addslashes($cod_cliente));
		$stm->execute();
	}
	public function pesquisarNome($nome_cliente){
		$dados = array();
		$sql = 'select * from cliente where nome_cliente like "%'.$nome_cliente.'%"';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function retornaFinalizado(){
		$dados = array();
		$sql = 'select * from cliente where coalesce(estado, 0) = 1 order by cod_cliente desc LIMIT 5';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
}
?>