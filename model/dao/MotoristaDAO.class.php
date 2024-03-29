<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of MotoristaDAO
 *
 * @author anderson
 */
class MotoristaDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
			    . " ID_FUNC AS \"idMotorista\" "
                    . " , MATRICULA AS \"matricMotorista\" "
                    . " , NOME AS \"nomeMotorista\" "
                . " FROM "
                    . " V_FUNCIONARIO_COMPOSTAGEM "
                . " WHERE "
                    . " CODIGO_MACRO_FUNCAO = 1 "
                . " ORDER BY "
                    . " MATRICULA "
                . " ASC";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
