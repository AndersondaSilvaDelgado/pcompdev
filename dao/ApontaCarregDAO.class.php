<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';

/**
 * Description of ApontaCarregDAO
 *
 * @author anderson
 */
class ApontaCarregDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dados) {

        foreach ($dados as $d) {

            if ($d->tipoApontCarreg == 1) {

                $update = " UPDATE "
                    . " USINAS.REG_COMPOSTO "
                . " SET "
                    . " FLAG_CARREG = 2, CANCEL = 1 "
                . " WHERE "
                    . " FLAG_CARREG = 1 AND "
                    . " EQUIP_ID = " . $d->equipApontCarreg;
                
                $this->Conn = parent::getConn();
                $this->Create = $this->Conn->prepare($update);
                $this->Create->execute();
                
                $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " USINAS.REG_COMPOSTO "
                . " WHERE "
                . " DT = TO_DATE('" . $d->dataApontCarreg . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " EQUIP_ID = " . $d->equipApontCarreg . " ";

                $this->Read = $this->Conn->prepare($select);
                $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                $this->Read->execute();
                $result = $this->Read->fetchAll();

                foreach ($result as $item) {
                    $v = $item['QTDE'];
                }

                if ($v == 0) {

    //              $insert = "INSERT INTO INTERFACE.REG_COMPOSTO_TESTE ("
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
                            . " , TO_DATE('" . $d->dataApontCarreg . "','DD/MM/YYYY HH24:MI') "
                            . " , " . $d->equipApontCarreg . " "
                            . " , " . $d->motoApontCarreg . " "
                            . " , " . $d->prodApontCarreg . " "
                            . " , 1 "
                            . " )";

                    $this->Create = $this->Conn->prepare($insert);
                    $this->Create->execute();

                }
                
            } elseif ($d->tipoApontCarreg == 2) {

                $update = " UPDATE "
                    . " USINAS.REG_COMPOSTO "
                . " SET "
                    . " CANCEL = 1 "
                . " WHERE "
                    . " EQUIP_ID = " . $d->equipApontCarreg;
                
                $this->Conn = parent::getConn();
                $this->Create = $this->Conn->prepare($update);
                $this->Create->execute();
                
                $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " USINAS.REG_COMPOSTO "
                . " WHERE "
                . " DT = TO_DATE('" . $d->dataApontCarreg . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " EQUIP_ID = " . $d->equipApontCarreg . " ";

                $this->Read = $this->Conn->prepare($select);
                $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                $this->Read->execute();
                $result = $this->Read->fetchAll();

                foreach ($result as $item) {
                    $v = $item['QTDE'];
                }

                if ($v == 0) {
                
                    $select = " SELECT "
                                    . " oa.osagricola_id AS OSAGRICOLA "
                                . " FROM "
                                    . " os_agricola oa "
                                    . " , os os "
                                . " WHERE "
                                    . " os.os_id = oa.os_id "
                                    . " and os.os_id = " . $d->osApontCarreg . " ";

                                $this->Read = $this->Conn->prepare($select);
                                $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                                $this->Read->execute();
                                $result = $this->Read->fetchAll();

                                foreach ($result as $item) {
                                    $os = $item['OSAGRICOLA'];
                                }
                    
                    //$insert = "INSERT INTO INTERFACE.REG_COMPOSTO_TESTE ("
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
                            . " , TO_DATE('" . $d->dataApontCarreg . "','DD/MM/YYYY HH24:MI') "
                            . " , " . $d->equipApontCarreg . " "
                            . " , " . $d->motoApontCarreg . " "
                            . " , " . $d->leiraApontCarreg . " "
                            . " , " . $os . " "
                            . " , 2 "
                            . " , 76271 "
                            . " )";

                    $this->Create = $this->Conn->prepare($insert);
                    $this->Create->execute();
                    
                }
                
            }
            
        }
    }

}
