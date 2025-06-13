<?php

class Funciones {

    function AgregaCeros($CADENA_ORIGINAL, $POSICION, $TIPO, $TOTAL) {

        $LONGITUD = strlen(trim($CADENA_ORIGINAL));
        $DIFERENCIA = $TOTAL - $LONGITUD;
        $CAD_CEROS = "";
        $CADENA = "";

        switch ($TIPO) {
            case 0:
                for ($i = 1; $i <= $DIFERENCIA; $i++) {
                    $CAD_CEROS .= "0";
                }
                break;
            case 1:
                for ($i = 1; $i <= $DIFERENCIA; $i++) {
                    $CAD_CEROS .= " ";
                }
                break;
        }

        switch ($POSICION) {
            case 0://Posicion a la izquierda
                $CADENA = $CAD_CEROS . $CADENA_ORIGINAL;
                break;
            case 1://Posicion a la derecha
                $CADENA = $CADENA_ORIGINAL . $CAD_CEROS;
                break;
        }

        return $CADENA;
    }

    function Aleatorio($long = 20, $letras_min = true, $letras_max = true, $num = true) {

        $salt = $letras_min ? 'abchefghknpqrstuvwxyz' : '';
        $salt .= $letras_max ? 'ACDEFHKNPRSTUVWXYZ' : '';
        $salt .= $num ? (strlen($salt) ? '2345679' : '0123456789') : '';


        if (strlen($salt) == 0) {
            return '';
        }

        $i = 0;
        $str = '';
        srand((double) microtime() * 1000000);
        while ($i < $long) {
            $num = rand(0, strlen($salt) - 1);
            $str .= substr($salt, $num, 1);
            $i++;
        }

        return $str;
    }

    function Encripta($strUrl) {
        return strtr(base64_encode($strUrl), '+/=', '-_,');
    }

    function DesEncripta($strUrl) {
        return base64_decode(strtr($strUrl, '-_,', '+/='));
    }

    function paypal($correo, $amount, $description, $invoice, $moneda, $urlReturnAcepted, $urlReturnCancel) {

        $target = "https://www.paypal.com/xclick";
        $amount = sprintf("%.02f", $amount);
        $params = "business=$correo&item_name=$description&item_number=$invoice&amount=$amount&currency_code=$moneda&return=$urlReturnAcepted&cancel_return=$urlReturnCancel";
        $params = str_replace(" ", "%20", $params);
        header("Location: $target/$params");
    }

    function encrypt($string, $key) {

        $result = '';
        if ($string != "") {
            for ($i = 0; $i < strlen($string); $i++) {
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key)) - 1, 1);
                $char = chr(ord($char) + ord($keychar));
                $result.=$char;
            }
        }
        return base64_encode($result);
    }

    function decrypt($string, $key) {
        $result = '';

        if ($string != "") {

            $string = base64_decode($string);
            for ($i = 0; $i < strlen($string); $i++) {
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key)) - 1, 1);
                $char = chr(ord($char) - ord($keychar));
                $result.=$char;
            }
        }
        return $result;
    }

    function CortaCadena($CADENA_ORIGINAL, $TOTAL) {

        $LONGITUD = strlen(trim($CADENA_ORIGINAL));
        $LINEAS = 0;
        $ArCadena = array();

        if ($TOTAL > $LONGITUD) {
            $ArCadena[] = array("CADENA" => $CADENA_ORIGINAL);
        } else {

            $LINEAS = $LONGITUD / $TOTAL;
            $LINEAS2 = round($LINEAS);

            #Si hay diferencia por decimales se suma una linea mas
            if ($LINEAS != $LINEAS2) {
                $LINEAS2 = $LINEAS2 + 1;
            }

            $ORIGEN = 0;
            $TERMINO = $TOTAL;

            for ($i = 1; $i <= $LINEAS2; $i++) {

                $ArCadena[] = array("CADENA" => trim(substr($CADENA_ORIGINAL, $ORIGEN, $TOTAL)));

                $ORIGEN = $TERMINO;
                $TERMINO = $TERMINO + $TOTAL;
            }
        }

        return $ArCadena;
    }

    function SeparaCadena($CADENA_ORIGINAL, $TOTAL, $FILAS) {

        $CADENA_ORIGINAL .= " ";
        $LONGITUD = strlen($CADENA_ORIGINAL) - 1;
        $ArCadena = array();
        $NUEVA = "";
        $Cont = 0;
        $Rows = 0;

        if ($TOTAL > $LONGITUD) {
            $ArCadena[] = array("CADENA" => $CADENA_ORIGINAL);
        } else {

            for ($a = 0; $a <= $LONGITUD; $a++) {

                $Cont++;

                $NUEVA .= $CADENA_ORIGINAL[$a];

                if ($Cont == $TOTAL || $a == $LONGITUD) {
                    $Rows++;
                    $ArCadena[] = array("CADENA" => $NUEVA . "<br>");
                    $NUEVA = "";
                    $Cont = 0;

                    if ($Rows == $FILAS) {
                        break;
                    }
                }
            }
        }

        return $ArCadena;
    }

    function ObtenerIp() {

        //http://ip-api.com/xml/189.210.78.36
    }

    function ReemplazarComillas($Valor) {

        $invalid_name = array("'");

        $Valor = str_replace($invalid_name, "´", $Valor);

        return $Valor;
    }

    function eliminar_acentos($cadena) {

        //Reemplazamos la A y a
        $cadena = str_replace(array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'), array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'), $cadena);

        //Reemplazamos la E y e
        $cadena = str_replace(array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'), array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'), $cadena);

        //Reemplazamos la I y i
        $cadena = str_replace(array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'), array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'), $cadena);

        //Reemplazamos la O y o
        $cadena = str_replace(array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'), array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'), $cadena);

        //Reemplazamos la U y u
        $cadena = str_replace(array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'), array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'), $cadena);

        //Reemplazamos la N, n, C y c
        //$cadena = str_replace(array('Ñ', 'ñ', 'Ç', 'ç'), array('N', 'n', 'C', 'c'), $cadena);
        $cadena = str_replace(array('Ç', 'ç'), array('C', 'c'), $cadena);

        return $cadena; 
    }

}
