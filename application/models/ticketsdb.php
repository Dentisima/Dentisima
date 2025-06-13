<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Ticketsdb extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function Tickets($IdSucursal, $Busqueda = "", $Estatus = "", $Depto = "", $idpaciente = "") {

        $filtro = " WHERE 1=1 "; //IDSUCURSAL=" . $IdSucursal;

        if ($Busqueda != "") {

            $Busqueda = str_replace("%20", " ", $Busqueda);
            $Busqueda2 = str_replace(" ", "%", $Busqueda);
            $filtro .= " AND ( MATCH (ID,ASUNTO,NOTAS,PRIORIDAD,ESTATUS,DEPARTAMENTO,REPORTA) AGAINST ('" . $Busqueda . "' IN BOOLEAN MODE) OR ";
            $filtro .= " CONCAT(ID,' ',ASUNTO,' ',NOTAS,' ',PRIORIDAD,' ',ESTATUS,' ',DEPARTAMENTO,' ',REPORTA) LIKE '%" . $Busqueda2 . "%' ";
            $filtro .= " ) ";
        }

        if ($Depto != "") {
            $filtro .= " AND DEPARTAMENTO='$Depto' ";
        }
        
        if ($idpaciente != "") {
            $filtro .= " AND idPaciente='$idpaciente' ";
        }

        if ($Estatus != "") {
 
            if ($Estatus == "Importante") {
                $filtro .= " AND IMPORTANTE=1 ";
            } else {
                if ($Estatus == "Abierta") {
                    $filtro .= " AND ESTATUS IN('','Abierta') ";
                } else if ($Estatus == "Cerrada") {
                    $filtro .= " AND ESTATUS IN('Cerrada') ";
                } else {
                    $filtro .= " AND PRIORIDAD IN('" . $Estatus . "') ";
                }
            }
        }

        $SQL = "SELECT *,DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FECHA2', ";
        $SQL .= " TIMESTAMPDIFF(YEAR, DATE_FORMAT(FECHA,'%Y-%m-%d'), CURDATE()) AS 'EDAD' ";
        $SQL .= " FROM tickets " . $filtro;
        $SQL .= " ORDER BY ID DESC ";
        
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }

    function InfoTicket($Id) {

        $SQL = "SELECT *, ";
        $SQL .= " TIMESTAMPDIFF(YEAR, DATE_FORMAT(FECHA,'%Y-%m-%d'), CURDATE()) AS 'EDAD', ";
        $SQL .= " ( DATEDIFF( DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_FORMAT(FECHA,'%Y-%m-%d')) ) AS 'DIAS_PASO', ";
        $SQL .= " DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FECHA2' ";
        $SQL .= " FROM tickets WHERE ID=" . $Id;
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }

    function Comentarios($Id, $Limit = 0) {

        $_limit = " ORDER BY ID ASC";
        if ($Limit > 0) {
            $_limit = " ORDER BY ID ASC LIMIT 1 ";
        }

        $SQL = "SELECT *, ";
        $SQL .= " (SELECT a.NOMBRE FROM accesos a WHERE a.ID=tickets_comentarios.IDACCESO) AS 'ACCESO',";
        $SQL .= " ( DATEDIFF( DATE_FORMAT(NOW(),'%Y-%m-%d'),DATE_FORMAT(FECHA,'%Y-%m-%d')) ) AS 'DIAS_PASO', ";
        $SQL .= " DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FECHA2' ";
        $SQL .= " FROM tickets_comentarios WHERE IDTICKET=" . $Id . " " . $_limit;

        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }

    function Archivos($Id) {

        $SQL = "SELECT *, ";
        $SQL .= " (SELECT tc.IDTICKET FROM tickets_comentarios tc WHERE tc.ID=tca.IDCOMENTARIO LIMIT 1) AS 'IDTICKET' ";
        $SQL .= " FROM tickets_comentarios_archivos tca WHERE tca.IDCOMENTARIO=" . $Id;
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }

    function EstatusTicket($Estatus = "") {

        $SQL = "SELECT COUNT(ID) AS 'TOTAL' FROM tickets WHERE ESTATUS IN(" . $Estatus . ")";
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }

    function EstatusImportante() {

        $SQL = "SELECT COUNT(ID) AS 'TOTAL' FROM tickets WHERE IMPORTANTE=1";
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }

}
