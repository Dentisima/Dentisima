<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Productos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->model("oracledb");
        $this->load->model("productosdb");

        $this->load->library('fechas');
        $this->load->library('funciones');
        $this->load->library('email');

        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function index() {

        if (!empty($this->session->userdata('_userid'))) {
            $data["menu"] = "productos";

            $data["Org"] = $this->oracledb->Organizaciones();

            $this->load->view('header', $data);
            $this->load->view('productos/productos', $data);
            $this->load->view('footer');
        } else {
            redirect(BASE_URL."login");
        }
    }

    public function Ajax_productos() {
        if (!empty($this->session->userdata('_userid'))) {
            $Tipo = trim($this->input->post("Tipo"));
            $Org = trim($this->input->post("Org"));
            $Sku = $this->security->xss_clean($this->input->post("Sku"));
            $Descripcion = $this->security->xss_clean($this->input->post("Descripcion"));
            $Producto = $this->security->xss_clean($this->input->post("Producto"));

            $data["Listado"] = $this->productosdb->Busqueda($Tipo, $Org, $Sku, $Descripcion,$Producto);

            $this->load->view('productos/ajax_productos', $data);
        }
    }
    
    public function Ajax_inventarios() {
        if (!empty($this->session->userdata('_userid'))) {
            
            $data["Cirrus"] = $this->oracledb->Sucursales(1,4);
            
            $this->load->view('productos/ajax_inventarios',$data);
        }
    }
    
    public function Ajax_sucursal() {

        $IdBrand = $this->input->post("Id");
        $data["Lista"] = $this->oracledb->Sucursales($IdBrand,2);
 
        $this->load->view('productos/ajax_sucursal', $data);
    }
    
    public function Ajax_ventas() {
        if (!empty($this->session->userdata('_userid'))) {
            
            $data["Cirrus"] = $this->oracledb->Sucursales(1,4);
            
            $this->load->view('productos/ajax_ventas',$data);
        }
    }
    
    public function Ajax_Integraciones() {
        if (!empty($this->session->userdata('_userid'))) {
            
            $Id = $this->input->post("Id");
            
            $data["Info"] = $this->productosdb->Info($Id);
            
            $this->load->view('productos/ajax_integracion',$data);
        }
    }
    
    public function Ajax_IdsIntegraciones() {
        if (!empty($this->session->userdata('_userid'))) {
            
            $Ids = $this->input->post("Ids");
            $Ids = substr($Ids,0,strlen($Ids)-1);
            
            $data["Lista"] = $this->productosdb->InfoIds($Ids);
            
            $this->load->view('productos/ajax_Idsintegracion',$data);
        }
    }
    

}
