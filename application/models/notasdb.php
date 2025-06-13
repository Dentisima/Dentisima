<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Notasdb extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function Notas($IdSucursal, $Busqueda) {
        
        $filtro = "";
        
        if ($Busqueda != "") {

            $Busqueda = str_replace("%20", " ", $Busqueda);
            $Busqueda2 = str_replace(" ", "%", $Busqueda); 
            $filtro .= " AND NOTA LIKE '%" . $Busqueda2 . "%' "; 
        }

        $SQL = "SELECT *,DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FECHA2', ";
        $SQL .= " ( DATEDIFF( DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_FORMAT(FECHA,'%Y-%m-%d')) ) AS 'DIAS_PASO' ";
        $SQL .= " FROM notas WHERE 1=1 $filtro AND ESTATUS='' ORDER BY ID DESC ";

        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }

    function Info($Id) {

        $SQL = "SELECT *, ";
        $SQL .= " ( DATEDIFF( DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_FORMAT(FECHA,'%Y-%m-%d')) ) AS 'DIAS_PASO', ";
        $SQL .= " DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FECHA2' ";
        $SQL .= " FROM notas WHERE ID=" . $Id;
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }
    
    function InfoFolio($Folio = "") {

        $SQL = "SELECT ID FROM notas WHERE FOLIOTEMP='" . $Folio."'";
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }


}
