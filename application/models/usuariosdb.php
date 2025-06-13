<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Usuariosdb extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    
    function Staff($Tipo = "", $Id = "") {
        
        $filtro = "";
        if($Tipo!=""){
            $filtro = " AND TIPO IN(".$Tipo.")  ";
        }
        if($Id!=""){
            $filtro = " AND ID<>".$Id;
        }

        $SQL = "SELECT ID,TIPO,NOMBRE,CORREO FROM accesos WHERE ESTATUS='' ".$filtro;
        $Rs = $this->db->query($SQL);
        return $Rs->result();
    }

}
