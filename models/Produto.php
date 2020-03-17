<?php 
class Produto{
	public function getAllProdutos($cod_usuario){
		$dados = array();
		$sql = "select distinct cod_produto, nome_produto, valor_produto from produto p inner join usuario on p.cod_usuario = $cod_usuario order by cod_produto asc";
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->execute();
		if ($stm->rowCount() > 0){
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function getByIdProduto($codigoProduto){
		$sql = 'select * from produto where cod_produto = :codigoProduto';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':codigoProduto', addslashes($codigoProduto));
		$stm->execute();

		if ($stm->rowCount() > 0) {
			$dados = $stm->fetch(PDO::FETCH_ASSOC);
		}
		return $dados;
	}

	public function insertProduto($produto=array()){
		$sql = 'insert into produto set ';
		$sql .= 'nome_produto = :nome_produto, ';
		$sql .= 'valor_produto = :valor_produto,';
		$sql .= 'estoque_minimo = :estoque_minimo, ';
		$sql .= 'cod_usuario = :cod_usuario ';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':nome_produto', addslashes($produto['nome_produto']));
		$stm->bindValue(':valor_produto', addslashes($produto['valor_produto']));
		$stm->bindValue(':estoque_minimo', addslashes($produto['estoque_minimo']));
		$stm->bindValue(':cod_usuario', addslashes($produto['cod_usuario']));
		$stm->execute();
	}
	public function updateProduto($produto=array()){
		$sql = 'update produto set ';
		$sql .= 'nome_produto = :nome_produto, ';
		$sql .= 'valor_produto = :valor_produto, ';
		$sql .= 'estoque_minimo = :estoque_minimo ';
		$sql .= 'where cod_produto = :cod_produto';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':nome_produto', addslashes($produto['nome_produto']));
		$stm->bindValue(':valor_produto', addslashes($produto['valor_produto']));
		$stm->bindValue(':estoque_minimo', addslashes($produto['estoque_minimo']));
		$stm->bindValue(':cod_produto', addslashes($produto['cod_produto']));
		$stm->execute();
	}
	public function deleteProduto($codigoProduto){
		$sql = 'delete from produto where cod_produto = :cod_produto';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_produto', addslashes($codigoProduto));
		$stm->execute();
	}
	public function consultaProduto($codigoProduto,$codigoUsuario){
		$dados = array();
		$sql = 'select * from produto p inner join usuario on p.cod_usuario = :cod_usuario where cod_produto = :cod_produto';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_produto', addslashes($codigoProduto));
		$stm->bindValue(':cod_usuario', addslashes($codigoUsuario));
		$stm->execute();
		if ($stm->rowCount() > 0 ) {
			$dados = $stm->fetch(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function pesquisaProduto($nome_produto){
		$dados = array();
		$sql = 'select * from produto where nome_produto like "%'.$nome_produto.'%"';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function consultaEstoque($cod_produto){
		$dados = array();
		$sql = 'select * from produto p inner join estoque e on p.cod_produto = :cod_produto where p.cod_produto = e.cod_produto';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_produto', addslashes($cod_produto));
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function updateEstoqueProduto($cod_produto, $estoque){
		$sql = 'update produto set ';
		$sql .= 'estoque = :estoque ';
		$sql .= 'where cod_produto = :cod_produto';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':estoque', addslashes($estoque));
		$stm->bindValue(':cod_produto', addslashes($cod_produto));
		$stm->execute();
	}
}
?>