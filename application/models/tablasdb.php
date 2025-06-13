<?php

Class Tablasdb extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }


    function Categorias($Categoria) {

        $SQL = "SELECT * FROM categorias WHERE CATEGORIA='" . $Categoria . "' AND ESTATUS='' ORDER BY CONCEPTO ASC ";
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }
    
    function FolioCliente($Tipo) {

        $SQL = "SELECT MAX(FOLIO) AS 'FOLIO' FROM cliente WHERE TIPO='$Tipo'";
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    }
 

}
