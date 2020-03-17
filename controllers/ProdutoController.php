<?php  
	class ProdutoController extends Controller{

		public function __construct(){

			parent::__construct();

			if (!isset($_SESSION['login'])){
				header('Location:'.BASE_URL.'/Login');
			}

		}

		public function index(){
			$dados = array();
			$ProdutoModel = new Produto();
			$dados['login'] = $_SESSION['login']['cod_usuario'];
			$dados['produto'] = $ProdutoModel->getAllProdutos($dados['login']);
			$UsuarioModel = new CadastroUsuario();
			$dados['login'] = $UsuarioModel->getAllUsuario();
			$this->loadTemplate('produto', $dados);
		}
		public function InsertProduto(){
			$dados = array();
			if (count($_POST) > 0) {
				$ProdutoModel = new Produto();
				try {
					$dados = array('error' => '0', 'msgError' => '');
					$dados['nome_produto']  = $_POST['nome_produto'];
					$dados['valor_produto'] = $_POST['valor_produto'];
					$dados['estoque_minimo'] = $_POST['estoque_minimo'];
					$dados['cod_usuario'] = $_POST['cod_usuario'];
					try {
						$ProdutoModel->insertProduto($dados);
						header('Location:'.BASE_URL.'/produto');
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
			$this->loadTemplate('produto-insert', $dados);
		}
		public function UpdateProduto($codigoProduto){
			$dados = array('error' => '0', 'msgError' => '');
			$ProdutoModel = new Produto();
			if (!empty($_POST['nome_produto'])) {
				try {
					$produto = $ProdutoModel->getByIdProduto($codigoProduto);
					$produto['nome_produto'] = $_POST['nome_produto'];
					$produto['valor_produto'] = $_POST['valor_produto'];
					$produto['estoque_minimo'] = $_POST['estoque_minimo'];
					$ProdutoModel->updateProduto($produto);
					header('Location:'.BASE_URL.'/produto');
				} catch (PDOException $ex) {
					$dados['error'] = '1';
			    	$dados['msgError'] = 'Erro ao atualizar cliente '.$ex->getMessage();		
					$this->loadTemplate('produto', $dados);
				}	
			}
			$UsuarioModel = new CadastroUsuario();
			$dados['login'] = $UsuarioModel->getAllUsuario();
			$dados['produto'] = $ProdutoModel->getByIdProduto($codigoProduto);
			$this->loadTemplate('produto-edit', $dados);
		}
		public function DeleteProduto($codigoProduto){
			$dados = array('error' => '0', 'msgError' => '');
			try {
				$ProdutoModel = new Produto();
				$ProdutoModel->deleteProduto($codigoProduto);
				header('Location:'.BASE_URL.'/produto');
			} catch (PDOException $ex) {
				$dados['produto'] = $ProdutoModel->getAllProdutos();
		    	$dados['error'] = '1';
		    	$dados['msgError'] = 'Erro ao excluir produto '.$ex->getMessage();			
				$this->loadTemplate('produto', $dados);
			}
			$UsuarioModel = new CadastroUsuario();
			$dados['login'] = $UsuarioModel->getAllUsuario();
			$this->loadTemplate('produto', $dados);
		}
		public function ConsultaProduto(){

			$dados = array('error' => '0', 'msgError' => '');

			$idProduto = '';

			if (!empty($_POST['idProduto'])){
				$idProduto = $_POST['idProduto'];
			}
			$ProdutoModel = new Produto();
			try {
				$dados['produtos'] = $ProdutoModel->consultaProduto($idProduto,$_SESSION['login']['cod_usuario']);
			} catch (PDOException $ex) {
		    	$dados['error'] = '1';
		    	$dados['msgError'] = 'Erro ao consultar '.$ex->getMessage();			
				$this->loadTemplate('pedidos', $dados);
			}
			print_r(json_encode($dados));
		}
		public function PesquisaProduto(){
			$dados = array('error' => '0', 'msgError' => '');
			$ProdutoModel = new Produto();
			if (!empty($_POST) > 0) {
				try {
					$dados = array();
					$nome_produto = $_POST['nome_produto'];
					$dados['produto'] = $ProdutoModel->pesquisaProduto($nome_produto);
					if (empty($dados['produto'])) {
						$dados['error'] = '1';
		    			$dados['msg'] = 'Produto não encontrado.';
					}
					$this->loadTemplate('produto-pesquisaProduto', $dados);
					exit;
				} catch (PDOException $ex) {
					$dados['error'] = '1';
		    		$dados['msgError'] = 'Não exite cliente cadastrado com esse nome '.$ex->getMessage();
		    		$this->loadTemplate('produto-pesquisaProduto', $dados);
				}
			}
			$dados['produto'] = array();
			$this->loadTemplate('produto-pesquisaProduto', $dados);
		}
		public function ConsultaEstoque($cod_produto){
			$dados = array();
			$ProdutoModel = new Produto();
			if (count($_POST) > 0) {
				$EstoqueModel = new EntradaEstoque();
				try {
					$dados = array();
					$dados['quantidade_entrada'] = $_POST['quantidade_entrada'];
					$dados['data_entrada'] = $_POST['data_entrada'];
					$dados['cod_produto'] = $_POST['cod_produto'];
					try {
						$estoque = $EstoqueModel->insertEstoque($dados);
						$EstoqueModel->somaEstoque($dados['cod_produto']);
						$estoque = $this->SomaEstoque($dados['cod_produto']);
						$ProdutoModel->updateEstoqueProduto($dados['cod_produto'], $estoque);
					} catch (PDOException $ex) {
						$dados['error'] = '1';
						$dados['msg'] = 'Erro ao cadastrar pedido ['.$ex->getMessage().']';
					}
				} catch (PDOException $ex) {
					$dados = array('error' => '1', 'erros' => array('Erro ao cadastrar pedido '.$ex->getMessage()));
				}
			}
			try {
				$dados['estoque'] = $ProdutoModel->consultaEstoque($cod_produto);
				$dados['produto'] = $ProdutoModel->getByIdProduto($cod_produto);
			} catch (PDOException $ex) {
				$dados['error'] = '1';
				$dados['msgError'] = 'Erro ao cadastrar pedido ['.$ex->getMessage().']';
			}
			$dados['cod_produto'] = $cod_produto;
			$this->loadTemplate('produto-consultaEstoque', $dados);
		}
		public function UpdateEstoque($cod_estoque){
			$dados = array('erro' => '0', 'msgError' => '');
			$EstoqueModel = new EntradaEstoque();
			$ProdutoModel = new Produto();
			if (!empty($_POST['quantidade_entrada'])) {
				try {
					$estoque = $EstoqueModel->getByIdEstoque($cod_estoque);
					$estoque['quantidade_entrada'] = $_POST['quantidade_entrada'];
					$estoque['data_entrada'] = $_POST['data_entrada'];
					$EstoqueModel->updateEstoque($estoque);
					header('Location:'.BASE_URL.'/produto/ConsultaEstoque/' .$estoque['cod_produto']);
					
				} catch (PDOException $ex) {
					$dados['error'] = '1';
					$dados['msgError'] = 'Erro ao cadastrar pedido ['.$ex->getMessage().']';
					$this->loadTemplate('produto-editEstoque', $dados);
					exit;
				}
			}
			$dados['estoque'] = $EstoqueModel->getByIdEstoque($cod_estoque);
			$this->loadTemplate('produto-editEstoque', $dados);
		}
		public function DeleteEstoque($cod_estoque){
			$dados = array();
			try {			
				$EstoqueModel = new EntradaEstoque();
				$ProdutoModel = new Produto();
				$estoque = $EstoqueModel->getByIdEstoque($cod_estoque);
				$EstoqueModel->deleteEstoque($cod_estoque);
				$soma = $this->SomaEstoque($estoque['cod_produto']);
				$ProdutoModel->updateEstoqueProduto($estoque['cod_produto'], $soma);
				header('Location:'.BASE_URL.'/produto/ConsultaEstoque/' .$estoque['cod_produto']);
			} catch (PDOException $ex) {
				$dados['error'] = '1';
		    	$dados['msg'] = 'Erro ao excluir estoque. '.$ex->getMessage();			
				$this->loadTemplate('produto-consultaEstoque', $dados);
			}
			$this->loadTemplate('produto-consultaEstoque', $dados);
		}
		public function SomaEstoque($cod_produto){
			$EstoqueModel = new EntradaEstoque();
			$estoque = $EstoqueModel->somaEstoque($cod_produto);
			return $estoque;
		}
	}
?>