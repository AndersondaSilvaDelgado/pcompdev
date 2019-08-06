<?php

require('./control/ProdutoCTR.class.php');

$produtoCTR = new ProdutoCTR();

echo $produtoCTR->dados();
