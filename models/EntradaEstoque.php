<?php 
	class EntradaEstoque{
		public function getAllEstoque(){
			$dados = array();
			$sql = 'select * from estoque order by cod_estoque';
			$stm = Conexao::getInstance()->prepare($sql);
			$stm->execute();
			if ($stm->rowCount() > 0) {
				$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
			}
			return $dados;
		}
		public function getByIdEstoque($cod_estoque){
			$dados = array();
			$sql = 'select * from estoque where cod_estoque = :cod_estoque';
			$stm = Conexao::getInstance()->prepare($sql);
			$stm->bindValue(':cod_estoque', addslashes($cod_estoque));
			$stm->execute();
			if ($stm->rowCount() > 0) {
				$dados = $stm->fetch(PDO::FETCH_ASSOC);
			}
			return $dados;
		}
		public function insertEstoque($entradaEstoque=array()){
			$sql = 'insert into estoque set ';
			$sql .= 'quantidade_entrada = :quantidade_entrada, ';
			$sql .= 'data_entrada = :data_entrada, ';
			$sql .= 'cod_produto = :cod_produto ';
			$stm = Conexao::getInstance()->prepare($sql);
			$stm->bindValue(':quantidade_entrada', addslashes($entradaEstoque['quantidade_entrada']));
			$stm->bindValue(':data_entrada', addslashes($entradaEstoque['data_entrada']));
			$stm->bindValue(':cod_produto', addslashes($entradaEstoque['cod_produto']));
			$stm->execute();
		}
		public function updateEstoque($entradaEstoque=array()){
			$sql = 'update estoque set ';
			$sql .= 'quantidade_entrada = :quantidade_entrada, ';
			$sql .= 'data_entrada = :data_entrada ';
			$sql .= 'where cod_estoque = :cod_estoque ';
			$stm = Conexao::getInstance()->prepare($sql);
			$stm->bindValue(':quantidade_entrada', addslashes($entradaEstoque['quantidade_entrada']));
			$stm->bindValue(':data_entrada', addslashes($entradaEstoque['data_entrada']));
			$stm->bindValue(':cod_estoque', addslashes($entradaEstoque['cod_estoque']));
			$stm->execute();
		}
		public function deleteEstoque($cod_estoque){
			$sql = 'delete from estoque where cod_estoque = :cod_estoque';
			$stm = Conexao::getInstance()->prepare($sql);
			$stm->bindValue(':cod_estoque', addslashes($cod_estoque));
			$stm->execute();
		}
		public function somaEstoque($cod_produto){
			$dados = array();
			$sql = 'select p.cod_produto, sum(e.quantidade_entrada) as estoque from estoque e inner join produto p on e.cod_produto = p.cod_produto where e.cod_produto = :cod_produto group by :cod_produto';
			$stm = Conexao::getInstance()->prepare($sql);
			$stm->bindValue(':cod_produto', addslashes($cod_produto));
			$stm->execute();
			if ($stm->rowCount() > 0) {
				$dados = $stm->fetch(PDO::FETCH_ASSOC);
				return $dados['estoque'];
			}
			return 0;
		}
	}
?>