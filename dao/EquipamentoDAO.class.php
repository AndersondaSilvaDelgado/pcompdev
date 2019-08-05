<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';
/**
 * Description of EquipamentoDAO
 *
 * @author anderson
 */
class EquipamentoDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " ID_EQUIP AS \"idEquipamento\" "
                    . " , NRO AS \"nroEquipamento\" "
                    . " , TIPO_CLASSE AS \"tipoEquipamento\" "
                    . " , CLASSIF_EQUIP AS \"classifEquipamento\" "
                . " FROM "
                    . " V_EQUIPAMENTO_COMPOSTAGEM "
                . " WHERE "
                    . " DATA_DESATIVACAO IS NULL "
                . " ORDER BY "
                    . " NRO "
                . " ASC";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
