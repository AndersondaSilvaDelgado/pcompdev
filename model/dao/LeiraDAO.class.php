<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of LeiraDAO
 *
 * @author anderson
 */
class LeiraDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;
    
    public function retLeiraProd($dado) {

        $result = null;
        
        while(empty($result)) {
        
            $select = " SELECT "
                        . " C.EQUIP_ID AS \"equip\" "
                        . " , L.CD AS \"leira\" "
                    . " FROM "
                        . " USINAS.REG_COMPOSTO C"
                        . " , USINAS.LEIRA L"
                    . " WHERE "
                        . " C.EQUIP_ID = " . $dado
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

    public function retLeiraComp($equip, $os) {

        $idLeira = 0;
        $cdLeira = null;

        while (empty($cdLeira)) {

            $sql = "CALL pk_composto_auto.pkb_ret_leira(?, ?, ?, ?)";

            $this->Conn = parent::getConn();
            $stmt = $this->Conn->prepare($sql);
            $stmt->bindParam(1, $equip, PDO::PARAM_INT, 32);
            $stmt->bindParam(2, $os, PDO::PARAM_INT, 32);
            $stmt->bindParam(3, $idLeira, PDO::PARAM_INT, 32);
            $stmt->bindParam(4, $cdLeira, PDO::PARAM_STR, 4000);

            $stmt->execute();

            $dado = array("equip" => $equip, "os" => $os
                , "idLeira" => $idLeira, "cdLeira" => $cdLeira);
        }

        return array($dado);
    }
    
}
