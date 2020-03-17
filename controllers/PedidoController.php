<?php  
class PedidoController extends Controller{

	public function __construct(){

		parent::__construct();

		if (!isset($_SESSION['login'])){
			header('Location:'.BASE_URL.'/Login');
		}
	}

	public function index(){
		$dados = array();
		$PedidoModel = new Pedido();
		$dados['pedidos'] = $PedidoModel->getAllPedidos();
		$UsuarioModel = new CadastroUsuario();
		$dados['login'] = $UsuarioModel->getAllUsuario();
		$this->loadTemplate('pedidos', $dados);
	}
}
?>