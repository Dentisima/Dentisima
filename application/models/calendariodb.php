<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Calendariodb extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    } 
    
    function Info($Id) {

        $SQL = "SELECT * FROM cliente WHERE ID=" . $Id;
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }
    
    function CodigoReferido($Codigo = "") {

        $SQL = "SELECT *,CONCAT(NOMBRE,' ',APELLIDOS) AS 'NOMBRE_COMPLETO' FROM cliente WHERE CODIGO_INVITA='" . $Codigo ."' LIMIT 1";
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }
    

}
