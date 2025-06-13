<?php

class Fechas {

    function fecha($fecha) {


        switch ($fecha) {

            case 1://Fecha en formato dd/mm/YYYY
                $strRegreso = date("d") . "/" . date("m") . "/" . date("Y");
                break;
            case 2://Fecha en formato ddmmYYYY
                $strRegreso = date("Y") . date("m") . date("d");
                break;
            case 3://Devuelve la hora en formato hh:mm:ss
                $strRegreso = date("H") . ":" . date("i") . ":" . date("s");
                break;
            case 4://Fecha en formato YYYY-mm-dd
                $strRegreso = date("Y") . "-". date("m") ."-". date("d");
                break;
            
            case 5://Fecha en formato YYYY-mm-dd
                $strRegreso = date("m") . "/". date("d") ."/". date("Y");
                break;
            
            case 6://Fecha en formato dd-mm-YYYY
                $strRegreso = date("d") . "-" . date("m") . "-" . date("Y");
                break;
            
            case 7://Fecha en formato YYYY-mm-dd
                $strRegreso = date("m") . "-". date("d") ."-". date("Y");
                break;
        }
        return $strRegreso;
    }

    function FormateaFecha($fecha, $tipo) {

        $ArMes[1] = "Enero";
        $ArMes[2] = "Febrero";
        $ArMes[3] = "Marzo";
        $ArMes[4] = "Abril";
        $ArMes[5] = "Mayo";
        $ArMes[6] = "Junio";
        $ArMes[7] = "Julio";
        $ArMes[8] = "Agosto";
        $ArMes[9] = "Septiembre";
        $ArMes[10] = "Octubre";
        $ArMes[11] = "Noviembre";
        $ArMes[12] = "Diciembre";
        if ($fecha != "") {

            switch ($tipo) {
                case 1:
                    $ANIO = substr($fecha, 0, 4);
                    $MES = substr($fecha, 4, 2);
                    $DIA = substr($fecha, 6, 2);

                    $fecha = $ArMes[intval($MES)] . " " . $DIA . ", " . $ANIO;

                    break;
                case 2:

                    $ANIO = substr($fecha, 6, 4);
                    $MES = substr($fecha, 3, 2);
                    $DIA = substr($fecha, 0, 2);

                    $fecha = $ANIO . $MES . $DIA;

                    break;

                case 3:

                    $ANIO = substr($fecha, 0, 4);
                    $MES = substr($fecha, 4, 2);
                    $DIA = substr($fecha, 6, 2);

                    $fecha = $DIA . "/" . $MES . "/" . $ANIO;

                    break;

                case 4:

                    $ANIO = substr($fecha, 6, 4);
                    $MES = substr($fecha, 3, 2);
                    $DIA = substr($fecha, 0, 2);

                    $fecha = $ANIO . $MES . $DIA;

                    break;
                case 5:

                    $ANIO = substr($fecha, 6, 4);
                    $MES = substr($fecha, 0, 2);
                    $DIA = substr($fecha, 3, 2);

                    $fecha = $ANIO . $MES . $DIA;

                    break;
                case 6:
                    $ANIO = substr($fecha, 0, 4);
                    $MES = substr($fecha, 4, 2);
                    $DIA = substr($fecha, 6, 2);

                    $fecha = $ANIO . "-" . $MES . "-" . $DIA;

                    break;
                case 7:

                    $ANIO = substr($fecha, 6, 4);
                    $MES = substr($fecha, 0, 2);
                    $DIA = substr($fecha, 3, 2);

                    $fecha = $ANIO . $MES . $DIA;

                    break;
                case 8:

                    $ANIO = substr($fecha, 0, 4);
                    $MES = substr($fecha, 4, 2);
                    $DIA = substr($fecha, 6, 2);

                    $fecha = $MES . "/" . $DIA . "/" . $ANIO;

                    break;
                case 9:
                    $ANIO = substr($fecha, 0, 4);
                    $MES = substr($fecha, 4, 2);
                    $DIA = substr($fecha, 6, 2);

                    $fecha = $DIA . " " . $ArMes[intval($MES)] . " " . $ANIO;

                    break;
                case 10:
                    
                    $fecha =  str_replace("-","",$fecha);
                    
                    $ANIO = substr($fecha, 0, 4);
                    $MES = substr($fecha, 4, 2);
                    $DIA = substr($fecha, 6, 2);

                    $fecha = $DIA . " " . $ArMes[intval($MES)] . " " . $ANIO;

                    break;
                case 11:
                    
                    $fecha =  str_replace("-","",$fecha);
                    
                    $ANIO = substr($fecha, 0, 4);
                    $MES = substr($fecha, 4, 2);
                    $DIA = substr($fecha, 6, 2);

                    $fecha = $MES."/".$DIA ."/" . $ANIO;

                    break;
                case 12:

                    $ANIO = substr($fecha, 6, 4);
                    $MES = substr($fecha, 3, 2);
                    $DIA = substr($fecha, 0, 2);

                    $fecha = $ANIO ."-". $MES ."-" . $DIA;

                    break;
                
                case 13:

                    $ANIO = substr($fecha, 6, 4);
                    $MES = substr($fecha, 3, 2);
                    $DIA = substr($fecha, 0, 2);

                    $fecha = $MES ."-". $DIA."-".$ANIO;

                    break;
            }
        }

        return $fecha;
    }

