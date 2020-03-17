<?php 
class CadastroUsuario{
	public function getAllUsuario(){
		$dados = array();
		$sql = 'select * from usuario order by cod_usuario asc';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function getByCodUsuario($cod_usuario){
		$dados = array();
		$sql = 'select * from usuario where cod_usuario = :cod_usuario';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_usuario', addslashes($cod_usuario));
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$dados = $stm->fetch(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
	public function verificaLogin($login, $senha){
		$dados = array();
		$sql =  'select * from usuario ';
		$sql .= 'where login_usuario = :login and senha_usuario = :senha';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':login', addslashes($login));
		$stm->bindValue(':senha', md5($senha));
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$dados = $stm->fetch(PDO::FETCH_ASSOC);		
		}
		return $dados;
	}
	public function insertUsuario($usuario=array()){
		$sql = 'insert into usuario set ';
		$sql .= 'nome_usuario  = :nome_usuario, ';
		$sql .= 'login_usuario = :login_usuario, ';
		$sql .= 'senha_usuario = :senha_usuario';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':nome_usuario', addslashes($usuario['nome_usuario']));
		$stm->bindValue(':login_usuario', addslashes($usuario['login_usuario']));
		$stm->bindValue(':senha_usuario', md5($usuario['senha_usuario']));
		$stm->execute();
	}
	public function updateUsuario($usuario=array()){
		$sql = 'update usuario set ';
		$sql .= 'nome_usuario = :nome_usuario, ';
		$sql .= 'login_usuario = :login_usuario ';

		if (!empty($usuario['senha_usuario'])){
			$sql .= ',senha_usuario = :senha_usuario ';
		}
		
		$sql .= 'where cod_usuario = :cod_usuario ';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':nome_usuario', addslashes($usuario['nome_usuario']));
		$stm->bindValue(':login_usuario', addslashes($usuario['login_usuario']));

		if (!empty($usuario['senha_usuario'])){
			$stm->bindValue(':senha_usuario', md5($usuario['senha_usuario']));
		}
		$stm->bindValue(':cod_usuario', addslashes($usuario['cod_usuario']));
		$stm->execute();
	}
	public function deleteUsuario($cod_usuario){
		$sql = 'update usuario set ';
		$sql .= 'ativo = 1 ';
		$sql .= 'where cod_usuario = :cod_usuario';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->bindValue(':cod_usuario', addslashes($cod_usuario));
		$stm->execute();
	}
	public function retornaUltimosCad(){
		$dados = array();
		$sql = 'select * from usuario order by cod_usuario desc LIMIT 5';
		$stm = Conexao::getInstance()->prepare($sql);
		$stm->execute();
		if ($stm->rowCount() > 0){
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		return $dados;
	}
}
?>