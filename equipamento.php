<?php

require('./dao/EquipamentoDAO.class.php');

$equipamentoDAO = new EquipamentoDAO();

//cria o array associativo
$dados = array("dados"=>$equipamentoDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;