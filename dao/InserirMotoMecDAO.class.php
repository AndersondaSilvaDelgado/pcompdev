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
class InserirMotoMecDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dados) {

        foreach ($dados as $d) {

            $sql = " INSERT INTO APONTA_MOTOMEC VALUES (" . $d->veic . ", " . $d->motorista . ", " . $d->opcor . ", "
                    . " TO_DATE('" . $d->dihi . "','DD/MM/YYYY HH24:MI'), " . $d->caux . ", 1, 1, 0, 0, 0)";

            $this->Conn = parent::getConn();
            $this->Create = $this->Conn->prepare($sql);
            $this->Create->execute();
        }
        
    }

}