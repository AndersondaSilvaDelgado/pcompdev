<?php

require('./dao/ApontaCarregDAO.class.php');

$apontaCarregDAO = new ApontaCarregDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //$dados = '{"dados":[{"dataApontCarreg":"11/05/2017 11:14","equipApontCarreg":2666,"idApontCarreg":1,"motoApontCarreg":41275,"prodApontCarreg":34326,"tipoApontCarreg":1}]}';

    //faz o parsing da string, criando o array "empregados"
    $jsonObj = json_decode($info['dado']);
    //$jsonObj = json_decode($dados);
    $dados = $jsonObj->dados;
    $apontaCarregDAO->salvarDados($dados);

endif;

echo 'GRAVOU-CARREG';