<?php

class Controller{

	protected $usuario;
	protected $empresaTrabalho;

	public function __construct(){      

    }
    protected function verificaLogin(){
        if (empty($_SESSION['login'])){
            return false;
        }
        return true;
    }

    public function loadView($viewName, $viewData = array()){
		extract($viewData);
		include 'views/'.$viewName.'.php';	
	}

    public function loadReport($viewName, $viewData = array()){
        extract($viewData);
        include 'report/'.$viewName.'.php';
    }

    public function loadTemplate($viewName, $viewData = array()){	    	
    	extract($viewData);
    	include 'views/template.php';
    }

    public function loadViewInTemplate($viewName, $viewData = array()) {    	
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadLibrary($lib) {				
		if (file_exists("bibliotecas/".$lib.".php")){			
			include "bibliotecas/".$lib.".php";
		}		
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

    /**
     * @return mixed
     */
    public function getEmpresasTrabalho()
    {
        return $this->empresasTrabalho;
    }

    protected function verificaProprietario(){
        $token = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
        if ($_SESSION['proprietario'] != $token){
            header("Location:".BASE_URL);
            exit;
        }
    }

}