<?php

require('./dao/ProdutoDAO.class.php');

$produtoDAO = new ProdutoDAO();

//cria o array associativo
$dados = array("dados"=>$produtoDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
