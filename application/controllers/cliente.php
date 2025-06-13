<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cliente extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->database();
        $this->load->model("tablasdb");
        $this->load->model("clientesdb");
        
        $this->load->library('fechas');
        $this->load->library('funciones');

        $this->load->helper('text');
    }

    public function index() {

        if (!empty($this->session->userdata('_userid'))) {

            $data["menu"] = "cliente";

            $data["Lista"] = $this->clientesdb->Busqueda();
            $data["PacientesTotal"] = $this->clientesdb->PacientesTotal();

            $this->load->view('header', $data);
            $this->load->view('clientes/main', $data);
            $this->load->view('footer');
        } else {
            redirect(BASE_URL . "login");
        }
    }

    public function Ajax_busqueda() {

        if (!empty($this->session->userdata('_userid'))) {

            $Busqueda = trim($this->input->post("Busqueda"));

            $data["Lista"] = $this->clientesdb->Busqueda($Busqueda);

            $this->load->view('clientes/ajax_busqueda', $data);
        }
    }

    public function Ajax_nuevo() {

        if (!empty($this->session->userdata('_userid'))) {

            $Id = trim($this->input->post("Id"));

            $Info = $this->clientesdb->Info($Id);

            $data["ComoSeEntero"] = $this->tablasdb->Categorias("Como se entero");
            $data["Genero"] = $this->tablasdb->Categorias("Genero");
            $data["Info"] = $Info;

            $this->load->view('clientes/ajax_nuevo', $data);
        }
    }

    public function Ajax_modal_busqueda() {

        if (!empty($this->session->userdata('_userid'))) {

            $Busqueda = trim($this->input->post("Busqueda"));

            $Lista = $this->clientesdb->Busqueda($Busqueda);

            $data["Lista"] = $Lista;

            $this->load->view('clientes/ajax_modal_busqueda', $data);
        }
    }

    public function Ajax_referido() {
        if (!empty($this->session->userdata('_userid'))) {

            $CODIGO_REFERIDO = trim($this->input->post("CODIGO_REFERIDO"));
            $NOMBRE = "";

            $RsCodigo = $this->clientesdb->CodigoReferido($CODIGO_REFERIDO);
            if (isset($RsCodigo->ID)) {
                $NOMBRE = $RsCodigo->NOMBRE_COMPLETO;
            }

            echo $NOMBRE;
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
            
            $Dia = $this->security->xss_clean($this->input->post("DIA"));
            $Mes = $this->security->xss_clean($this->input->post("MES"));
            $Anio = $this->security->xss_clean($this->input->post("ANIO"));
            
            $Dia = substr(("0".$Dia),-2);
            $Mes = substr(("0".$Mes),-2);
            
            $FNACIO = $Anio.$Mes.$Dia;
            $TUTOR = trim($this->input->post("TUTOR"));
            $COMO_SE_ENTERO = trim($this->input->post("COMO_SE_ENTERO"));
            $CODIGO_REFERIDO = trim($this->input->post("CODIGO_REFERIDO"));
            $STEP = trim($this->input->post("STEP"));
            $NOTAS = trim($this->input->post("NOTAS"));

            $Folio = $this->tablasdb->FolioCliente('Cliente');
            $NumFolio = doubleval($Folio->FOLIO) + 1;
            $IDREFERIDO = 0;

            $RsCodigo = $this->clientesdb->CodigoReferido($CODIGO_REFERIDO);
            if (isset($RsCodigo->ID)) {
                $IDREFERIDO = $RsCodigo->ID;
            }
            $CODIGO_INVITA = $this->funciones->Aleatorio(5,false,false,true);
            

            $data_0 = array("IDSUCURSAL" => $this->session->userdata('_usersucursal'),
                "IDUSUARIO" => $this->session->userdata('_userid'),
                "FECHA" => $this->fechas->fecha(2), "HORA" => $this->fechas->fecha(3),
                "CODIGO_INVITA"=>$CODIGO_INVITA
                );

            $data_1 = array("TIPO" => "Cliente", "IDREFERIDO" => $IDREFERIDO, 
                "NOMBRE" => $NOMBRE, "APELLIDOS" => $APELLIDOS, "TELEFONO" => $TELEFONO,
                "TUTOR" => $TUTOR,
                "WHATSAPP" => $WHATSAPP, "SEXO" => $SEXO, "FNACIO" => $FNACIO, "COMO_SE_ENTERO" => $COMO_SE_ENTERO, "_STEP" => $STEP,
                "NOTAS" => $NOTAS
            ); 
            
            $Folio_Cliente = $this->session->userdata('_usersucursal').substr(date("Y"),-2).date("m").$NumFolio;
            $data_2 = array('FOLIO' => $NumFolio, "FOLIO_CLIENTE"=>$Folio_Cliente );
            
            $Esnuevo = 0;

            if ($ID == "0") {

                $data_0 = array_merge($data_0, $data_1);
                $data_0 = array_merge($data_0, $data_2);
                 

                $this->db->insert('cliente', $data_0);
                $ID = $this->db->insert_id();
                
                $Esnuevo = $ID;
                $data["Info"] = $this->clientesdb->Info($ID);
                
            } else {
                $this->db->where('ID', $ID);
                $this->db->update('cliente', $data_1);
                $data["Info"] = $this->clientesdb->Info($ID);
            }
            
            $data["Esnuevo"] = $Esnuevo;
            $this->load->view('clientes/ajax_guarda', $data);
        }
    }

    public function Perfil($Id) {

        if (!empty($this->session->userdata('_userid'))) {

            $data["menu"] = "cliente";

            $data["Info"] = $this->clientesdb->Info($Id);

            $this->load->view('header', $data);
            $this->load->view('clientes/perfil', $data);
            $this->load->view('footer');
        } else {
            redirect(BASE_URL . "login");
        }
    }

    public function Ajax_Edad() {
        if (!empty($this->session->userdata('_userid'))) {

            $Dia = $this->security->xss_clean($this->input->post("Dia"));
            $Mes = $this->security->xss_clean($this->input->post("Mes"));
            $Anio = $this->security->xss_clean($this->input->post("Anio"));
            
            $Dia = substr(("0".$Dia),0,-2);
            $Mes = substr(("0".$Mes),0,-2);
            
            $Fecha = $Anio."-".$Mes."-".$Dia; 
            
            $Anios = $this->fechas->Edad($Fecha);

            echo $Anios;
        }
    }
    
    public function Ajax_modal_detalle(){
        
        if (!empty($this->session->userdata('_userid'))) {

            $Id = trim($this->input->post("Id"));
            
            $data["Info"] = $this->clientesdb->Info($Id);
            
            $this->load->view('clientes/ajax_modal_detalle', $data);
            
        }
        
    }

}
