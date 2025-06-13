<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        
        $this->load->model("logindb");
        $this->load->library('fechas');

    }

    public function index($status = "") {

        $data["status"] = $status;

        $this->load->view('login', $data);
    }
    
    function AjaxAcceso() {

        $User = $this->security->xss_clean($this->input->post("user"));
        $Pass = $this->security->xss_clean($this->input->post("pwd"));

        $Rs = $this->logindb->Verifica($User, $Pass);

        $Status = "";
        $Url = "";
        $Msj = "";

        if (isset($Rs->ID)) { #Existe
            $data = array(
                "IDUSUARIO" => $Rs->ID,
                "CONCEPTO"=> "Acceso al sistema",
                "FECHA" => $this->fechas->fecha(2),
                "HORA" => $this->fechas->fecha(3)
            );
            $this->db->insert('bitacora', $data);

            $this->session->set_userdata('_userid', $Rs->ID);
            $this->session->set_userdata('_usersucursal', $Rs->IDSUCURSAL);
            $this->session->set_userdata('_usernombre', $Rs->NOMBRE);
            $this->session->set_userdata('_usertipo', $Rs->TIPO);
            
            $this->session->set_userdata('_userinfo', $Rs);

            $Status = "ok";
            $Url = BASE_URL . "calendario";
        } else {
            $Status = "error";
            $Msj = "Datos de acceso incorrectos.";
        }

        $data["status"] = $Status;
        $data["msj"] = $Msj;
        $data["url"] = $Url;

        $this->load->view('login_result', $data);
    }

    function logout() {

        $this->session->unset_userdata(array('_userid' => ''));
        $this->session->unset_userdata(array('_userconsul' => ''));
        $this->session->unset_userdata(array('_userexpira' => ''));
        $this->session->unset_userdata(array('_usernombre' => ''));

        redirect(BASE_URL . 'login');
    }


}
