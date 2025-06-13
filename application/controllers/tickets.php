<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Tickets extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->model("tablasdb");
        $this->load->model("ticketsdb");

        $this->load->library('fechas');
        $this->load->library('funciones');
        $this->load->library('email');
        $this->load->library('sms');
        $this->load->library('pagina');

        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function index() {

        if (!empty($this->session->userdata('_userid'))) {

            $data["menu"] = "tickets";

            $data["Depto"] = $this->tablasdb->Tabla_categorias("Departamento");
            $data["Prioridad"] = $this->tablasdb->Tabla_categorias("Prioridad");

            $data["Abierto"] = $this->ticketsdb->EstatusTicket("'','Abierta'");
            $data["Cerrado"] = $this->ticketsdb->EstatusTicket("'Cerrada'");

            $data["Importante"] = $this->ticketsdb->EstatusImportante();


            $this->load->view('header', $data);
            $this->load->view('tickets/tickets', $data);
            $this->load->view('footer');
        } else {
            redirect(BASE_URL."login");
        }
    }

    public function Ajax_tickets() {
        if (!empty($this->session->userdata('_userid'))) {

            $Accion = $this->security->xss_clean($this->input->post("Accion"));
            $Busqueda = $this->security->xss_clean($this->input->post("Busqueda"));
            $Estatus = $this->security->xss_clean($this->input->post("Estatus"));
            $Depto = $this->security->xss_clean($this->input->post("Depto"));

            $data["Accion"] = $Accion;
            $data["Listado"] = $this->ticketsdb->Tickets(1, $Busqueda, $Estatus, $Depto);

            $this->load->view('tickets/ajax_tickets', $data);
        }
    }

    public function Ajax_nuevo() {
        if (!empty($this->session->userdata('_userid'))) {
            $Asunto = $this->security->xss_clean($this->input->post("Asunto"));
            $Reporta = $this->security->xss_clean($this->input->post("Reporta"));
            $Telefono = $this->security->xss_clean($this->input->post("Telefono"));
            $Correo = $this->security->xss_clean($this->input->post("Correo"));

            $Departamento = $this->security->xss_clean($this->input->post("Departamento"));
            $Prioridad = $this->security->xss_clean($this->input->post("Prioridad"));
            $Mensaje = $this->security->xss_clean($this->input->post("Mensaje"));

            $datapp = array(
                "IDACCESO" => $this->session->userdata('_userid'),
                "ASUNTO" => $Asunto,
                "REPORTA" => $Reporta,
                "TELEFONO" => $Telefono,
                "CORREO" => $Correo,
                "NOTAS" => $Mensaje,
                "DEPARTAMENTO" => $Departamento,
                "PRIORIDAD" => $Prioridad,
                "ESTATUS" => "Abierta",
                "FECHA" => $this->fechas->fecha(2),
                "HORA" => $this->fechas->fecha(3)
            );
            $this->db->insert('tickets', $datapp);
        }
    }

    public function Ajax_estatus() {
        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->security->xss_clean($this->input->post("Id"));
            $Estatus = $this->security->xss_clean($this->input->post("Estatus"));

            $SQL = "UPDATE tickets SET ESTATUS='" . $Estatus . "' WHERE ID=" . $Id;
            $this->db->query($SQL);

            if ($Estatus == "Abierta") {
                $SQL = "UPDATE tickets SET FCIERRE='',HCIERRE='' WHERE ID=" . $Id;
                $this->db->query($SQL);
            } else {
                $SQL = "UPDATE tickets SET FCIERRE='" . $this->fechas->fecha(2) . "',HCIERRE='" . $this->fechas->fecha(3) . "' WHERE ID=" . $Id;
                echo $SQL;
                $this->db->query($SQL);
            }
        }
    }

    public function Ajax_importante() {

        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->security->xss_clean($this->input->post("Id"));
            $Importante = $this->security->xss_clean($this->input->post("Importante"));

            $SQL = "UPDATE tickets SET IMPORTANTE=" . $Importante . " WHERE ID=" . $Id;
            $this->db->query($SQL);

            if ($Importante == "1") {
                $SQL = "UPDATE tickets SET FCIERRE='',HCIERRE='' WHERE ID=" . $Id;
                $this->db->query($SQL);
            }
        }
    }

    public function Ajax_tickets_info() {

        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->security->xss_clean($this->input->post("Id"));

            $data["Id"] = $Id;
            $data["Info"] = $this->ticketsdb->InfoTicket($Id);

            $this->load->view('tickets/ajax_tickets_info', $data);
        }
    }

    public function Ajax_comentarios() {

        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->security->xss_clean($this->input->post("Id"));
            $Limit = $this->security->xss_clean($this->input->post("Limit"));

            $data["Comentarios"] = $this->ticketsdb->Comentarios($Id, $Limit);

            $this->load->view('tickets/ajax_comentarios', $data);
        }
    }

    public function Ajax_archivos() {
        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->security->xss_clean($this->input->post("Id"));

            $data["Archivos"] = $this->ticketsdb->Archivos($Id);

            $this->load->view('tickets/ajax_archivos', $data);
        }
    }

    public function Ajax_upload_comentario() {


        $Id = $this->security->xss_clean($this->input->post("Id"));
        $TotArchivos = intval($this->input->post("TotArchivos"));
        $Comentario = trim($this->input->post("Comentario"));

        $SQL = "UPDATE tickets SET ESTATUS='Abierta',FCIERRE='',HCIERRE='' WHERE ID=" . $Id;
        $this->db->query($SQL);


        $upload_path = "./expediente/";
        $upload_patha = "./expediente/tickets/";
        $upload_pathfid = "./expediente/tickets/" . $Id . "/";

        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0775, true);
            $arcindex = fopen($upload_path . "index.html", "a");
            fwrite($arcindex, "<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>");
            fclose($arcindex);
        }
        if (!file_exists($upload_patha)) {
            mkdir($upload_patha, 0775, true);
            $arcindex = fopen($upload_patha . "index.html", "a");
            fwrite($arcindex, "<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>");
            fclose($arcindex);
        }
        if (!file_exists($upload_pathfid)) {
            mkdir($upload_pathfid, 0775, true);
            $arcindex = fopen($upload_pathfid . "index.html", "a");
            fwrite($arcindex, "<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>");
            fclose($arcindex);
        }

        $archivos_validos = array('jpg', 'jpeg', 'gif', 'png', 'tif', 'tiff', 'bmp', 'doc', 'docx', 'pdf', 'txt', 'pptx', 'xlsx', 'xls');

        $datapp = array(
            "IDACCESO" => $this->session->userdata('_userid'),
            "IDTICKET" => $Id,
            "COMENTARIO" => $Comentario,
            "FECHA" => $this->fechas->fecha(2),
            "HORA" => $this->fechas->fecha(3)
        );
        $this->db->insert('tickets_comentarios', $datapp);
        $IdComentario = $this->db->insert_id();


        for ($i = 0; $i < $TotArchivos; $i++) {

            $name_arc = $_FILES["archivo" . $i]['name'];
            $extension = strtolower(end(explode(".", $name_arc)));

            if (in_array($extension, $archivos_validos)) {

                @move_uploaded_file($_FILES["archivo" . $i]["tmp_name"], $upload_pathfid . $name_arc);

                $datapp = array(
                    "IDCOMENTARIO" => $IdComentario,
                    "ARCHIVO" => $name_arc
                );
                $this->db->insert('tickets_comentarios_archivos', $datapp);
            }
        }
    }

}
