<?php

Class Reportesdb extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function Reportes() {

        $SQL = "SELECT *,DATE_FORMAT(FECHA,'%d/%m/%Y') AS 'FECHA2' ";
        $SQL .= " FROM reportes WHERE ESTATUS='Activo' ";
        $SQL .= " ORDER BY REPORTE ASC ";
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }
    
    function ReportesInfo($Id = 0) {

        $SQL = "SELECT * FROM reportes WHERE ID=" . $Id;
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }
    
    function ReportesInfoCrob($Id = 0) {

        $SQL = "SELECT *,DATE_FORMAT(FECHA1,'%d/%m/%Y') AS 'FECHA1_A',DATE_FORMAT(FECHA2,'%d/%m/%Y') AS 'FECHA2_B' FROM reportes_cronjob WHERE IDREPORTE=" . $Id;
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }
    
    function ListadoCronJobs(){
        $SQL = "SELECT * FROM reportes_cronjob WHERE ACTIVO=1 ";
        $Rs = $this->db->query($SQL);
        return $Rs->result();        
    }
    
    function CorreosDestino() {

        $SQL = "SELECT * FROM cat_destinatarios_reporte_diario WHERE Activo=1";
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }
    
    function ReportesInfoLista($Ids = "") {

        $SQL = "SELECT * FROM reportes WHERE ID IN(".$Ids.")";
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }
     
    
}