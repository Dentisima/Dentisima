<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Dominiosdb extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function Dominios($IdSucursal, $Busqueda, $Estatus, $Tipo) {

        $filtro = " WHERE 1=1 "; //IDSUCURSAL=" . $IdSucursal;

        if ($Busqueda != "") {

            $Busqueda = str_replace("%20", " ", $Busqueda);
            $Busqueda2 = str_replace(" ", "%", $Busqueda);
            $filtro .= " AND ( MATCH (TIPO,PROVEEDOR,DOMINIO) AGAINST ('" . $Busqueda . "' IN BOOLEAN MODE) OR ";
            $filtro .= " CONCAT(TIPO,' ',PROVEEDOR,' ',DOMINIO) LIKE '%" . $Busqueda2 . "%' ";
            $filtro .= " ) ";
        }

        switch ($Estatus) {
            case "":
                $filtro .= " AND ESTATUS IN('Activo','Baja') ";
                break;
            case "Activo":
                $filtro .= " AND ESTATUS IN('Activo') ";
                break;
            case "Baja";
                $filtro .= " AND ESTATUS IN('Baja') ";
                break;
        }
        
        if ($Tipo != "") {
            
            $filtro .= " AND TIPO='" . $Tipo . "' ";
        }


        $SQL = "SELECT *,DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FREGISTRO',DATE_FORMAT(ALTA,'%d/%m/%Y') AS ALTA2, ";
        $SQL .= " TIMESTAMPDIFF(YEAR, DATE_FORMAT(FECHA,'%Y-%m-%d'), CURDATE()) AS 'EDAD' ";
        $SQL .= " FROM dominios " . $filtro;
        $SQL .= " ORDER BY DOMINIO ASC ";
        
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }

    function InfoDominio($Id) {

        $SQL = "SELECT *,DATE_FORMAT(EXPIRA,'%d/%m/%Y') AS EXPIRA2,DATE_FORMAT(ALTA,'%d/%m/%Y') AS ALTA2, ";
        $SQL .= " TIMESTAMPDIFF(YEAR, DATE_FORMAT(ALTA,'%Y-%m-%d'), CURDATE()) AS 'EDAD', ";
        $SQL .= " ( DATEDIFF( DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_FORMAT(ALTA,'%Y-%m-%d')) ) AS 'DIAS_PASO', ";
        $SQL .= " DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FECHA2', ";
        $SQL .= " DATE_FORMAT(FACTUALIZA,'%d/%m/%Y') AS 'FACTUALIZA' ";
        $SQL .= " FROM dominios WHERE ID=" . $Id;
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }
    
    function InfoShow($Id) {

        $SQL = "SELECT ";
        $SQL .= " AES_DECRYPT(USER1,'".BASE_KEY."') AS USER1, ";
        $SQL .= " AES_DECRYPT(PWD1,'".BASE_KEY."') AS PWD1, ";
        $SQL .= " AES_DECRYPT(USER2,'".BASE_KEY."') AS USER2, ";
        $SQL .= " AES_DECRYPT(PWD2,'".BASE_KEY."') AS PWD2 ";
        $SQL .= " FROM dominios WHERE ID=" . $Id;
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }
    

}
