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
class PesqBalancaCompDAO extends Conn {
    /** @var PDOStatement */

    /** @var PDO */
    private $Conn;

    public function pesqInfo($dados) {

        foreach ($dados as $d) {

            $equip = $d->equip;
            $os = $d->os;
            $idLeira = 0;
            $cdLeira = null;
        }

        while (empty($cdLeira)) {

            $sql = "CALL pk_composto_auto.pkb_ret_leira(?, ?, ?, ?)";
            //$sql = "CALL TESTE_COMPOSTAGEM(?, ?, ?, ?)";

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
