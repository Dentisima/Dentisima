<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Reportes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();

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
            $data["menu"] = "reportes";

            $this->load->view('header', $data);
            $this->load->view('reportes/reportes', $data);
            $this->load->view('footer');
        } else {
            redirect(BASE_URL . "login");
        }
    }

    public function Ajax_reportes() {
        if (!empty($this->session->userdata('_userid'))) {

            $data["Listado"] = $this->reportesdb->Reportes();
            $this->load->view('reportes/ajax_reportes', $data);
        }
    }

    public function Ajax_reportes_info() {
        if (!empty($this->session->userdata('_userid'))) {
            $Id = $this->security->xss_clean($this->input->post("Id"));

            $Info = $this->reportesdb->ReportesInfo($Id);

            $data["Info"] = $Info;
            $data["Cron"] = $this->reportesdb->ReportesInfoCrob($Id);
            $data["Correos"] = $this->reportesdb->CorreosDestino();
            $data["Id"] = $Id;

            $this->load->view('reportes/ajax_reportes_info', $data);
        }
    }

    function Ajax_Tabla() {

        $Id = $this->security->xss_clean($this->input->post("Id"));
        $Nombre = $this->security->xss_clean($this->input->post("Nombre"));
        $Condicion = $this->security->xss_clean($this->input->post("Condicion"));

        $Rs = $this->reportesdb->ReportesInfo($Id);

        $SQL = "";
        if ($Condicion == "CONDICION1_TABLA") {
            $SQL = $Rs->CONDICION1_TABLA;
        }
        if ($Condicion == "CONDICION2_TABLA") {
            $SQL = $Rs->CONDICION2_TABLA;
        }
        if ($Condicion == "CONDICION3_TABLA") {
            $SQL = $Rs->CONDICION3_TABLA;
        }

        $SQL = str_replace("@IDEMPRESA", $this->session->userdata('_userconsul'), $SQL);

        $RsTabla = $this->db->query($SQL);
        $Lista = $RsTabla->result();

        $Result = "<select class='form-control' name='" . $Nombre . "' id='" . $Nombre . "'>";
        $Result .= "<option value=''>- Todos -</option>";
        foreach ($Lista as $item) {
            $Result .= "<option value='" . $item->CAMPO1 . "'>" . $item->CAMPO2 . "</option>";
        }

        $Result .= "</select>";

        echo $Result;
    }

    function ReportesExcel($Id = "", $Formato = "", $Fecha1 = "", $Fecha2 = "") {

        set_time_limit(0);

        ini_set('memory_limit', '2048M');

        $this->load->library("Excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $Filtro1 = "";
        $Filtro2 = "";
        $Filtro3 = "";

        if ($Id == "") {
            $Formato = $this->security->xss_clean($this->input->post("Formato"));
            $Id = $this->security->xss_clean($this->input->post("Id"));
            $Fecha1 = $this->fechas->FormateaFecha($this->security->xss_clean($this->input->post("startdate")), 2);
            $Fecha2 = $this->fechas->FormateaFecha($this->security->xss_clean($this->input->post("enddate")), 2);

            $Filtro1 = $this->security->xss_clean($this->input->post("filtro1"));
            $Filtro2 = $this->security->xss_clean($this->input->post("filtro2"));
            $Filtro3 = $this->security->xss_clean($this->input->post("filtro3"));
        } else {
            $Formato = $Formato;
            $Id = $Id;
            $Fecha1 = $Fecha1;
            $Fecha2 = $Fecha2;
        }

        $Rs = $this->reportesdb->ReportesInfo($Id);
        $TITULO = $Rs->REPORTE;
        $CRONJOB = $Rs->CRONJOB;

        if ($Rs->TITULO != "") {
            $TITULO = $Rs->TITULO;
        }

        $upload_path = "";

        $SUBQUERY = $Rs->SUBQUERY;
        $SUBRUTINA = $Rs->SUBRUTINA;
        $QUERY = $Rs->QUERY;
        $QUERY_TAB2 = $Rs->QUERY_TAB2;
        $CONDICION1 = $Rs->CONDICION1;
        $CONDICION1_AUX = $Rs->CONDICION1_AUX;
        $CONDICION2 = $Rs->CONDICION2;
        $CONDICION2_AUX = $Rs->CONDICION2_AUX;

        $CONDICION3 = $Rs->CONDICION3;
        $CONDICION3_AUX = $Rs->CONDICION3_AUX;

        $QUERY = str_replace("@Fecha1", $Fecha1, $QUERY);
        $QUERY = str_replace("@Fecha2", $Fecha2, $QUERY);

        $QUERY_TAB2 = str_replace("@Fecha1", $Fecha1, $QUERY_TAB2);
        $QUERY_TAB2 = str_replace("@Fecha2", $Fecha2, $QUERY_TAB2);

        $SUBQUERY = str_replace("@Fecha1", $Fecha1, $SUBQUERY);
        $SUBQUERY = str_replace("@Fecha2", $Fecha2, $SUBQUERY);

        if ($Filtro1 != "") {
            $CONDICION1 = str_replace("@Text1", $Filtro1, $CONDICION1);
            $QUERY = str_replace("@Condicion1", $CONDICION1, $QUERY);
            $QUERY_TAB2 = str_replace("@Condicion1", $CONDICION1, $QUERY_TAB2);

            $SUBQUERY = str_replace("@Condicion1", $CONDICION1, $SUBQUERY);
        } else {
            $QUERY = str_replace("@Condicion1", $CONDICION1_AUX, $QUERY);
            $QUERY_TAB2 = str_replace("@Condicion1", $CONDICION1_AUX, $QUERY_TAB2);

            $SUBQUERY = str_replace("@Condicion1", $CONDICION1_AUX, $SUBQUERY);
        }

        if ($Filtro2 != "") {
            $CONDICION2 = str_replace("@Text2", $Filtro2, $CONDICION2);

            $QUERY = str_replace("@Condicion2", $CONDICION2, $QUERY);
            $QUERY_TAB2 = str_replace("@Condicion2", $CONDICION2, $QUERY_TAB2);

            $SUBQUERY = str_replace("@Condicion2", $CONDICION2, $SUBQUERY);
        } else {
            $QUERY = str_replace("@Condicion2", $CONDICION2_AUX, $QUERY);
            $QUERY_TAB2 = str_replace("@Condicion2", $CONDICION2_AUX, $QUERY_TAB2);

            $SUBQUERY = str_replace("@Condicion2", $CONDICION2_AUX, $SUBQUERY);
        }

        if ($Filtro3 != "") {
            $CONDICION3 = str_replace("@Text3", $Filtro3, $CONDICION3);
            $QUERY = str_replace("@Condicion3", $CONDICION3, $QUERY);
            $QUERY_TAB2 = str_replace("@Condicion3", $CONDICION3, $QUERY_TAB2);

            $SUBQUERY = str_replace("@Condicion3", $CONDICION3, $SUBQUERY);
        } else {
            $QUERY = str_replace("@Condicion3", $CONDICION3_AUX, $QUERY);
            $QUERY_TAB2 = str_replace("@Condicion3", $CONDICION3_AUX, $QUERY_TAB2);

            $SUBQUERY = str_replace("@Condicion3", $CONDICION3_AUX, $SUBQUERY);
        }


        if ($SUBQUERY != "") {
            $ArSubQuery = explode(";", $SUBQUERY);
            for ($i = 0; $i < count($ArSubQuery) - 1; $i++) {
                $this->db->query($ArSubQuery[$i]);
            }
        }

        if ($SUBRUTINA != "") {
            eval($SUBRUTINA);
        }


        $ArF = array();

        $RsQuery = $this->db->query($QUERY . " LIMIT 1");

        $fields = $RsQuery->num_fields();

        foreach ($RsQuery->result_array() as $row) {
            foreach ($row as $key => $val) {
                $ArF[] = array("NAME" => $key, "SALDO" => 0);
            }
        }

        $Header = $ArF;
        $RsQuery2 = $this->db->query($QUERY);
        // echo $QUERY;

        if ($Formato == "xls") {

            $column = 0;
            for ($z = 0; $z < count($ArF); $z++) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $ArF[$z]["NAME"]);
                $column++;
            }

            $FilaCuenta = 2;

            foreach ($RsQuery2->result_array() as $row) {
                $x = 0;
                foreach ($row as $key => $val) {

                    $object->getActiveSheet()->setCellValueByColumnAndRow($x, $FilaCuenta, trim($val));

                    $x++;
                }
                $FilaCuenta++;
            }

            //**************************************************************************
            //**************************************************************************
            //Se agrega una pestaña adicional al excel

            if ($QUERY_TAB2 != "") {

                $myWorkSheet = new PHPExcel_Worksheet($object, 'Detalle de Transacciones');
                $object->addSheet($myWorkSheet, 1);
                $object->setActiveSheetIndex(1);

                $RsQuery = $this->db->query($QUERY_TAB2 . " LIMIT 1");

                $fields = $RsQuery->num_fields();
                $ArFTab = array();

                foreach ($RsQuery->result_array() as $row) {
                    foreach ($row as $key => $val) {
                        $ArFTab[] = array("NAME" => $key, "SALDO" => 0);
                    }
                }


                $RsQuery2 = $this->db->query($QUERY_TAB2);

                $column = 0;
                for ($z = 0; $z < count($ArFTab); $z++) {
                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $ArFTab[$z]["NAME"]);
                    $column++;
                }

                $FilaCuenta = 2;

                foreach ($RsQuery2->result_array() as $row) {
                    $x = 0;
                    foreach ($row as $key => $val) {

                        $object->getActiveSheet()->setCellValueByColumnAndRow($x, $FilaCuenta, trim($val));

                        $x++;
                    }
                    $FilaCuenta++;
                }
            }



            if ($CRONJOB == "Si") {
                $upload_path = "./temp/";

                if (!file_exists($upload_path)) {
                    mkdir($upload_path, 0775, true);
                    $arcindex = fopen($upload_path . "index.html", "a");
                    fwrite($arcindex, "<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>");
                    fclose($arcindex);
                }
            }

            //**************************************************************************
            //**************************************************************************

            $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');

            $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
            $cacheSettings = array(' memoryCacheSize ' => '50MB');
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

            if ($CRONJOB == "Si") {

                $RsCron = $this->reportesdb->ReportesInfoCrob($Id);

                if ($RsCron->IDSREPORTES == "") {
                    $object_writer->save($upload_path . $TITULO . ".xls");
                }


                //****Se envia correo con el documento generado ****************
                $Correos = explode(",", $RsCron->CORREOS);
                $ArCorreos = array();
                for ($ic = 0; $ic < count($Correos); $ic++) {

                    if (trim($Correos[$ic]) != "") {
                        $ArCorreos[] = array("Correo" => trim($Correos[$ic]));
                    }
                }

                $this->email->from("noreply@reinamadre.mx", "{GRM} - Integraciones");
                $this->email->to(trim($Correos[0]));

                $correosAlternos = "";
                for ($ic = 0; $ic < count($Correos); $ic++) {
                    if ($ic >= 1) {
                        if (trim($Correos[$ic]) != "") {
                            $correosAlternos .= $Correos[$ic] . ",";
                            //$this->email->cc(trim($Correos[$ic]));
                        }
                    }
                }

                if ($correosAlternos != "") {
                    $this->email->cc($correosAlternos);
                }

                /* for ($ic = 1; $ic < count($ArCorreos); $ic++) {
                  $this->email->cc($ArCorreos[$ic]["Correo"]);
                  } */

                $Body = "<center>" . $TITULO . "<br><br>";
                $Body .= "<p style='font-size:11px; color:#006699'>";
                $Body .= "El presente mensaje es confidencial, dirigido &uacute;nicamente para el destinatario. ";
                $Body .= "Si usted no es el destinatario, no deber&aacute; copiarlo, revelarlo o distribuirlo. ";
                $Body .= "Cualquier acci&oacute;n realizada en este sentido, ser&aacute; ilegal. Si por error recibe el presente mensaje, ";
                $Body .= "por favor notifique al remitente.</p>";

                $this->email->subject($TITULO);
                $this->email->message($Body);

                if (count($Correos) > 0) {
                    if ($RsCron->IDSREPORTES != "") {

                        $RsListaReportes = $this->reportesdb->ReportesInfoLista($RsCron->IDSREPORTES);
                        foreach ($RsListaReportes as $itemRep) {

                            $_TITULO = $itemRep->REPORTE;
                            if ($itemRep->TITULO != "") {
                                $_TITULO = $itemRep->TITULO;
                            }
                            if (file_exists($upload_path . $_TITULO . ".xls")) {
                                $this->email->attach($upload_path . $_TITULO . ".xls");
                            }
                        }
                    } else {
                        $this->email->attach($upload_path . $TITULO . ".xls");
                    }
                }



                $this->email->send();
                //**************************************************************
                if (count($Correos) > 0) {

                    if (file_exists($upload_path . $TITULO . ".xls")) {
                        //  unlink($upload_path . $TITULO . ".xls");
                    }

                    if ($RsCron->IDSREPORTES != "") {

                        $RsListaReportes = $this->reportesdb->ReportesInfoLista($RsCron->IDSREPORTES);
                        foreach ($RsListaReportes as $itemRep) {

                            $_TITULO = $itemRep->REPORTE;
                            if ($itemRep->TITULO != "") {
                                $_TITULO = $itemRep->TITULO;
                            }

                            if (file_exists($upload_path . $_TITULO . ".xls")) {
                                  unlink($upload_path . $_TITULO . ".xls");
                            }
                        }
                    }
                }
            } else {
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="' . $TITULO . '.xls"');
                $object_writer->save('php://output');
            }


            exit;
        }

        $data["Header"] = $Header;
        $data["Rs"] = $RsQuery2;
        $data["TITULO"] = $TITULO;

        $this->load->view('reportes/Html', $data);
    }

    public function AjaxActualizaCron() {

        if (!empty($this->session->userdata('_userid'))) {


            $Id = $this->security->xss_clean($this->input->post("Id"));
            $IdReporte = $this->security->xss_clean($this->input->post("IdReporte"));
            $TITULO = $this->security->xss_clean($this->input->post("TITULO"));
            $MINUTO = $this->security->xss_clean($this->input->post("MINUTO"));
            $HORA = $this->security->xss_clean($this->input->post("HORA"));
            $DIA = $this->security->xss_clean($this->input->post("DIA"));
            $MES = $this->security->xss_clean($this->input->post("MES"));
            $CORREOS = trim($this->input->post("CORREOS"));
            $ACTIVO = trim($this->input->post("ACTIVO"));
            $IDSREPORTES = trim($this->input->post("IDSREPORTES"));
            $FECHA1 = $this->fechas->FormateaFecha($this->security->xss_clean($this->input->post("FECHA1")), 2);
            $FECHA2 = $this->fechas->FormateaFecha($this->security->xss_clean($this->input->post("FECHA2")), 2);

            $data_0 = array(
                'MINUTO' => $MINUTO,
                'HORA' => $HORA,
                'DIA' => $DIA,
                'MES' => $MES,
                'CORREOS' => $CORREOS,
                'ACTIVO' => $ACTIVO,
                'FECHA1' => $FECHA1,
                'FECHA2' => $FECHA2,
                'IDSREPORTES' => $IDSREPORTES
            );

            $this->db->where('ID', $Id);
            $this->db->update('reportes_cronjob', $data_0);

            $this->db->where('ID', $IdReporte);
            $this->db->update('reportes', array("TITULO" => $TITULO));
        }
    }

    //Reportes
    function ViewComisiones() {

        $SQL = "DROP VIEW Comisiones;";
        $this->db->query($SQL);

        $SQL = "CREATE VIEW Comisiones AS ";
        $SQL .= " SELECT  t.noTicket AS 'NoTicket', ";
        $SQL .= " ti.descripcionLinea AS 'Servicio',t.fechaTransaccion AS 'FechaCobro',";
        $SQL .= " (SELECT ml.Name FROM mindbody_locations ml WHERE ml.idLocation=ti.LocationId) AS 'Sucursal', ";
        $SQL .= " t.idPaciente,ti.cantidadesFacturar AS 'Cantidad', ";
        $SQL .= " ti.precio AS 'Cobro' ";
        $SQL .= " FROM transaccion t INNER JOIN transaccion_items ti ON t.ID=ti.IDTRANSACCION INNER JOIN transaccion_payments tp ";
        $SQL .= " ON t.ID=tp.IDTRANSACCION WHERE  ";
        $SQL .= " t.FECHA>='20230101' ";
        $SQL .= " AND t.origenCobro='MINDBODY' ";
        $this->db->query($SQL);
    }

    function Test() {

        $this->load->library("Excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "ABC");

        // $object->createSheet();
        $myWorkSheet = new PHPExcel_Worksheet($object, 'Detalle de Transacciones');
        $object->addSheet($myWorkSheet, 1);
        $object->setActiveSheetIndex(1);
        $object->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "Detalle");

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');

        $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
        $cacheSettings = array(' memoryCacheSize ' => '50MB');
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="xxx.xls"');
        $object_writer->save('php://output');
    }

    //**************************************************************************
    function CronJobs() {

        $DIA = date("d");
        $MES = date("m");
        $ANIO = date("Y");
        $HORA = date("H");
        $MINUTO = date("i");

        //
        $Rs = $this->reportesdb->ListadoCronJobs();
        foreach ($Rs as $item) {

            $ActivaCronMin = 0;
            $ActivaCronHora = 0;
            $ActivaCronDia = 0;
            $ActivaCronMes = 0;
            //**********************************
            $ArMinuto = explode(",", $item->MINUTO);

            if ($item->MINUTO == "*") {
                $ActivaCronMin = 1;
            } else {

                for ($i = 0; $i < count($ArMinuto); $i++) {
                    if ($ArMinuto[$i] == $MINUTO) {
                        $ActivaCronMin = 1;
                    }
                }
            }
            //**********************************
            //**********************************
            $ArHora = explode(",", $item->HORA);
            if ($item->HORA == "Cada Hora") {
                $ActivaCronHora = 1;
            } else {
                for ($i = 0; $i < count($ArHora); $i++) {
                    if ($ArHora[$i] == $HORA) {
                        $ActivaCronHora = 1;
                    }
                }
            }
            //**********************************
            //**********************************
            $ArDia = explode(",", $item->DIA);
            if ($item->DIA == "Todos") {
                $ActivaCronDia = 1;
            } else {

                for ($i = 0; $i < count($ArDia); $i++) {
                    if ($ArDia[$i] == $DIA) {
                        $ActivaCronDia = 1;
                    }
                }
            }
            //**********************************
            //**********************************
            $ArMes = explode(",", $item->MES);
            if ($item->MES == "Todos") {
                $ActivaCronMes = 1;
            } else {

                for ($i = 0; $i < count($ArMes); $i++) {
                    if ($ArMes[$i] == $MES) {
                        $ActivaCronMes = 1;
                    }
                }
            }
            //**********************************
            if ($ActivaCronMin == 1 && $ActivaCronHora == 1 && $ActivaCronDia == 1 && $ActivaCronMes == 1) {
                $this->ReportesExcel($item->IDREPORTE, "xls", $item->FECHA1, $item->FECHA2);
            }
        }
    }

}
