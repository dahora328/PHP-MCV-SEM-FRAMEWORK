<?php

include_once 'config.php';

date_default_timezone_set('America/Sao_Paulo');
session_start();

spl_autoload_register(function($className){
	
	if (strpos($className,'Controller') > -1){
		if (file_exists('controllers/'.$className.'.php')){
		   require_once 'controllers/'.$className.'.php';
		}
	}elseif(file_exists('core/'.$className.'.php')){		
		require_once 'core/'.$className.'.php';	
	}elseif (file_exists('models/'.$className.'.php')){		
		require_once 'models/'.$className.'.php';
	}elseif (file_exists('views/'.$className.'.php')){
		require_once 'views/'.$className.'.php';
	}

});

$core = new core();
$core->run();