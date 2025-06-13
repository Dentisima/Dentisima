<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logs extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->database();
        $this->load->model("erpdb");
        $this->load->model("oracledb");
        $this->load->library('fechas');

        $this->load->helper('text');
    }

    public function index() {

        if (!empty($this->session->userdata('_userid'))) {

            $data["menu"] = "logs";

            $RsUser = $this->session->userdata('_userinfo');

            $this->load->view('header', $data);
            if ($RsUser->_LOGS == 1) {
                $this->load->view('logs/main', $data);
            }

            $this->load->view('footer', $data);
        } else {
            redirect(BASE_URL . "login");
        }
    }

    public function Tickets() {

        if (!empty($this->session->userdata('_userid'))) {

            $data["menu"] = "tickets";

            $this->load->view('header', $data);
            $this->load->view('logs/tickets', $data);
            $this->load->view('footer', $data);
        } else {
            redirect(BASE_URL . "login");
        }
    }

    function Ajax_Lista() {

        if (!empty($this->session->userdata('_userid'))) {

            $TIPO = $this->input->post("Tipo");
            $Fecha1 = $this->fechas->FormateaFecha($this->input->post("FechaInicio"), 2);
            $Fecha2 = $this->fechas->FormateaFecha($this->input->post("FechaTermino"), 2);

            $data["Lista"] = $this->erpdb->Logs($TIPO, $Fecha1, $Fecha2);

            $this->load->view('logs/ajax_listado', $data);
        }
    }

    function Ajax_Tickets() {

        if (!empty($this->session->userdata('_userid'))) {

            $Tipo = $this->input->post("Tipo");
            $NoTicket = $this->input->post("NoTicket");
            $IdTrx = $this->input->post("IdTrx");
            $idpaciente = $this->input->post("idpaciente");
            $Fecha1 = $this->fechas->FormateaFecha($this->input->post("FechaInicio"), 2);
            $Fecha2 = $this->fechas->FormateaFecha($this->input->post("FechaTermino"), 2);

            $data["Lista"] = $this->erpdb->Tickets($Tipo, $NoTicket, $Fecha1, $Fecha2, $IdTrx,$idpaciente);

            $this->load->view('logs/listado_tickets', $data);
        }
    }

    function Ajax_Diferencia() {
        if (!empty($this->session->userdata('_userid'))) {

            $Origen = $this->input->post("Origen");
            $Fecha = $this->input->post("Fecha");
            $Estatus = $this->input->post("Estatus");
            $Procesados = $this->input->post("Procesados");

            $data["Lista"] = $this->erpdb->TicketsDiferencia($Origen, $Fecha, $Estatus, $Procesados);

            $this->load->view('logs/listado_diferencia', $data);
        }
    }

    function Ajax_Info() {
        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->input->post("Id");

            $data["Info"] = $this->erpdb->infoTransaccion($Id);
            $data["Items"] = $this->erpdb->transaccion_items($Id);
            $data["Payments"] = $this->erpdb->transaccion_payments($Id);

            $this->load->view('logs/info_tickets', $data);
        }
    }

    function vend() {

        $Json = trim(file_get_contents('php://input'));

        $data_log = array(
            'TIPO' => 'VEND',
            'FECHA' => $this->fechas->fecha(2),
            'HORA' => $this->fechas->fecha(3),
            'JSON' => $Json,
            'NUEVO' => 1
        );
        $this->db->insert('logs', $data_log);
    }

    function mindbody() {

        $Json = trim(file_get_contents('php://input'));

        $data_log = array(
            'TIPO' => 'MINDBODY',
            'FECHA' => $this->fechas->fecha(2),
            'HORA' => $this->fechas->fecha(3),
            'JSON' => $Json,
            'NUEVO' => 1
        );
        $this->db->insert('logs', $data_log);
    }

    function uploadTRX() {

        $upload_path = "./temp/";

        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0775, true);
            $arcindex = fopen($upload_path . "index.html", "a");
            fwrite($arcindex, "<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>");
            fclose($arcindex);
        }


        $archivos_validos = array('xlsx', 'xls');

        $name_arc = $_FILES["arcXLSTrx"]['name'];

        $ArExt = explode(".", $name_arc);

        $extension = strtolower(end($ArExt));
        $PasaXls = false;

        if (in_array($extension, $archivos_validos)) {

            @move_uploaded_file($_FILES["arcXLSTrx"]["tmp_name"], $upload_path . $name_arc);
            $PasaXls = true;
        }

        if ($PasaXls == true) {

            $this->load->library("PHPExcel");
            $inputFileName = './temp/' . $name_arc;

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }


            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            $ORIGEN = "";
            for ($row = 3; $row <= $highestRow; $row++) {

                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                $ArData = $rowData[0];

                if (trim($ArData[1]) != "" && trim($ArData[2]) != "") {

                    $ORIGEN = trim($ArData[2]);

                    if ($ORIGEN == "VEND" || $ORIGEN == "SICAR" || $ORIGEN == "MINDBODY") {

                        $RsTicket = $this->oracledb->TicketUnidadNegocio(trim($ArData[2]), trim($ArData[6]), trim($ArData[10]), trim($ArData[20]));

                        if (!isset($RsTicket->ID)) {

                            $Rs = $this->oracledb->OrgUnidadNegocio(trim($ArData[6]), trim($ArData[10]));

                            $ORG = "";

                            if (isset($Rs->ID)) {
                                $ORG = $Rs->ORGANIZACION;
                            }

                            $this->db->query("SET NAMES utf8;");

                            $data_logs = array(
                                'orgCode' => $ORG,
                                'numeroTransaccion' => trim($ArData[1]),
                                'origen' => trim($ArData[2]),
                                'sucursal' => trim($ArData[6]),
                                'importe' => doubleval($ArData[7]),
                                'fechaTransaccion' => str_replace("-", "", trim($ArData[9])),
                                'unidadNegocio' => trim($ArData[10]),
                                'numeroTicket' => trim($ArData[20]),
                                'idPaciente' => trim($ArData[23]),
                                "FECHA" => $this->fechas->fecha(2),
                                "HORA" => $this->fechas->fecha(3)
                            );
                            $this->db->insert('log_oracle', $data_logs);
                        }
                    }
                }
            }

            if ($ORIGEN != "") {
                $SQL = "UPDATE transaccion INNER JOIN log_oracle ON log_oracle.origen=transaccion.origenCobro AND ";
                $SQL .= " log_oracle.numeroTicket=transaccion.noTicket AND ";
                $SQL .= " log_oracle.orgCode=transaccion.organizationCode  ";
                $SQL .= " SET transaccion.EXISTE_OIC=1 ";
                $SQL .= " WHERE log_oracle.origen='" . $ORIGEN . "' AND transaccion.EXISTE_OIC=0 ";
                $this->db->query($SQL);

                $SQL = "UPDATE transaccion INNER JOIN log_oracle ON log_oracle.origen=transaccion.origenCobro AND ";
                $SQL .= " log_oracle.numeroTicket=transaccion.noTicket_Alterno AND ";
                $SQL .= " log_oracle.orgCode=transaccion.organizationCode  ";
                $SQL .= " SET transaccion.EXISTE_OIC=1 ";
                $SQL .= " WHERE log_oracle.origen='" . $ORIGEN . "' AND transaccion.EXISTE_OIC=0 AND transaccion.noTicket_Alterno<>'' ";
                $this->db->query($SQL);
            }


            //*******
            unlink($inputFileName);

            echo "ok";
        } else {
            echo "error";
        }
    }

    function TempArchivos() {
        if (!empty($this->session->userdata('_userid'))) {

            $dir = "./temp/";
            chdir($dir);
            array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);

            echo "<ul>";

            foreach ($files as $filename) {
                if ($filename != "index.html") {
                    echo "<li><a href='" . BASE_URL . "temp/" . $filename . "' target='_blank'>" . $filename . "</a></li>";
                }
            }

            echo "</ul>";
        }
    }

    function Ajax_UpdateCampos() {
        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->input->post("Id");
            $Tabla = $this->input->post("Tabla");

            $data["Info"] = $this->erpdb->InfoCampos($Id, $Tabla);
            $data["Fields"] = $this->db->field_data($Tabla);
            $data["_ID"] = $Id;
            $data["_TABLA"] = $Tabla;

            $this->load->view('logs/ajax_UpdateCampos', $data);
        }
    }

    function Ajax_UpdateCamposUpdate() {

        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->input->post("_ID");
            $Tabla = trim($this->input->post("_TABLA"));

            $Fields = $this->db->field_data($Tabla);

            foreach ($Fields as $field) {

                if ($field->name != "ID") {
                    $this->db->where('ID', $Id);
                    $this->db->update($Tabla, array($field->name => trim($this->input->post($field->name))));
                }
            }
        }
    }

    function Ajax_ActivarReproceso() {

        if (!empty($this->session->userdata('_userid'))) {

            $Id = trim($this->input->post("Id"));

            $data_trx = array(
                'ENVIADO' => 0,
                'PROCESADO' => 0,
                'ERROR' => 0,
                'WARNING' => 0,
                'PROCESADO_FECHA' => "",
                'PROCESADO_HORA' => "",
                'MESSAGE' => "",
                'JSON_RESPONSE' => ""
            );
            $this->db->where('ID', $Id);
            $this->db->update('transaccion', $data_trx);
        }
    }

    public function Homologacion() {

        if (!empty($this->session->userdata('_userid'))) {

            $data["menu"] = "logs";

            $this->load->view('header', $data);
            $this->load->view('logs/homologacion', $data);
            $this->load->view('footer', $data);
        } else {
            redirect(BASE_URL . "login");
        }
    }

    function Ajax_homologacion() {

        if (!empty($this->session->userdata('_userid'))) {

            $Tipo = $this->input->post("Tipo");

            $data["Lista"] = $this->erpdb->LogsProductos($Tipo);

            $this->load->view('logs/ajax_homologacion', $data);
        }
    }

    function Ajax_homologacionUp() {

        if (!empty($this->session->userdata('_userid'))) {

            $Id = $this->input->post("Id");
            $Erp = trim($this->input->post("Erp"));

            $data_erp = array(
                'IDACCESO' => $this->session->userdata('_userid'),
                'ERP' => $Erp,
                'FECHA' => $this->fechas->fecha(2),
                'HORA' => $this->fechas->fecha(3)
            );
            $this->db->where('ID', $Id);
            $this->db->update('log_productos', $data_erp);

            //Proceso para reactivar la transacción
            $RsInfo = $this->erpdb->LogsProductosInfo($Id);

            $RsProducto = $this->oracledb->OracleInfoProducto("", $Erp, 1);
            $PrimaryUnitOfMeasure = "";
            $SubinventoryCode = "";
            $subInventario = "";

            if (isset($RsProducto->ID)) {
                $subInventario = $RsProducto->Tipo;
                $PrimaryUnitOfMeasure = $RsProducto->PrimaryUnitOfMeasure;
                $SubinventoryCode = $RsProducto->SubinventoryCode;
            }

            $SQL = "UPDATE transaccion_items SET descripcionLinea='" . $Erp . "', ";
            $SQL .= " unidadMedida='" . $PrimaryUnitOfMeasure . "',subInventario='" . $subInventario . "',tipoDeTransaccion='" . $SubinventoryCode . "' ";
            $SQL .= " WHERE IDTRANSACCION>=182617 AND descripcionLinea='" . $RsInfo->descripcionLinea . "' ";
            $this->db->query($SQL);

            //Obtiene el listado de los productos a reprocesar
            $RsListado = $this->erpdb->LogsTrxHomologaError($Erp);
            foreach ($RsListado as $item) {

                $_ID = $item->ID;
                $_origenCobro = $item->origenCobro;
                $_organizationCode = $item->organizationCode;
                $_LocationId = $item->LocationId;
                $NuevoOrg = "";
                $CadOrg = "";
                $cadOrgMB = "";

                if ($_origenCobro == "MINDBODY") {

                    $RsOrg = $this->oracledb->OrgCodes($_LocationId);
                    foreach ($RsOrg as $org) {
                        $CadOrg .= "'" . $org->ORGANIZATIONCODE . "',";
                    }

                    $CadOrg = substr($CadOrg, 0, strlen($CadOrg) - 1);
                }

                //Verifica el contenido del Ticket para revisar que el producto/servicio contengan los datos de:
                //Unidad Medida, TipodeTransaccion, Servicio, ValueId
                $RsItems = $this->erpdb->transaccion_items($_ID);
                foreach ($RsItems as $item2) {

                    $descripcionLinea = $item2->descripcionLinea;

                    if ($_origenCobro == "VEND") {

                        $RsPrd = $this->oracledb->OracleInfoProducto(("'" . $_organizationCode . "'"), $descripcionLinea, 1);
                        foreach ($RsPrd as $item3) {

                            $TipoPrd = $item3->Tipo;
                            if ($TipoPrd == "Producto") {
                                $TipoPrd = "Productos";
                            }

                            $data_item = array(
                                'numeroArticulo' => $item3->ItemNumber,
                                'skuArticulo' => $item3->ItemNumber,
                                'unidadMedida' => $item3->PrimaryUnitOfMeasure,
                                'subInventario' => $TipoPrd,
                                'tipoDeTransaccion' => $item3->SubinventoryCode,
                            );
                            $this->db->where('ID', $item2->ID);
                            $this->db->update('transaccion_items', $data_item);
                        }

                        $urlOic = BASE_URL . "oracle/UpIdIntegra";
                        $RsPrdOic = $this->oracledb->OracleInfoProducto("", $descripcionLinea);
                        foreach ($RsPrdOic as $oic) {

                            $fields = array('Id' => $oic->ID, 'Org' => $oic->OrganizationCode, 'ItemNumber' => $oic->ItemNumber, 'Codigo' => $item2->_idtrx);
                            $fields_string = http_build_query($fields);
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $urlOic);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                            curl_exec($ch);
                            curl_close($ch);
                        }
                        
                        
                    } else if ($_origenCobro == "MINDBODY") {

                        $TipoPrd = "";
                        $skuArticulo = "";
                        $unidadMedida = "";
                        $tipoDeTransaccion = "";

                        $RsPrd = $this->oracledb->OracleInfoProducto($CadOrg, $descripcionLinea);
                        foreach ($RsPrd as $item3) {

                            $cadOrgMB .= $item3->OrganizationCode . "|";

                            $TipoPrd = $item3->Tipo;
                            if ($TipoPrd == "Producto") {
                                $TipoPrd = "Productos";
                            }

                            $skuArticulo = $item3->ItemNumber;
                            $unidadMedida = $item3->PrimaryUnitOfMeasure;
                            $tipoDeTransaccion = $item3->SubinventoryCode;
                            $NuevoOrg = $item3->OrganizationCode;
                        }

                        $data_item = array(
                            'numeroArticulo' => $skuArticulo,
                            'skuArticulo' => $skuArticulo,
                            'unidadMedida' => $unidadMedida,
                            'subInventario' => $TipoPrd,
                            'tipoDeTransaccion' => $tipoDeTransaccion
                        );
                        $this->db->where('ID', $item2->ID);
                        $this->db->update('transaccion_items', $data_item);
                    }
                }

                if ($_origenCobro == "MINDBODY") {
                    //Se actualiza el OrganizationCode
                    $this->db->where('ID', $_ID);
                    $this->db->update('transaccion', array("organizationCode" => $NuevoOrg, "cadOrgMB" => $cadOrgMB));
                }

                //Se ponen a reproceso las transacciones
                $data_Reprocesa = array(
                    "ENVIADO" => 0, "PROCESADO" => 0, "PROCESADO_FECHA" => '', "PROCESADO_HORA" => '',
                    "ERROR" => 0, "WARNING" => 0, "MESSAGE" => '', "JSON_RESPONSE" => ''
                );
                $this->db->where('ID', $_ID);
                $this->db->update('transaccion', $data_Reprocesa);
            }
        }
    }

    function SrvMBHomologa() {

        $SQL = "INSERT log_productos(origen,descripcionLinea) ";
        $SQL .= " SELECT 'MINDBODY',ti.descripcionLinea ";
        $SQL .= " FROM transaccion t INNER JOIN transaccion_items ti ON t.ID=ti.IDTRANSACCION ";
        $SQL .= " LEFT JOIN log_productos lp ON ti.descripcionLinea = lp.descripcionLinea ";
        $SQL .= " WHERE t.ERROR=1 AND t.origenCobro='MINDBODY' AND t.FECHA>='20230101' AND t.EXITOSO=0 AND ISNULL(lp.descripcionLinea) ";
        $SQL .= " GROUP BY ti.descripcionLinea ";
        $this->db->query($SQL);

        $SQL = "INSERT log_productos(origen,descripcionLinea,_idtrx) ";
        $SQL .= " SELECT 'VEND',ti.descripcionLinea,ti._idtrx ";
        $SQL .= " FROM transaccion t INNER JOIN transaccion_items ti ON t.ID=ti.IDTRANSACCION ";
        $SQL .= " LEFT JOIN log_productos lp ON ti.descripcionLinea = lp.descripcionLinea ";
        $SQL .= " WHERE t.ERROR=1 AND t.origenCobro='VEND' AND t.FECHA>='20230101' AND t.EXITOSO=0 AND ISNULL(lp.descripcionLinea) ";
        $SQL .= " AND ti.descripcionLinea<>'' ";
        $SQL .= " GROUP BY ti._idtrx ";
        $this->db->query($SQL);
    }

}
