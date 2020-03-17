<?php
class LoginController extends Controller{

	public function index(){
      	$dados = array();

      	if (count($_POST) > 0){
                  $login = $_POST['login'];
                  $senha = $_POST['senha'];
                  $usuario = new CadastroUsuario();
                  $user = $usuario->verificaLogin($login, $senha);
                  if (count($user) > 0) {
                  	$_SESSION['login'] = $user;
                  	if ($_SESSION['login']['ativo'] == 0) {
                  		header('Location: ' .BASE_URL.'/home');
                  	}else{
                  		$dados['error'] =  '1';
            			$dados['msg'] = 'Esta conta já foi excluída.';
            			unset($_SESSION['login']);
                  	}
                  	
                  }else{
            		$dados['error'] = '1';
            		$dados['msg'] = 'Email ou senha inválidos';
                  }
            }
      	$this->loadView('login',$dados);
      }

	public function LogOut(){
		unset($_SESSION['login']);
		header('Location:'.BASE_URL);
	}
}