<?php

    define("STATUS_PROJETO",'DESENVOLVIMENTO');
    define("BASE_URL",'http://www.pedidomvc.pc');
    define("VERSAO_SISTEMA", 'V 2.00');
    define("QTD_REG_POR_PAGINA", 10);
    //define("BASE_URL",'http://35.199.110.213');
    //define("BASE_URL",'http://www.tiautomacao.com.br/posto');
    global $config;

    $config = array();

    if (STATUS_PROJETO == 'DESENVOLVIMENTO'){
        $config['dbname']    = 'vendas';
        $config['host']      = 'localhost';
        $config['user_name'] = 'root';
        $config['password']  = '';
    }else{
        $config['dbname']    = 'vendas';
        $config['host']      = 'localhost';
        $config['user_name'] = 'root';
        $config['password']  = '';
    }

