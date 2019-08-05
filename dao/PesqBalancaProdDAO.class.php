<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';
/**
 * Description of PesBalanca
 *
 * @author anderson
 */
class PesqBalancaProdDAO extends Conn {
    /** @var PDOStatement */

    /** @var PDO */
    private $Conn;

    public function pesqInfo($dado) {

        $result = null;
        
        while (empty($result)) {
        
            $select = " SELECT "
                        . " C.EQUIP_ID AS \"equip\" "
                        . " , L.CD AS \"leira\" "
                    . " FROM "
                        . " USINAS.REG_COMPOSTO C"
//                        . " INTERFACE.REG_COMPOSTO_TESTE "
                        . " , USINAS.LEIRA L"
                    . " WHERE "
                        . " C.EQUIP_ID = " . $dado ." "
                        . " AND "
                        . " C.FLAG_CARREG = 1 "
                        . " AND "
                        . " C.ORDCARREG_ID IS NOT NULL "
                        . " AND"
                        . " C.LEIRA_ID_DESCARGA = L.LEIRA_ID ";

            $this->Conn = parent::getConn();
            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();

        }
        
        return $result;
    }

    public function altInfo($dado) {


        $update = " UPDATE "
                        . " USINAS.REG_COMPOSTO "
//                        . " INTERFACE.REG_COMPOSTO_TESTE "
                    . " SET "
                        . " FLAG_CARREG = 2"
                    . " WHERE "
                        . " FLAG_CARREG = 1 AND"
                        . " EQUIP_ID = " . $dado;

        $this->Create = $this->Conn->prepare($update);
        $this->Create->execute();
    }

}
