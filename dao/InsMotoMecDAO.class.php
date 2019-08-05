<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';

/**
 * Description of InsMotoMecDAO
 *
 * @author anderson
 */
class InsMotoMecDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dados) {

        foreach ($dados as $d) {

            $v = 0;
            
            $select = " SELECT " 
                    . " COUNT(E.NRO_EQUIP) AS QTDE "
              . " FROM " 
                    . " EQUIP E "
                    . " , CLASSIF_EQUIP CE "
              . " WHERE " 
                    . " E.CLASSEQUIP_ID = CE.CLASSEQUIP_ID "
                    . " AND CE.CLASSEQUIP_ID IN (3, 4) "
                    . " AND E.NRO_EQUIP = " . $d->veic . " ";
            
            $this->Conn = parent::getConn();
            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();
            
            foreach ($result as $item) {
                $v = $item['QTDE'];
            }
            
            if ($v == 0) {
                
                $sql = " INSERT INTO APONTA_MOTOMEC VALUES (" . $d->veic . ", " . $d->motorista . ", " . $d->opcor . ", "
                . " TO_DATE('" . $d->dihi . "','DD/MM/YYYY HH24:MI'), " . $d->caux . ", 1, 1, 0, 0, 0)";

                $this->Create = $this->Conn->prepare($sql);
                $this->Create->execute();
                
            }
            else{
                
                if ($d->caux == '0') {
                
                    $sql = " INSERT INTO APONTA_MOTOMEC VALUES (" . $d->veic . ", " . $d->motorista . ", " . $d->opcor . ", "
                    . " TO_DATE('" . $d->dihi . "','DD/MM/YYYY HH24:MI'), " . $d->caux . ", 1, 1, 0, 0, 0)";

                    $this->Create = $this->Conn->prepare($sql);
                    $this->Create->execute();
                    
                }
                else{
                
                    $v = 0;
                    
                    $select = " SELECT DISTINCT "
                                         . " OS.NRO AS OS "
                                  . " FROM "
                                       . " OS_AGRICOLA OA "
                                       . " , OS_AGR_REAL OE "
                                       . " , OS OS "
                                       . " , ITEM_OS_AGR_ATIV_PROD IP "
                                       . " , COMP_ATIV_PROD CP "
                                       . " , ATIV_AGR AA "
                                  . " WHERE "
                                       . " OA.OSAGRICOLA_ID = OE.OSAGRICOLA_ID(+) "
                                       . " AND OE.DT_FIM_REALIZ IS NULL "
                                       . " AND AA.CD = 175 " 
                                       . " AND OA.SERV_AGR = 0 "
                                       . " AND OS.OS_ID = OA.OS_ID "
                                       . " AND IP.OSAGRICOLA_ID = OA.OSAGRICOLA_ID "
                                       . " AND CP.COMPATIVPR_ID = IP.COMPATIVPR_ID "
                                       . " AND AA.ATIVAGR_ID = CP.ATIVAGR_ID "
                                       . " AND IP.ITOSAGRATP_ID = " . $d->caux . " ";

                    $this->Read = $this->Conn->prepare($select);
                    $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                    $this->Read->execute();
                    $result = $this->Read->fetchAll();

                    foreach ($result as $item) {
                        $v = $item['OS'];
                    }

                    if ($v == 0) {

                        $sql = " INSERT INTO APONTA_MOTOMEC VALUES (" . $d->veic . ", " . $d->motorista . ", " . $d->opcor . ", "
                        . " TO_DATE('" . $d->dihi . "','DD/MM/YYYY HH24:MI'), " . $d->caux . ", 1, 1, 0, 0, 0)";

                        $this->Create = $this->Conn->prepare($sql);
                        $this->Create->execute();

                    } else {

                        $select = " SELECT DISTINCT "
                                             . " IP.ITOSAGRATP_ID  AS ATIVIDADE "
                                      . " FROM "
                                           . " OS_AGRICOLA OA "
                                           . " , OS_AGR_REAL OE "
                                           . " , OS OS "
                                           . " , ITEM_OS_AGR_ATIV_PROD IP "
                                           . " , COMP_ATIV_PROD CP "
                                           . " , ATIV_AGR AA "
                                      . " WHERE "
                                           . " OA.OSAGRICOLA_ID = OE.OSAGRICOLA_ID(+) "
                                           . " AND OE.DT_FIM_REALIZ IS NULL "
                                           . " AND AA.CD = 282 " 
                                           . " AND OA.SERV_AGR = 0 "
                                           . " AND OS.OS_ID = OA.OS_ID "
                                           . " AND IP.OSAGRICOLA_ID = OA.OSAGRICOLA_ID "
                                           . " AND CP.COMPATIVPR_ID = IP.COMPATIVPR_ID "
                                           . " AND AA.ATIVAGR_ID = CP.ATIVAGR_ID "
                                           . " AND OS.NRO = " . $v . " ";

                        $this->Read = $this->Conn->prepare($select);
                        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                        $this->Read->execute();
                        $result = $this->Read->fetchAll();

                        foreach ($result as $item) {
                            $v = $item['ATIVIDADE'];
                        }

                        if ($d->caux == '175') {
                        
                            $sql = " INSERT INTO APONTA_MOTOMEC VALUES (" . $d->veic . ", " . $d->motorista . ", 282, "
                            . " TO_DATE('" . $d->dihi . "','DD/MM/YYYY HH24:MI'), " . $v . ", 1, 1, 0, 0, 0)";

                        }else{
                            
                            $sql = " INSERT INTO APONTA_MOTOMEC VALUES (" . $d->veic . ", " . $d->motorista . ", " . $d->opcor . ", "
                            . " TO_DATE('" . $d->dihi . "','DD/MM/YYYY HH24:MI'), " . $v . ", 1, 1, 0, 0, 0)";
                            
                        }
                        
                        $this->Create = $this->Conn->prepare($sql);
                        $this->Create->execute();

                    }
                
                }
                
            }
            
        }
        
    }

}
