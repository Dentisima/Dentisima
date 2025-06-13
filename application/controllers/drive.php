<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Drive extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->model("tablasdb");
        $this->load->model("drivedb");

        $this->load->library('fechas');
        $this->load->library('funciones');
        $this->load->library('email');

        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function index() {

        if (!empty($this->session->userdata('_userid'))) {
            $data["menu"] = "drive";

            $this->load->view('header', $data);
            $this->load->view('drive/drive', $data);
            $this->load->view('footer', $data);
        } else {
            redirect(BASE_URL."login");
        }
    }

    public function Ajax_etiquetas() {
        if (!empty($this->session->userdata('_userid'))) {

            $data["Lista"] = $this->drivedb->Etiquetas();

            $this->load->view('drive/ajax_etiquetas', $data);
        }
    }

    public function Ajax_nuevo() {

        if (!empty($this->session->userdata('_userid'))) {
            $datapp = array(
                "IDACCESO" => 1,
                "ETIQUETA" => $this->security->xss_clean($this->input->post("Etiqueta")),
                "FECHA" => $this->fechas->fecha(2),
                "HORA" => $this->fechas->fecha(3)
            );
            $this->db->insert('drive', $datapp);
        }
    }

    public function Ajax_archivos() {

        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->security->xss_clean($this->input->post("Id"));

            $data["Info"] = $this->drivedb->Info($Id);

            $this->load->view('drive/ajax_archivos', $data);
        }
    }

    public function Ajax_upload() {


        $Id = $this->security->xss_clean($this->input->post("Id"));
        $TotArchivos = intval($this->security->xss_clean($this->input->post("TotArchivos")));

        $upload_path = "./expediente/";
        $upload_patha = "./expediente/drive/";
        $upload_pathfid = "./expediente/drive/" . $Id . "/";

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

        $archivos_validos = array('jpg', 'jpeg', 'gif', 'png', 'tif', 'tiff', 'avi', 'xml', 'sql', 'msi',
            'bmp', 'doc', 'docx', 'pdf', 'txt', 'xls', 'xlsx', 'mp4', 'mov', 'mp3', 'zip', 'rar', 'pptx', 'xml', 'html', 'htm');

        for ($i = 0; $i < $TotArchivos; $i++) {

            $name_arc = $_FILES["archivo_" . $i]['name'];
            $filesize = $_FILES["archivo_" . $i]['size'];

            //$extension = strtolower(end(explode(".", $name_arc)));
            $extension = strtolower(trim(strrchr($name_arc, ".")));
            $extension = substr($extension, 1, strlen($extension));

            if (in_array($extension, $archivos_validos)) {

                @move_uploaded_file($_FILES["archivo_" . $i]["tmp_name"], $upload_pathfid . $name_arc);

                $datapp = array(
                    "IDACCESO" => 1,
                    "IDETIQUETA" => $Id,
                    "ARCHIVO" => $name_arc,
                    "PESO" => $filesize,
                    "FECHA" => $this->fechas->fecha(2),
                    "HORA" => $this->fechas->fecha(3)
                );
                $this->db->insert('drive_archivos', $datapp);
            }
        }
    }

    public function Ajax_archivos_lista() {

        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->security->xss_clean($this->input->post("Id"));

            $data["Info"] = $this->drivedb->Info($Id);
            $data["Lista"] = $this->drivedb->Listado_archivos($Id);

            $this->load->view('drive/ajax_archivos_lista', $data);
        }
    }

    public function Ajax_archivos_info() {

        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->security->xss_clean($this->input->post("Id"));

            $data["Info"] = $this->drivedb->Info($Id);
            $data["InfoArchivo"] = $this->drivedb->InfoArchivo($Id);

            $this->load->view('drive/ajax_archivos_info', $data);
        }
    }

    public function Ajax_notasinternas() {
        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->security->xss_clean($this->input->post("Id"));

            $this->db->where('ID', $Id);
            $datapp = array("NOTAS" => trim($this->input->post("Notas")));
            $this->db->update('drive_archivos', $datapp);
        }
    }

    public function Ajax_eliminararchivo() {
        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->security->xss_clean($this->input->post("Id"));
            $IdEtiqueta = $this->security->xss_clean($this->input->post("IdEtiqueta"));
            $Archivo = $this->security->xss_clean($this->input->post("Archivo"));

            $this->db->where('ID', $Id);
            $this->db->delete('drive_archivos');

            $upload_pathfid = "./expediente/drive/" . $IdEtiqueta . "/" . $Archivo;

            unlink($upload_pathfid);
        }
    }

}
