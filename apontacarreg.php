<?php

require('./control/CarregCTR.class.php');

$carregCTR = new CarregCTR();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    echo $carregCTR->salvarDados($info, 'apontcarreg');
    
endif;
