<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');

/**
 * Description of CarregDAO
 *
 * @author anderson
 */
class CarregDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;
    
    public function cancelCarregProd($carreg) {

        $update = " UPDATE "
                . " USINAS.REG_COMPOSTO "
                . " SET "
                . " FLAG_CARREG = 2, CANCEL = 1 "
                . " WHERE "
                . " FLAG_CARREG = 1 AND "
                . " EQUIP_ID = " . $carreg->equipApontCarreg;

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($update);
        $this->Create->execute();
    }

    public function verifCarregProd($carreg) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " USINAS.REG_COMPOSTO "
                . " WHERE "
                . " DT = TO_DATE('" . $carreg->dataApontCarreg . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " EQUIP_ID = " . $carreg->equipApontCarreg;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function insCarregProd($carreg) {

        $insert = "INSERT INTO USINAS.REG_COMPOSTO ("
                . " TIPO "
                . " , DT "
                . " , EQUIP_ID "
                . " , FUNC_ID "
                . " , PROD_ID "
                . " , FLAG_CARREG "
                . " ) "
                . " VALUES ("
                . " 0 "
                . " , TO_DATE('" . $carreg->dataApontCarreg . "','DD/MM/YYYY HH24:MI') "
                . " , " . $carreg->equipApontCarreg . " "
                . " , " . $carreg->motoApontCarreg . " "
                . " , " . $carreg->prodApontCarreg . " "
                . " , 1 "
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($insert);
        $this->Create->execute();
    }

    public function cancelCarregComp($carreg) {

        $update = " UPDATE "
                . " USINAS.REG_COMPOSTO "
                . " SET "
                . " CANCEL = 1 "
                . " WHERE "
                . " EQUIP_ID = " . $carreg->equipApontCarreg;

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($update);
        $this->Create->execute();
    }

    public function verifCarregComp($carreg) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " USINAS.REG_COMPOSTO "
                . " WHERE "
                . " DT = TO_DATE('" . $carreg->dataApontCarreg . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " EQUIP_ID = " . $carreg->equipApontCarreg;

        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function insCarregComp($carreg) {

        $select = " SELECT "
                . " OA.OSAGRICOLA_ID AS OSAGRICOLA "
                . " FROM "
                . " OS_AGRICOLA OA "
                . " , OS OS "
                . " WHERE "
                . " OS.OS_ID = OA.OS_ID "
                . " AND OS.OS_ID = " . $carreg->osApontCarreg;

        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $os = $item['OSAGRICOLA'];
        }

        $insert = "INSERT INTO USINAS.REG_COMPOSTO ("
                . " TIPO "
                . " , DT "
                . " , EQUIP_ID "
                . " , FUNC_ID "
                . " , LEIRA_ID "
                . " , OSAGRICOLA_ID "
                . " , FLAG_CARREG "
                . " , PROD_ID "
                . " ) "
                . " VALUES ("
                . " 1 "
                . " , TO_DATE('" . $carreg->dataApontCarreg . "','DD/MM/YYYY HH24:MI') "
                . " , " . $carreg->equipApontCarreg
                . " , " . $carreg->motoApontCarreg
                . " , " . $carreg->leiraApontCarreg
                . " , " . $os
                . " , 2 "
                . " , 76271 "
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($insert);
        $this->Create->execute();
    }
    
    public function updCarregProd($equip) {

        $update = " UPDATE "
                        . " USINAS.REG_COMPOSTO "
                    . " SET "
                        . " FLAG_CARREG = 2"
                    . " WHERE "
                        . " FLAG_CARREG = 1 AND"
                        . " EQUIP_ID = " . $equip;

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($update);
        $this->Create->execute();
    }

}
