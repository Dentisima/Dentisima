<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medico extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->database();
        $this->load->model("tablasdb");
        $this->load->model("medicosdb");
        $this->load->library('fechas');

        $this->load->helper('text');
    }

    public function index() {

        if (!empty($this->session->userdata('_userid'))) {

            $data["menu"] = "medico";
            
            $data["Lista"] = $this->medicosdb->Busqueda();
            $data["MedicosTotal"] = $this->medicosdb->MedicosTotal();

            $this->load->view('header', $data);
            $this->load->view('medicos/main', $data);
            $this->load->view('footer');
        } else {
            redirect(BASE_URL . "login");
        }
    }
    
    public function Ajax_busqueda() {

        if (!empty($this->session->userdata('_userid'))) {

            $Busqueda = trim($this->input->post("Busqueda"));
                    
            $data["Lista"] = $this->medicosdb->Busqueda($Busqueda);

            $this->load->view('medicos/ajax_busqueda', $data);
        }
    }

    public function Ajax_nuevo() {

        if (!empty($this->session->userdata('_userid'))) {

            $Id = trim($this->input->post("Id"));

            $Info = $this->medicosdb->Info($Id);

            $data["Info"] = $Info;
            $data["Genero"] = $this->tablasdb->Categorias("Genero");

            $this->load->view('medicos/ajax_nuevo', $data);
        }
    }

    public function Ajax_guardar() {

        if (!empty($this->session->userdata('_userid'))) {

            $ID = trim($this->input->post("ID"));
            $NOMBRE = trim($this->input->post("NOMBRE"));
            $APELLIDOS = trim($this->input->post("APELLIDOS"));
            $TELEFONO = trim($this->input->post("TELEFONO"));
            $WHATSAPP = trim($this->input->post("WHATSAPP"));
            $SEXO = trim($this->input->post("SEXO"));
            $FNACIO = trim($this->input->post("FNACIO"));
            $COMO_SE_ENTERO = trim($this->input->post("COMO_SE_ENTERO"));
            $CODIGO_REFERIDO = trim($this->input->post("CODIGO_REFERIDO"));

            $Folio = $this->tablasdb->FolioCliente('Cliente');
            $NumFolio = doubleval($Folio->FOLIO) + 1;
            $IDREFERIDO = 0;

            $RsCodigo = $this->medicosdb->CodigoReferido($CODIGO_REFERIDO);
            if (isset($RsCodigo->ID)) {
                $IDREFERIDO = $RsCodigo->ID;
            }

            $data_0 = array("IDSUCURSAL" => $this->session->userdata('_usersucursal'),
                "IDUSUARIO" => $this->session->userdata('_userid'),
                "FECHA" => $this->fechas->fecha(2), "HORA" => $this->fechas->fecha(3));

            $data_1 = array("TIPO" => "Cliente", "IDREFERIDO" => $IDREFERIDO, "NOMBRE" => $NOMBRE, "APELLIDOS" => $APELLIDOS, "TELEFONO" => $TELEFONO,
                "WHATSAPP" => $WHATSAPP, "SEXO" => $SEXO, "FNACIO" => $FNACIO, "COMO_SE_ENTERO" => $COMO_SE_ENTERO);

            $data_2 = array('FOLIO' => $NumFolio);

            if ($ID == "0") {

                $data_0 = array_merge($data_0, $data_1);
                $data_0 = array_merge($data_0, $data_2);

                $this->db->insert('cliente', $data_0);
                $ID = $this->db->insert_id();
            } else {
                $this->db->where('ID', $ID);
                $this->db->update('cliente', $data_1);
            }
        }
    }
    
    public function Perfil($Id) {

        if (!empty($this->session->userdata('_userid'))) {

            $data["menu"] = "cliente";
            
            $data["Info"] = $this->medicosdb->Info($Id);

            $this->load->view('header', $data);
            $this->load->view('medicos/perfil', $data);
            $this->load->view('footer');
        } else {
            redirect(BASE_URL . "login");
        }
    }

}
