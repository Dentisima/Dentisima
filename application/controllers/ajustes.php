<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Ajustes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->model("tablasdb");
        $this->load->model("usuariosdb");
        $this->load->model("reportesdb");

        $this->load->library('fechas');
        $this->load->library('funciones');
        $this->load->library('email'); 

        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function index() {

        if (!empty($this->session->userdata('_userid'))) {

            $data["menu"] = "ajustes";

            $this->load->view('header', $data);
            $this->load->view('ajustes/ajustes', $data);
            $this->load->view('footer');
        } else {
            redirect(BASE_URL . 'login');
        }
    }

    public function AjaxCatalogo() {

        if (!empty($this->session->userdata('_userid'))) {

            $Categoria = $this->security->xss_clean($this->input->post("Categoria"));

            $data["Lista"] = $this->tablasdb->Tabla_categorias($Categoria);
            $data["CategoriaInfo"] = $Categoria;

            $this->load->view('ajustes/ajax_catalogo', $data);
        }
    }

    public function AjaxCatalogoRegistro() {

        if (!empty($this->session->userdata('_userid'))) {

            $Accion = $this->security->xss_clean($this->input->post("Accion"));
            $Id = $this->security->xss_clean($this->input->post("Id"));
            $Categoria = $this->security->xss_clean($this->input->post("Categoria"));
            $Item = $this->security->xss_clean($this->input->post("Item"));
            $Activado = $this->security->xss_clean($this->input->post("Activado"));

            $data_0 = array(
                'CATEGORIA' => $Categoria,
                'CONCEPTO' => $Item,
                'ACTIVADO' => $Activado
            );

            if ($Accion == "Alta") {
                $this->db->insert('tabla_categorias', $data_0);
            }
            if ($Accion == "Update") {
                $this->db->where('ID', $Id);
                $this->db->update('tabla_categorias', $data_0);
            }
            if ($Accion == "Borrado") {
                $this->db->where('ID', $Id);
                $this->db->update('tabla_categorias', array("ESTATUS" => "Borrado"));
            }
        }
    }

    public function AjaxAccesos() {

        if (!empty($this->session->userdata('_userid'))) {

            $data["Lista"] = $this->tablasdb->Accesos();

            $this->load->view('ajustes/ajax_accesos', $data);
        }
    }

    public function AjaxAccesos_Info() {

        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->security->xss_clean($this->input->post("Id"));
            $data["Staff"] = $this->usuariosdb->Staff();
            $data["Reportes"] = $this->reportesdb->Reportes();

            $data["Info"] = $this->tablasdb->AccesosInfo($Id);

            $this->load->view('ajustes/ajax_accesos_alta', $data);
        }
    }

    public function AjaxAccesos_Guarda() {

        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->security->xss_clean($this->input->post("Id"));
            $Pwd = trim($this->input->post("Pwd"));

            $data_0 = array(
                'IDSUCURSAL' => $this->session->userdata('_usersucursal'),
                'FECHA' => $this->fechas->fecha(2),
                'HORA' => $this->fechas->fecha(3)
            );
            $data_1 = array(
                'NOMBRE' => $this->security->xss_clean($this->input->post("Nombre")),
                'CORREO' => $this->security->xss_clean($this->input->post("Correo")),
                'ESTATUS' => $this->security->xss_clean($this->input->post("Estatus")),
                'TIPO' => $this->security->xss_clean($this->input->post("Tipo")),                 
                '_DASHBOARD' => $this->security->xss_clean($this->input->post("_DASHBOARD")),
                '_LOGS' => $this->security->xss_clean($this->input->post("_LOGS")),
                '_LOGS_REPROCESA' => $this->security->xss_clean($this->input->post("_LOGS_REPROCESA")),
                '_FACTURAS' => $this->security->xss_clean($this->input->post("_FACTURAS")),
                '_PRODUCTOS' => $this->security->xss_clean($this->input->post("_PRODUCTOS")),
                '_REPORTES' => $this->security->xss_clean($this->input->post("_REPORTES")),
                '_REPORTES_USUARIOS' => trim($this->input->post("_REPORTES_USUARIOS")),
                '_TICKETS' => $this->security->xss_clean($this->input->post("_TICKETS")),
                '_DRIVE' => $this->security->xss_clean($this->input->post("_DRIVE")),
                '_ACCESOS' => $this->security->xss_clean($this->input->post("_ACCESOS")),
                '_AJUSTES' => $this->security->xss_clean($this->input->post("_AJUSTES")),
                '_NOTAS' => $this->security->xss_clean($this->input->post("_NOTAS")),
                '_INVENTARIOS' => $this->security->xss_clean($this->input->post("_INVENTARIOS")),
                '_TRX' => $this->security->xss_clean($this->input->post("_TRX")),
                '_CARGAVENTAS' => $this->security->xss_clean($this->input->post("_CARGAVENTAS")),
                '_SERVICIOSOIC' => $this->security->xss_clean($this->input->post("_SERVICIOSOIC"))
            );

            if ($Id == 0) {
                $data_0 = array_merge($data_0, $data_1);
                $this->db->insert('accesos', $data_0);
                $Id = $this->db->insert_id();
            } else {
                $this->db->where('ID', $Id);
                $this->db->update('accesos', $data_1);
            }

            if ($Pwd != "") {
                $SQL = "UPDATE accesos SET PWD='" . md5($Pwd) . "' WHERE ID=" . $Id;
                $this->db->query($SQL);
            }
        }
    }

    public function AjaxAccesos_Baja() {

        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->security->xss_clean($this->input->post("Id"));

            $SQL = "UPDATE accesos SET ESTATUS='Eliminado' WHERE ID=" . $Id;
            $this->db->query($SQL);
        }
    }
    
    public function AjaxCambioPwd() {

        if (!empty($this->session->userdata('_userid'))) {

            $Pwd = $this->security->xss_clean($this->input->post("Pwd"));

            $SQL = "UPDATE accesos SET PWD='" . md5($Pwd) . "' WHERE ID=" . $this->session->userdata('_userid');
            $this->db->query($SQL);
        }
    }

}
