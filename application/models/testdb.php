<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Testdb extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function Trx() {
        $SQL = "SELECT ID,organizationCode FROM transaccion WHERE ERROR=1 AND FECHA>='20230101'";
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }

    function TrxItems($Id) {
        $SQL = "SELECT * FROM transaccion_items WHERE IDTRANSACCION=" . $Id;
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }

    function OracleProd( $Org, $Producto) {

        $Producto = str_replace("%20", " ", $Producto);
        $Producto = str_replace(" ", "%", $Producto);        

        $SQL = "SELECT ID FROM oracle_productos WHERE OrganizationCode='".$Org."' AND Description LIKE '%" . $Producto . "%' AND OrganizationCode<>'200'   LIMIT 1";
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }

}