    function MesTxt($Mes) {

        if ($Mes == "") {
            $Mes = 0;
        }

        $ArMes[1] = "Enero";
        $ArMes[2] = "Febrero";
        $ArMes[3] = "Marzo";
        $ArMes[4] = "Abril";
        $ArMes[5] = "Mayo";
        $ArMes[6] = "Junio";
        $ArMes[7] = "Julio";
        $ArMes[8] = "Agosto";
        $ArMes[9] = "Septiembre";
        $ArMes[10] = "Octubre";
        $ArMes[11] = "Noviembre";
        $ArMes[12] = "Diciembre";

        return $ArMes[intval($Mes)];
    }
    
    function MesNumero($Mes) { 

        if($Mes=="January"){
            $Mes = "01";
        } 
        if($Mes=="February"){
            $Mes = "02";
        } 
        if($Mes=="March"){
            $Mes = "03";
        } 
        if($Mes=="April"){
            $Mes = "04";
        } 
        if($Mes=="May"){
            $Mes = "05";
        } 
        if($Mes=="June"){
            $Mes = "06";
        } 
        if($Mes=="July"){
            $Mes = "07";
        } 
        if($Mes=="August"){
            $Mes = "08";
        } 
        if($Mes=="September"){
            $Mes = "09";
        } 
        if($Mes=="October"){
            $Mes = "10";
        } 
        if($Mes=="November"){
            $Mes = "11";
        } 
        if($Mes=="December"){
            $Mes = "12";
        } 

        return $Mes;
    }

    function Edad($fecha) {
        
        $ArFecha = explode("-", $fecha);
        $Y = $ArFecha[0];
        $m = $ArFecha[1];
        $d = $ArFecha[2];
        
        return( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
    }

    function RegresaFecha($DIAS, $Fecha2 = "") {

        if ($Fecha2 == "") {

            $fecha = date("d") . "/" . date("m") . "/" . date("Y");
        } else {

            $ano1 = substr($Fecha2, 0, 4);
            $mes1 = substr($Fecha2, 4, 2);
            $dia1 = substr($Fecha2, 6, 2);

            $fecha = $dia1 . "/" . $mes1 . "/" . $ano1;
        }

        $ndias = $DIAS;

        if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $fecha))
            list($dia, $mes, $anio1) = explode("/", $fecha);

        if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/", $fecha))
            list($dia, $mes, $anio1) = explode("-", $fecha);

        $nueva = mktime(0, 0, 0, $mes, $dia, $anio1) + $ndias * 24 * 60 * 60;
        $nuevafecha = date("d-m-Y", $nueva);

        $DIA = substr($nuevafecha, 0, 2);
        $MES = substr($nuevafecha, 3, 2);
        $ANIO = substr($nuevafecha, 6, 4);

        return ($DIA . "/" . $MES . "/" . $ANIO);
    }

    function saber_dia($nombredia) { //'2018-09-01'
        
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado','Domingo');
        $fecha = $dias[date('N', strtotime($nombredia))];
        return $fecha;
        
    }

}
