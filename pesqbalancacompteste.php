<?php

require('./dao/PesqBalancaCompDAO.class.php');

$pesqBalancaCompDAO = new PesqBalancaCompDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//if (isset($info)):
    
    $dados = '{"dados":[{"equip":2497,"os":1199742}]}';

    //$jsonObj = json_decode($info['dado']);
    $jsonObj = json_decode($dados); //Teste
    $dados = $jsonObj->dados;
    $retorno = array("dados" => $pesqBalancaCompDAO->pesqInfo($dados));
    $json_str = json_encode($retorno);
    echo $json_str;
    
//endif;
