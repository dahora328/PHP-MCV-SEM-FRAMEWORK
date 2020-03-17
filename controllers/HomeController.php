<?php

class HomeController extends Controller{

	public function __construct(){

		parent::__construct();

		if (!isset($_SESSION['login'])){
			header('Location:'.BASE_URL.'/Login');
		}
	}
	
	public function index(){
		$dados = array();
		$PedidoModel = new Pedido();
		$dados['pedido'] = $PedidoModel->maisVendido();
		$ClienteModel = new Cliente();
		$dados['cliente'] = $ClienteModel->retornaFinalizado();
		$UsuarioModel = new CadastroUsuario();
		$dados['login'] = $UsuarioModel->getAllUsuario();
		$dados['usuario'] = $UsuarioModel->retornaUltimosCad();
		$this->loadTemplate('home', $dados);
	}
		
}