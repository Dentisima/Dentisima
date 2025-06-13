<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Notas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->model("notasdb");

        $this->load->library('fechas');
        $this->load->library('funciones');
        $this->load->library('email');

        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function index() {
        if (!empty($this->session->userdata('_userid'))) {
            $data["menu"] = "notas";


            $this->load->view('header', $data);
            $this->load->view('notas/notas', $data);
            $this->load->view('footer');
        } else {
            redirect(BASE_URL."login");
        }
    }

    public function Ajax_notas() {
        if (!empty($this->session->userdata('_userid'))) {
            $Busqueda = $this->security->xss_clean($this->input->post("Busqueda"));
            $data["Listado"] = $this->notasdb->Notas(1, $Busqueda);

            $this->load->view('notas/ajax_notas', $data);
        }
    }

    public function Ajax_notas_info() {
        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->security->xss_clean($this->input->post("Id"));
            $Folio = "";

            if ($Id == 0) {
                $Folio = $this->funciones->Aleatorio(8);
            }

            $data["Id"] = $Id;
            $data["Info"] = $this->notasdb->Info($Id);
            $data["Folio"] = $Folio;

            $this->load->view('notas/ajax_notas_info', $data);
        }
    }

    public function Ajax_notasinternas() {
        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->security->xss_clean($this->input->post("Id"));
            $Notas = $this->input->post("Notas");
            $Folio = $this->input->post("Folio");

            $data_0 = array(
                "NOTA" => $Notas,
                'FECHA' => $this->fechas->fecha(2),
                'HORA' => $this->fechas->fecha(3),
                "FOLIOTEMP" => $Folio
            );
            $data_1 = array(
                "NOTA" => $Notas,
                'FECHA_ACTUALIZA' => $this->fechas->fecha(2),
                'HORA_ACTUALIZA' => $this->fechas->fecha(3)
            );

            if ($Id == 0 || $Folio != "") {

                $FT = $this->notasdb->InfoFolio($Folio);

                if (isset($FT->ID)) {
                    $this->db->where('FOLIOTEMP', $Folio);
                    $this->db->update('notas', $data_1);
                } else {
                    $this->db->insert('notas', $data_0);
                    $Id = $this->db->insert_id();
                }
            } else {
                $this->db->where('ID', $Id);
                $this->db->update('notas', $data_1);
            }
        }
    }

    public function Ajax_notasbaja() {
        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->security->xss_clean($this->input->post("Id"));

            $this->db->query("UPDATE notas SET ESTATUS='Baja' WHERE ID=" . $Id);
        }
    }

}
