<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/LeiraDAO.class.php');
require_once('./model/dao/CarregDAO.class.php');
/**
 * Description of LeiraCTR
 *
 * @author anderson
 */
class LeiraCTR {
    
    public function pesqLeiraProd($info) {

        $leiraDAO = new LeiraDAO();
        $carregDAO = new CarregDAO();

        $equip = $info['dado'];

        $retorno = array("dados" => $leiraDAO->retLeiraProd($equip));
        $carregDAO->updCarregProd($equip);
        $ret = json_encode($retorno);
        return $ret;
        
    }
    
    public function pesqLeiraComp($info) {

        $leiraDAO = new LeiraDAO();

        $jsonObj = json_decode($info['dado']);
        $dados = $jsonObj->dados;

        foreach ($dados as $d) {
            $equip = $d->equip;
            $os = $d->os;
        }

        $retorno = array("dados" => $leiraDAO->retLeiraComp($equip, $os));
        $ret = json_encode($retorno);
        return $ret;
        
    }
    
}
