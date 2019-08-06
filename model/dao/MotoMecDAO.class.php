<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of MotoMecDAO
 *
 * @author anderson
 */
class MotoMecDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " CODIGO AS \"codigoMotoMec\" "
                    . " , OPCOR AS \"opcorMotoMec\" "
                    . " , NOME AS \"descMotoMec\" "
                    . " , POSOP AS \"posicaoMotoMec\" "
                    . " , TIPO AS \"tipoMotoMec\" "
                    . " , FUNCAO AS \"funcaoMotoMec\" "
                    . " , CARGO AS \"cargoMotoMec\" "
                . " FROM "
                    . " ATIVIDADE_MOTOMEC "
                . " ORDER BY "
                    . " CODIGO "
                . " ASC";
  
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
    public function salvarDados($mm) {

        $sql = " INSERT INTO APONTA_MOTOMEC "
                . " VALUES (" . $mm->veic . " "
                . " , " . $mm->motorista . " "
                . " , " . $mm->opcor . " "
                . " , TO_DATE('" . $mm->dihi . "','DD/MM/YYYY HH24:MI') "
                . " , " . $mm->caux . ", 1, 1, 0, 0, 0)";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
            
    }
    
}
