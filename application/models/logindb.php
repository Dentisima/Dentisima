<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Logindb extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function Verifica($Usuario = "", $Password = "") { 
        
        $SQL = "SELECT * FROM usuario WHERE MD5(NIP)='" . md5(trim($Usuario)). "' AND PWD='" . md5(trim($Password)). "' AND ESTATUS='Activo' ";
        $Rs = $this->db->query($SQL);
        return $Rs->row();
    } 
    
    
}