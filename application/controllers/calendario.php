<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendario extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->database();
        $this->load->model("tablasdb"); 
        $this->load->model("calendariodb"); 
        $this->load->library('fechas');

        $this->load->helper('text');
    }

    public function index() {

        if (!empty($this->session->userdata('_userid'))) {

            $data["menu"] = "calendario";
 
            $this->load->view('header', $data);
            $this->load->view('calendario/main', $data);
            $this->load->view('footer');
 
        } else {
            redirect(BASE_URL . "login");
        }
    }
    
    public function Ajax_nuevacita() {

        if (!empty($this->session->userdata('_userid'))) {
            
            $Fecha = str_replace(",","",trim($this->input->post("Fecha")));
            
            $arFecha = explode(" ",$Fecha);
            $Mes = $this->fechas->MesNumero(trim($arFecha[0]));
            $Dia = substr("0".trim($arFecha[1]),-2);
            $Anio = trim($arFecha[2]);
            
            $Fecha = $Anio.$Mes.$Dia;
            
            $data["NomFecha"] = $this->fechas->FormateaFecha($Fecha,10);
            
            $data["Horario"] = $this->tablasdb->Categorias("Horario");
            $data["Fecha"] = $Fecha;
            
            $this->load->view('calendario/ajax_nuevacita',$data);
            
        }
    }
    
    public function Ajax_guardacita(){
        
        if (!empty($this->session->userdata('_userid'))) {
            
            $Fecha = trim($this->input->post("Fecha")); 
            $Codigo = trim($this->input->post("Codigo")); 
            $Hora = trim($this->input->post("Hora")); 
            $Minutos = trim($this->input->post("Minutos")); 
            $Prefijo = trim($this->input->post("Prefijo")); 
            $Docto = trim($this->input->post("Doctor")); 
               
            
        }
    }
    
 
 
}
