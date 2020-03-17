<?php  
class EntradaEstoque extends Controller{
	public function __construct(){

		parent::__construct();

		if (!isset($_SESSION['login'])){
			header('Location:'.BASE_URL.'/Login');
		}
	}
	public function index(){
		$dados = array();
		$EntradaModel = new EntradaEstoque();
		$this->loadTemplate('produto-consultaEstoque', $dados);
	}
}
?>