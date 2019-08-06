<?php

require('./control/LeiraCTR.class.php');

$leiraCTR = new LeiraCTR();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    echo $retorno = $leiraCTR->pesqLeiraProd($info);

endif;