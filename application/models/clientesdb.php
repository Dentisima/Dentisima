<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Clientesdb extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    } 
    
    function Info($Id) {

        $SQL = "SELECT *,CONCAT(NOMBRE,' ',APELLIDOS) AS 'NOMBRE_COMPLETO',";
        $SQL .= " 0 AS 'SALDO',DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FECHA2', ";
        $SQL .= " DATE_FORMAT(FNACIO,'%d/%m/%Y') AS 'FNACIO2', ";
        $SQL .= " TIMESTAMPDIFF(YEAR, DATE_FORMAT(FNACIO,'%Y-%m-%d'), CURDATE()) AS 'EDAD', ";
        $SQL .= " TIMESTAMPDIFF(DAY, DATE_FORMAT(FNACIO,'%Y-%m-%d'), CURDATE()) AS 'DIAS', ";
        $SQL .= " LEFT(SEXO,1) AS 'ABR_SEXO', ";
        $SQL .= " (SELECT CONCAT(c.NOMBRE,' ',c.APELLIDOS ) FROM cliente c WHERE c.ID=cliente.IDREFERIDO) AS 'UP_NOMBRE', ";
        $SQL .= " (SELECT c.CODIGO_INVITA FROM cliente c WHERE c.ID=cliente.IDREFERIDO) AS 'UP_CODIGO', ";
        $SQL .= " (SELECT COUNT(c.ID) FROM cliente c WHERE c.IDREFERIDO=cliente.ID ) AS 'INVITADOS' ";
        $SQL .= " FROM cliente WHERE ID=" . $Id;
     
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }
    
    function Busqueda($Busqueda = "") {
        
        $Filtro = "";

        if ($Busqueda != "") {

            $cad_nueva = explode(" ", trim($Busqueda));
            $_nueva = "";
            for ($i = 0; $i < count($cad_nueva); $i++) {
                $_nueva .= trim($cad_nueva[$i]) . "%";
            }

            $Filtro .= " AND ( ID LIKE '%" . $_nueva . "' OR CONCAT(NOMBRE,' ',APELLIDOS) LIKE '%" . $_nueva . "' ) ";
        }
        
        $SQL = "SELECT *,CONCAT(NOMBRE,' ',APELLIDOS) AS 'NOMBRE_COMPLETO',0 AS 'SALDO' FROM cliente WHERE TIPO='Cliente' ".$Filtro;

        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }
    
    function CodigoReferido($Codigo = "") {

        $SQL = "SELECT *,CONCAT(NOMBRE,' ',APELLIDOS) AS 'NOMBRE_COMPLETO' FROM cliente WHERE CODIGO_INVITA='" . $Codigo ."' LIMIT 1";
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }
    
    function PacientesTotal() {

        $SQL = "SELECT COUNT(ID) AS 'TOTAL' FROM cliente WHERE TIPO='Cliente'";
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }

}
