<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Drivedb extends CI_Model {

    function __construct() {
        parent::__construct(); 
        $this->load->database();
    }

    function Etiquetas() {

        $SQL = "SELECT *,DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FECHA2' ";
        $SQL .= " FROM drive ORDER BY ETIQUETA ASC ";
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }

    function Info($Id) {

        $SQL = "SELECT *, DATE_FORMAT(FECHA,'%d/%m/%Y') AS FECHA2 ";
        $SQL .= " FROM drive WHERE ID=" . $Id;
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }
    
    function Listado_archivos($Id) {

        $SQL = "SELECT *,DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FECHA2' FROM drive_archivos WHERE IDETIQUETA=" . $Id;
        $SQL .= " ORDER BY ID DESC ";
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }
    
    function InfoArchivo($Id) {

        $SQL = "SELECT *,DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FECHA2', ";
        $SQL .= " (SELECT a.NOMBRE FROM accesos a WHERE a.ID=drive_archivos.IDACCESO) AS 'NOMBRE2' ";
        $SQL .= " FROM drive_archivos WHERE ID=" . $Id;
        $SQL .= " ORDER BY ID DESC ";
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }
    
}
