<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Factura extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->database();
        $this->load->model("facturadb");
        $this->load->library('fechas');
        $this->load->library('funciones');
    }

    public function index() {

        $data["CFDI_USO"] = $this->facturadb->Catalogo("CFDI_USO");
        $data["FORMA_PAGO"] = $this->facturadb->Catalogo("FORMA_PAGO");
        $data["METODO_PAGO"] = $this->facturadb->Catalogo("METODO_PAGO");
        $data["REGIMEN_FISCAL"] = $this->facturadb->Catalogo("REGIMEN_FISCAL");

        $this->load->view('factura/invoice', $data);
    }

    public function invoice_manual() {

        $this->load->view('factura/invoice_manual');
    }

    public function invoice_ejemplo() {

        $this->load->view('factura/invoice_ejemplo');
    }

    //******************** TEST ************************************************
    public function invoice_ejemplo_test() {

        $this->load->view('factura/invoice_ejemplo_test');
    }

    public function index_test() {

        $data["CFDI_USO"] = $this->facturadb->Catalogo("CFDI_USO");
        $data["FORMA_PAGO"] = $this->facturadb->Catalogo("FORMA_PAGO");
        $data["METODO_PAGO"] = $this->facturadb->Catalogo("METODO_PAGO");
        $data["REGIMEN_FISCAL"] = $this->facturadb->Catalogo("REGIMEN_FISCAL");

        $this->load->view('factura/invoice_test', $data);
    }

    public function invoice_manual_test() {

        $this->load->view('factura/invoice_manual_test');
    }

    //**************************************************************************

    public function Ajax_sucursal() {

        $IdBrand = $this->security->xss_clean($this->input->post("Id"));
        $Marca = $this->security->xss_clean(trim($this->input->post("Marca")));

        $data["Lista"] = $this->facturadb->Sucursales($IdBrand, $Marca);

        $this->load->view('factura/ajax_sucursal', $data);
    }

    public function Ajax_factura() {

        $IDBRAND = $this->security->xss_clean(trim($this->input->post("rdbmarcas")));
        $SUCURSAL = $this->security->xss_clean(trim($this->input->post("cmbStore")));
        $RAZON = $this->security->xss_clean(trim($this->input->post("txtRazonSocial")));
        $RAZON = strtoupper($this->funciones->eliminar_acentos($RAZON));

        $RFC = $this->security->xss_clean(trim($this->input->post("rfcCliente")));
        $RFC = strtoupper($this->funciones->eliminar_acentos($RFC));

        $CODIGO_POSTAL = $this->security->xss_clean(trim($this->input->post("txtPostalCode")));

        $FORMA_PAGO = $this->security->xss_clean(trim($this->input->post("cmbFormaPago")));
        $METODO_PAGO = "PUE"; //$this->security->xss_clean($this->input->post("cmbMetodoPago"));
        $CFDI_USO = $this->security->xss_clean(trim($this->input->post("cmbUsoCFDI")));
        $REGIMEN_FISCAL = $this->security->xss_clean(trim($this->input->post("cmbTaxRegime")));

        $noTicket = $this->security->xss_clean(trim($this->input->post("txtNoTicket"))); 
        
        $txtNotas = $this->security->xss_clean(trim($this->input->post("txtNotas")));
        $Nombre = $this->security->xss_clean(trim($this->input->post("txtPaciente")));
        $CORREO = $this->security->xss_clean(trim($this->input->post("txtMail")));

        $txtFechaTicket = $this->security->xss_clean(trim($this->input->post("txtFechaTicket")));
        $txtTotalTicket = doubleval(trim($this->input->post("txtTotal")));

        $Tipo = $this->security->xss_clean(trim($this->input->post("rdbtipo")));
        $Telefono = $this->security->xss_clean(trim($this->input->post("txtTelefono")));
        $HOSPITAL = "";

        $reglaRazon = array("Beladerma", "Medactiva", "Hospitales Familiares","Reina Madre","Clinicas de belleza y piel sc");
        $ErrorRazon = 0;

        foreach ($reglaRazon as $valor) {
            $posicionCoincidencia = strpos(strtoupper($RAZON), strtoupper($valor));
            if ($posicionCoincidencia !== false) {
                $ErrorRazon = 1;
            }
        }
        
        $ErrorTicket = 0;
        if(!is_numeric($noTicket)){
            $ErrorTicket = 1;
        }

        if ($ErrorRazon == 0 && $ErrorTicket==0) {



            if ($IDBRAND == "2") {
                // $Tipo = "";
            } else {
                if ($Tipo == "Hospitalización") {
                    $HOSPITAL = $SUCURSAL;
                    $SUCURSAL = "HOSPITAL TOLUCA";
                }
            }


            $data_factura = array(
                'IDBRAND' => $IDBRAND,
                'SUCURSAL' => $SUCURSAL,
                'RAZON' => $RAZON,
                'RFC' => $RFC,
                'CODIGO_POSTAL' => $CODIGO_POSTAL,
                'FORMA_PAGO' => $FORMA_PAGO,
                'METODO_PAGO' => $METODO_PAGO,
                'CFDI_USO' => $CFDI_USO,
                'REGIMEN_FISCAL' => $REGIMEN_FISCAL,
                'NOMBRE' => $Nombre,
                'noTicket' => $noTicket,
                'FECHA_TICKET' => $txtFechaTicket,
                'TOTAL_TICKET' => $txtTotalTicket,
                'CORREO' => $CORREO,
                'TELEFONO' => $Telefono,
                'NOTAS' => $txtNotas,
                'TIPO' => $Tipo,
                'HOSPITAL' => $HOSPITAL,
                'FECHA' => $this->fechas->fecha(2),
                'HORA' => $this->fechas->fecha(3)
            );
            $this->db->insert('facturas', $data_factura);
            $Folio = $this->db->insert_id();

            $data["Folio"] = $Folio;
            $data["Status"] = "Success";
            $data["Message"] = "";
            
        } else {
            
            $data["Folio"] = "";
            $data["Status"] = "Error";
            $data["StatusTicket"] = $ErrorTicket;
            $MsjError = "Razón Social no permitida";
            
            if($ErrorTicket==1){
                $MsjError = "No. de ticket incorrecto";                
            }
            
            $data["Message"] = $MsjError;
        }
        
        $this->load->view('factura/ajax_factura', $data);
    }

    public function Listado() {
        if (!empty($this->session->userdata('_userid'))) {
            $data["menu"] = "facturas";

            $this->load->view('header', $data);
            $this->load->view('factura/listado', $data);
            $this->load->view('footer', $data);
        } else {
            redirect(BASE_URL . "login");
        }
    }

    public function Ajax_listado() {
        if (!empty($this->session->userdata('_userid'))) {

            $Brand = $this->input->post("Brand");
            $Sucursal = $this->input->post("Sucursal");
            $NoTicket = $this->input->post("NoTicket");
            $NoFolio = $this->input->post("NoFolio");
            $Tipo = $this->input->post("Tipo");
            $Fecha1 = $this->fechas->FormateaFecha($this->input->post("FechaInicio"), 2);
            $Fecha2 = $this->fechas->FormateaFecha($this->input->post("FechaTermino"), 2);

            $data["Lista"] = $this->facturadb->Listado($Brand, $Sucursal, $NoTicket, $Fecha1, $Fecha2, $Tipo, $NoFolio);

            $this->load->view('factura/ajax_listado', $data);
        }
    }

    public function Ajax_info() {
        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->input->post("Id");

            $data["Info"] = $this->facturadb->Info($Id);
            $data["ListaLogs"] = $this->facturadb->InfoLogs($Id);

            $this->load->view('factura/ajax_info', $data);
        }
    }

    public function Ajax_relacionTickets() {
        if (!empty($this->session->userdata('_userid'))) {

            $Ticket = trim($this->input->post("Ticket"));

            $data["Lista"] = $this->facturadb->RelacionTickets($Ticket);

            $this->load->view('factura/ajax_relacionTickets', $data);
        }
    }

    public function Ajax_FacturadoFolio() {
        if (!empty($this->session->userdata('_userid'))) {

            $Id = trim($this->input->post("Id"));
            $data["Id"] = $Id;

            $this->load->view('factura/ajax_FacturadoFolio', $data);
        }
    }

    public function Ajax_MarcarFacturado() {
        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->input->post("Id");
            $Folio = trim($this->input->post("Folio"));

            $this->db->where('ID', $Id);
            $this->db->update('facturas', array(
                'FACTURADO' => 1,
                'FACTURADO_NUMERO' => $Folio,
                'FACTURADO_IDUSUARIO' => $this->session->userdata('_userid'),
                'FACTURADO_FECHA' => $this->fechas->fecha(2),
                'FACTURADO_HORA' => $this->fechas->fecha(3))
            );
        }
    }

    function test() {
        $Rs = $this->facturadb->Horas();

        foreach ($Rs as $item) {

            echo $item->SEGUNDOS3 . " - " . intval($item->SEGUNDOS3) . "<br>";
        }
    }

}
