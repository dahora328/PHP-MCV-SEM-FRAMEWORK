<?php
class CadastroUsuarioController extends Controller{
	public function index(){
		$dados = array();
		$UsuarioModel = new CadastroUsuario();
		$this->loadTemplate('home', $dados);
	}
	public function InsertUsuario(){
		$dados = array();
		if (count($_POST) > 0){
			$UsuarioModel = new CadastroUsuario();
			try {
				$dados = array('error' => '0', 'msgError' => '');
				$dados['nome_usuario'] = $_POST['nome'];
				$dados['login_usuario']  = $_POST['login'];
				$dados['senha_usuario'] = $_POST['senha'];
				try {
					$UsuarioModel->insertUsuario($dados);
					header('Location:'.BASE_URL.'/cliente');
				} catch (PDOException $ex) {
					$dados['error'] = '1';
					$dados['msg'] = 'O login digitado ja exite, tente outro login.';
				}
			} catch (PDOException $ex) {
				$dados = array('error' => '1', 'erros' => array('Erro ao cadastrar cliente '.$ex->getMessage()));
			}
		}
		$this->loadView('usuario-insert', $dados);
	}
	public function UpdateUsuario($cod_usuario){
		$dados = array('error' => '0', 'msgError' => '');
		$UsuarioModel = new CadastroUsuario();
		if (!empty($_POST['nome_usuario'])) {
			try {
				$usuario = $UsuarioModel->getByCodUsuario($cod_usuario);
				$usuario['nome_usuario'] = $_POST['nome_usuario'];
				$usuario['login_usuario'] = $_POST['login'];

				if (!empty($_POST['senha']) || !empty($_POST['confirma_senha'])){
					$usuario['senha_usuario'] = $_POST['senha'];
					$usuario['confirma_senha'] = $_POST['confirma_senha'];
					if ($usuario['senha_usuario'] != $usuario['confirma_senha']){
						$dados['error'] = '1';
						$dados['msg'] = 'Você digitou a senha errada em um dos campos.';
						$this->loadTemplate('usuario-edit', $dados);
						exit;					
					}
				}else{
					$usuario['senha_usuario'] = '';
				}
				$_SESSION['login'] = $usuario;

				$UsuarioModel->updateUsuario($usuario);
				header('Location:'.BASE_URL.'/home');
			} catch (PDOException $ex) {
				$dados['error'] = '1';
				$dados['msgError'] = 'Erro ao atualizar usuário ['.$ex->getMessage().']';
				$this->loadTemplate('usuario-edit', $dados);
			}
		}
		$dados['login'] = $UsuarioModel->getByCodUsuario($cod_usuario);
		$this->loadTemplate('usuario-edit', $dados);
	}
	public function DeleteUsuario($cod_usuario){
		$dados = array('error' => '0', 'msgError' => '');
		try {
			$UsuarioModel = new CadastroUsuario();
			$UsuarioModel->deleteUsuario($cod_usuario);
			header('Location:'.BASE_URL.'/login');
		} catch (PDOException $ex) {
	    	$dados['error'] = '1';
	    	$dados['msgError'] = 'Erro ao excluir produto '.$ex->getMessage();			
			$this->loadTemplate('home', $dados);
		}
		$this->loadTemplate('home', $dados);
	}
}
?>