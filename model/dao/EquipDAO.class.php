<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of EquipamentoDAO
 *
 * @author anderson
 */
class EquipDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados($equip) {

        $select = " SELECT "
                . " E.EQUIP_ID AS \"idEquip\" "
                . " , E.NRO_EQUIP AS \"nroEquip\" "
                . " , E.TIPO_EQUIP AS \"tipoEquip\" "
                . " , E.CLASSOPER_CD AS \"codClasseEquip\" "
                . " , CARACTER(E.CLASSOPER_DESCR) AS \"descrClasseEquip\" "
                . " , E.TPTUREQUIP_CD AS \"codTurno\" "
                . " , NVL(C.PLMANPREV_ID, 0) AS \"idChecklist\" "
                . " FROM "
                . " USINAS.V_EQUIP E "
                . " , USINAS.V_EQUIP_PLANO_CHECK C "
                . " WHERE  "
                . " E.NRO_EQUIP = " . $equip
                . " AND E.NRO_EQUIP = C.EQUIP_NRO(+) ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
    public function dadosVersao1() {

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
