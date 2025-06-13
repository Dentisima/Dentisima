<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Medicosdb extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    } 
    
    function Info($Id) {

        $SQL = "SELECT *,CONCAT(NOMBRE,' ',APELLIDOS) AS 'NOMBRE_COMPLETO',DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FECHA2' FROM usuario WHERE ID=" . $Id;
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
        
        $SQL = "SELECT *,CONCAT(NOMBRE,' ',APELLIDOS) AS 'NOMBRE_COMPLETO' FROM usuario WHERE TIPO='Medico' ".$Filtro;
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }
  
    
    function MedicosTotal() {

        $SQL = "SELECT COUNT(ID) AS 'TOTAL' FROM usuario WHERE TIPO='Medico'";
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }

}
