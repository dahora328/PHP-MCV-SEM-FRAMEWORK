<?php

class Conexao{

	public static $conexao = NULL;

	private function __construct(){
		//
	}
	
	public static function getInstance(){

		if (self::$conexao === NULL){        

			global $config;

	    	try{
				self::$conexao = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'],
                    $config['user_name'],$config['password'],array(PDO::ATTR_PERSISTENT => true,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				self::$conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
								
	    	}catch(PDOException $e){
	    		die($e->getMessage());
	    	}
		
		}

		return self::$conexao;
				
	}
		
}