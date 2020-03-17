<?php  
class ClienteController extends Controller{

	public function __construct(){
		parent::__construct();

		if (!isset($_SESSION['login'])){
			header('Location:'.BASE_URL.'/Login');
		}
	}

	public function index(){
		$dados = array();
		$ClienteModel = new Cliente();
		$dados['login'] = $_SESSION['login']['cod_usuario'];
		$dados['cliente'] = $ClienteModel->getAllClientes($dados['login']);
		$this->loadTemplate('cliente', $dados);
	}
	public function Insert(){
		$dados = array();
		if (count($_POST) > 0) {
			$ClienteModel = new Cliente();
			try {
				$dados = array('error' => '0', 'msgError' => '');
				$dados['nome_cliente'] = $_POST['nome_cliente'];
				$dados['data'] = $_POST['data'];
				$dados['cod_usuario'] = $_POST['cod_usuario'];
				try {
					$ClienteModel->insertCliente($dados);
					header('Location:'.BASE_URL.'/cliente');
				} catch (PDOException $ex) {
					$dados['error'] = '1';				
					$dados['msgError'] = 'Erro ao cadastrar cliente ['.$ex->getMessage().']';
				}
			} catch (PDOException $ex) {
				$dados = array('error' => '1', 'erros' => array('Erro ao cadastrar cliente '.$ex->getMessage()));
			}
		}
		$UsuarioModel = new CadastroUsuario();
		$dados['login'] = $UsuarioModel->getAllUsuario();
		$this->loadTemplate('cliente-insert', $dados);
	}
	public function Update($codigo){
		$dados = array('error' => '0', 'msgError' => '');
		$ClienteModel = new Cliente();
		if (!empty($_POST['nome_cliente'])) {
			try {
				$cliente = $ClienteModel->getByCodigo($codigo);
				$cliente['nome_cliente'] = $_POST['nome_cliente'];
				$cliente['data'] = $_POST['data'];
				$ClienteModel->updateCliente($cliente);
				header('Location:'.BASE_URL.'/cliente');
			} catch (PDOException $ex) {
				$dados['error'] = '1';
		    	$dados['msgError'] = 'Erro ao atualizar cliente '.$ex->getMessage();			
				$this->loadTemplate('cliente', $dados);
			}
		}
		$dados['cliente'] = $ClienteModel->getByCodigo($codigo);
		$this->loadTemplate('cliente-edit', $dados);	
	}
	public function Delete($cod_cliente){
		$dados = array('error' => '0', 'msgError' => '');
		try {
			$ClienteModel = new Cliente();
			$ClienteModel->deleteCliente($cod_cliente);
			header('Location:'.BASE_URL.'/cliente');
		} catch (PDOException $ex) {
			$dados['cliente'] = $ClienteModel->getAllClientes();
	    	$dados['error'] = '1';
	    	$dados['msgError'] = 'Erro ao excluir cliente '.$ex->getMessage();			
			$this->loadTemplate('cliente', $dados);
	    }
	    $this->loadTemplate('cliente', $dados);
	}
	public function ConsultaPedido($cod_cliente){
		$dados = array();
		$ClienteModel = new Cliente();

		if (count($_POST) > 0) {
			$PedidoModel = new Pedido();
			$ProdutoModel = new Produto();
			$EstoqueModel = new EntradaEstoque();
			try {
				$dados = array('error' => '0', 'msgError' => '');
				$dados['cod_produto'] = $_POST['cod_produto'];
				$dados['nome_produto'] = $_POST['nome_produto'];
				$dados['quantidade'] = $_POST['quantidade'];
				$dados['valor_produto'] = $_POST['valor_produto'];
				$dados['total_item'] = $_POST['total_item'];
				$dados['quatidade_entrada'] = $_POST['estoque'];
				$dados['cod_cliente'] = $_POST['cod_cliente'];
				$dados['cod_usuario'] = $_POST['cod_usuario'];
				try {
					$PedidoModel->insertPedido($dados);
					$soma = $EstoqueModel->somaEstoque($dados['cod_produto']);
					$dados['estoque'] = $_POST['resultado'];
					$ProdutoModel->updateEstoqueProduto($dados['cod_produto'], $dados['estoque']);
					$total_pedido = $this->CalcularSoma($dados['cod_cliente']);
					$ClienteModel->updateTotalPedido($cod_cliente, $total_pedido);
				} catch (PDOException $ex) {
					$dados['error'] = '1';
					$dados['msgError'] = 'Erro ao cadastrar pedido ['.$ex->getMessage().']';
				}
			} catch (PDOException $ex) {
				$dados = array('error' => '1', 'erros' => array('Erro ao cadastrar pedido '.$ex->getMessage()));
			}
		}
		try {
			$dados['pedidos'] = $ClienteModel->consultaPedido($cod_cliente);
			$dados['cliente'] = $ClienteModel->getByCodigo($cod_cliente);
		} catch (PDOException $ex) {
			$dados['pedidos'] = $ClienteModel->getAllClientes();
	    	$dados['error'] = '1';
	    	$dados['msgError'] = 'Erro ao consultar '.$ex->getMessage();
			$this->loadTemplate('pedidos', $dados);
		}
		$dados['cod_cliente'] = $cod_cliente;
		$this->loadTemplate('cliente-consultaPedido', $dados);
	}
	public function UpdatePedido($cod_pedido){
		$dados = array('error' => '0', 'msgError' => '');
		$ClienteModel = new Cliente();
		$ProdutoModel = new Produto();
		$PedidoModel = new Pedido();
		$EstoqueModel = new EntradaEstoque();
		if (!empty($_POST['nome_produto'])) {
			try {
				$pedido = $PedidoModel->getByIdPedido($cod_pedido);
				$produto = $ProdutoModel->getByIdProduto($pedido['cod_produto']);
				$pedido['cod_produto'] = $_POST['cod_produto'];
				$pedido['nome_produto'] = $_POST['nome_produto'];
				$pedido['quantidade'] = $_POST['quantidade'];
				$pedido['valor_produto'] = $_POST['valor_produto'];
				$pedido['total_item'] = $_POST['total_item'];
				echo $produto['estoque']; exit;
				/*

				estoque = 6000
				quantidade = 500

				quantidade = 200
				estoque_atual = 6300
				resultado = quantidade + estoque_atual

				*/

				// $resultado = $produto['estoque'] - $pedido['quantidade'];
				// echo $resultado; exit;
				// $ProdutoModel->updateEstoqueProduto($pedido['cod_produto'], $resultado);

				$total_pedido = $this->CalcularSoma($pedido['cod_cliente']);
				$ClienteModel->updateTotalPedido($pedido['cod_cliente'], $total_pedido);
				$PedidoModel->updatePedido($pedido);
				header('Location:'.BASE_URL.'/cliente/ConsultaPedido/' .$pedido['cod_cliente']);
			} catch (PDOException $ex) {
				$dados['error'] = '1';
		    	$dados['msgError'] = 'Erro ao atualizar cliente '.$ex->getMessage();			
				$this->loadTemplate('cliente-consultaPedido', $dados);
			}
		}
		$dados['pedidos'] = $PedidoModel->getByIdPedido($cod_pedido);
		$this->loadTemplate('cliente-editPedido', $dados);
	}
	public function DeletePedido($cod_pedido){
		$dados = array('error' => '0', 'msgError' => '');
		try {
			$PedidoModel = new Pedido();
			$ProdutoModel = new Produto();
			$ClienteModel = new Cliente();
			$EstoqueModel = new EntradaEstoque();
			$pedido = $PedidoModel->getByIdPedido($cod_pedido);
			$produto = $ProdutoModel->getByIdProduto($pedido['cod_produto']);
			$total_pedido = $this->CalcularSoma($pedido['cod_cliente']);
			$ClienteModel->updateTotalPedido($pedido['cod_cliente'], $total_pedido);
			/*
			estoque =  6500
			estoque - quantidade
			quantidade = 500
			estoque_ atual = 6000
			devolucao = 500
			devolucao + estoque_atual
			estoque_atual = 6500
			estoque = estoque_atual
			*/
			$estoque = $EstoqueModel->SomaEstoque($pedido['cod_produto']);
			$resultado = $produto['estoque'] + $pedido['quantidade'];
			// echo $resultado; exit;
			$ProdutoModel->updateEstoqueProduto($pedido['cod_produto'], $resultado);
			$PedidoModel->deletePedido($cod_pedido);
			header('Location:'.BASE_URL.'/cliente/ConsultaPedido/'.$pedido['cod_cliente']);
		} catch (PDOException $ex) {
			$dados['error'] = '1';
	    	$dados['msgError'] = 'Erro ao excluir cliente '.$ex->getMessage();			
			$this->loadTemplate('cliente-consultaPedido', $dados);
		}
		$this->loadTemplate('cliente-consultaPedido', $dados);
	}
	private function CalcularSoma($cod_cliente){
		
		$ClienteModel = new Cliente();
		$PedidoModel = new Pedido();
		$pedido = $PedidoModel->somaTotalItem($cod_cliente);
		return $pedido;
	}
	public function FinalizarPedido($cod_cliente){
		$ClienteModel = new Cliente();
		$ClienteModel->finalizarPedido($cod_cliente);
		header('Location:'.BASE_URL.'/cliente');
	}
	public function GetCliente($cod_cliente){
		$dados = array('error' => '0', 'msgError' => '');
		$ClienteModel = new Cliente();
		$dados['pedidos'] = $ClienteModel->getByCodigo($cod_cliente);
		$UsuarioModel = new CadastroUsuario();
		$dados['login'] = $UsuarioModel->getAllUsuario();
		$this->loadTemplate('cliente-consultaPedido', $dados);
	}
	public function PesquisarNome(){
		$dados = array('error' => '0', 'msgError' => '');
		$ClienteModel = new Cliente();
		if (!empty($_POST) > 0) {
			try {
				$dados = array();
				$nome_cliente = $_POST['nome_cliente'];
				$dados['cliente'] = $ClienteModel->pesquisarNome($nome_cliente);
				if (empty($dados['cliente'])) {
					$dados['error'] = '1';
	    			$dados['msg'] = 'Cliente não encontrado.';
				}
				$this->loadTemplate('cliente-pesquisaNome', $dados);
				exit;
			} catch (PDOException $ex) {
				$dados['error'] = '1';
	    		$dados['msgError'] = 'Não exite cliente cadastrado com esse nome '.$ex->getMessage();
	    		$this->loadTemplate('cliente-pesquisaNome', $dados);
			}
		}
		$dados['cliente'] = array();
		$this->loadTemplate('cliente-pesquisaNome', $dados);
	}
	public function PesquisaPedido(){
		$dados = array('error' => '0', 'msgError' => '');
		$PedidoModel = new Pedido();
		if (!empty($_POST) > 0) {
			try {
				$dados = array();
				$cod_usuario = $_POST['cod_usuario'];
				$dados['pedido'] = $PedidoModel->pesquisaPedido($cod_usuario);
				if (empty($dados['pedido'])) {
					$dados['error'] = '1';
	    			$dados['msg'] = 'Pedido não encontrado.';
				}
				$this->loadTemplate('cliente-pesquisaPedido', $dados);
				exit;
			} catch (PDOException $ex) {
				$dados['error'] = '1';
	    		$dados['msg'] = 'Não exite cliente cadastrado com esse nome '.$ex->getMessage();
	    		$this->loadTemplate('cliente-pesquisaNome', $dados);
			}
		}
		$dados['pedido'] = array();
		$this->loadTemplate('cliente-pesquisaPedido', $dados);
	}
}
?>