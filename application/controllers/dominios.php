<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Dominios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->model("dominiosdb");
        $this->load->model("tablasdb");

        $this->load->library('fechas');
        $this->load->library('funciones');
        $this->load->library('email');
        $this->load->library('sms');
        $this->load->library('pagina');

        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function Index() {

        if (!empty($this->session->userdata('_userid'))) {

            $data["menu"] = "dominios";
            
            $data["Dominio"] = $this->tablasdb->Tabla_categorias("Tipo dominio");

            $this->load->view('header', $data);
            $this->load->view('dominios/dominios', $data);
            $this->load->view('footer');
        } else {
            redirect(BASE_URL . 'login');
        }
    }

    public function Ajax_dominios() {

        if (!empty($this->session->userdata('_userid'))) {
            
            $Accion = $this->security->xss_clean($this->input->post("Accion"));
            $Tipo = $this->security->xss_clean($this->input->post("Tipo"));
            $Busqueda = $this->security->xss_clean($this->input->post("Busqueda"));
            $Estatus = $this->security->xss_clean($this->input->post("Estatus"));
            
            $data["Accion"] = $Accion;
            $data["Listado"] = $this->dominiosdb->Dominios($this->session->userdata('_usersucursal'), $Busqueda, $Estatus, $Tipo);

            $this->load->view('dominios/ajax_dominios', $data);
        }
    }

    public function Ajax_dominios_info() {

        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->security->xss_clean($this->input->post("Id"));

            $data["Dominio"] = $this->tablasdb->Tabla_categorias("Tipo dominio");
            

            $data["Info"] = $this->dominiosdb->InfoDominio($Id);
            $data["Id"] = $Id;

            $this->load->view('dominios/ajax_dominios_info', $data);
        }
    }

    public function Ajax_guardadominio() {

        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->security->xss_clean($this->input->post("Id"));
            $user1 = $this->security->xss_clean($this->input->post("user1"));
            $pwd1 = trim($this->input->post("pwd1"));
            $user2 = trim($this->input->post("user2"));
            $pwd2 = trim($this->input->post("pwd2"));
            $cambio = trim($this->input->post("cambio"));

            $data_0 = array(
                'IDSUCURSAL' => $this->session->userdata('_usersucursal'),
                'IDACCESO' => $this->session->userdata('_userid'),
                'FECHA' => $this->fechas->fecha(2),
                'HORA' => $this->fechas->fecha(3)
            );
            $data_1 = array(
                'TIPO' => $this->security->xss_clean($this->input->post("tipo")), 
                'DOMINIO' => $this->security->xss_clean($this->input->post("dominio")),
                'URL1' => $this->security->xss_clean($this->input->post("url1")),
                'URL2' => $this->security->xss_clean($this->input->post("url2")),
                'ALTA' => $this->fechas->FormateaFecha($this->security->xss_clean($this->input->post("alta")), 4),
                'EXPIRA' => $this->fechas->FormateaFecha($this->security->xss_clean($this->input->post("expira")), 4),
                'NOTAS' => $this->security->xss_clean($this->input->post("notas")),
                'FACTUALIZA' => $this->fechas->fecha(2),
                'HACTUALIZA' => $this->fechas->fecha(3)
            );

            $Msj = "";
            $EsNuevo = "";
            if ($Id == 0) {
                $data_0 = array_merge($data_0, $data_1);
                $this->db->insert('dominios', $data_0);
                $Id = $this->db->insert_id();
                $Msj = "El dominio se guardo correctamente!";
                $EsNuevo = "1";
                $cambio = 1; 
                
            } else {
                
                $this->db->where('ID', $Id);
                $this->db->update('dominios', $data_1);
                $Msj = "El dominio se actualizó correctamente!"; 
                
            }

            if ($this->session->userdata('_usertipo') == "root" && $cambio == 1) {

                $SQL = "UPDATE dominios SET ";
                $SQL .= " USER1=AES_ENCRYPT('" . $user1 . "','" . BASE_KEY . "'), ";
                $SQL .= " PWD1=AES_ENCRYPT('" . $pwd1 . "','" . BASE_KEY . "'), ";
                $SQL .= " USER2=AES_ENCRYPT('" . $user2 . "','" . BASE_KEY . "'), ";
                $SQL .= " PWD2=AES_ENCRYPT('" . $pwd2 . "','" . BASE_KEY . "') ";
                $SQL .= " WHERE ID=" . $Id;
                $this->db->query($SQL);
                 
                
            }

            $data["status"] = "success";
            $data["title"] = "Éxito";
            $data["msj"] = $Msj;
            $data["EsNuevo"] = $EsNuevo;

            $data["Info"] = $this->dominiosdb->InfoDominio($Id);
            $data["Id"] = $Id;

            $this->load->view('dominios/ajax_alert', $data);
        }
    }

    public function Ajax_show() {

        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->security->xss_clean($this->input->post("Id"));
            $Cambio = $this->security->xss_clean($this->input->post("cambio"));

            $data["Info"] = $this->dominiosdb->InfoShow($Id);
            $data["Id"] = $Id;
            $data["Cambio"] = $Cambio;

            $this->load->view('dominios/ajax_show', $data);
        }
    }

}
