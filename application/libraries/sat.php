<?php

class Sat {

    function xml_3_2($InfoSat, $Venta, $Detalle, $Pagos, $decimales_precio, $decimales_cantidad) {

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" ';
        $xml .= 'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ';
        $xml .= 'xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd" ';
        $xml .= 'version="3.2" ';
        if ($Venta->SERIE != "" || $Venta->FOLIO != "") {
            $xml .= 'serie="' . $Venta->SERIE . '" ';
            $xml .= 'folio="' . $Venta->FOLIO . '" ';
        }

        $xml .= 'fecha="' . $Venta->FECHASAT . 'T' . $Venta->HORA . '" ';
        $xml .= 'tipoDeComprobante="ingreso" ';



        $formaDePago = "Pago en una sola exhibicion";
        if ($Venta->PLAZO > 0) {
            $formaDePago = "Pago en Parcialidades";
        }
        $xml .= 'formaDePago="' . $formaDePago . '" ';

        $xml .= 'subTotal="' . number_format($Venta->SUBTOTAL, $decimales_precio, '.', '') . '" ';
        $xml .= 'TipoCambio="' . number_format($Venta->TIPOCAMBIO, 4, '.', '') . '" ';
        $xml .= 'Moneda="' . $Venta->MONEDA . '" ';
        $xml .= 'total="' . number_format($Venta->TOTAL, $decimales_precio, '.', '') . '" ';


        $metodoDePago = "";
        $NumCtaPago = "";
        foreach ($Pagos as $item) {
            
            if($item->CODIGO_SAT!=""){
                $metodoDePago .= $item->CODIGO_SAT . ",";
            } 
            
            if($item->NUMCUENTA!=""){
                $NumCtaPago .= $item->NUMCUENTA . ",";
            }
            
        }
        
        if($metodoDePago!=""){
            $metodoDePago = substr($metodoDePago,0,strlen($metodoDePago)-1);
        }
        if($NumCtaPago!=""){
            $NumCtaPago = substr($NumCtaPago,0,strlen($NumCtaPago)-1);
        }

        if ($metodoDePago == "") {
            $metodoDePago = "99";
        }
        if ($NumCtaPago == "") {
            $NumCtaPago = "0000";
        }
        

        $xml .= 'metodoDePago="' . $metodoDePago . '" ';
        $xml .= 'LugarExpedicion="' . $InfoSat->ESTADOE . ',' . $InfoSat->PAISE . '" ';
        $xml .= 'NumCtaPago="' . $NumCtaPago . '" ';

        $xml .= 'noCertificado="' . $InfoSat->NCERTIFICADO . '" ';
        $xml .= 'sello=":sello:" ';
        $xml .= 'certificado=":certificado:">';

        
        //Datos de emisor
        $xml .= '<cfdi:Emisor rfc="' . $InfoSat->RFC . '" nombre="' . $InfoSat->RAZON . '">';
        $xml .= '<cfdi:DomicilioFiscal calle="' . str_replace("  "," ",$InfoSat->CALLE) . '" ';
        $xml .= 'noExterior="0" ';
        $xml .= 'colonia="' . str_replace("  "," ",$InfoSat->COLONIA) . '" ';
        $xml .= 'municipio="' . str_replace("  "," ",$InfoSat->MUNICIPIO) . '" ';
        $xml .= 'estado="' . str_replace("  "," ",$InfoSat->ESTADOE) . '" ';
        $xml .= 'pais="' . $InfoSat->PAISE . '" ';
        $xml .= 'codigoPostal="' . str_replace("  "," ",$InfoSat->CODIGO) . '"/>';
        $xml .= '<cfdi:ExpedidoEn calle="' . str_replace("  "," ",$InfoSat->CALLE) . '" pais="' . $InfoSat->PAISE . '" codigoPostal="' . str_replace("  "," ",$InfoSat->CODIGO) . '"/>';
        $xml .= '<cfdi:RegimenFiscal Regimen="' . str_replace("  "," ",$InfoSat->REGIMEN) . '"/>';
        $xml .= '</cfdi:Emisor>';

        //Datos de receptor
        $xml .= '<cfdi:Receptor rfc="' . str_replace("  "," ",$Venta->RFC) . '" nombre="' . str_replace("  "," ",$Venta->RAZON) . '">';
        $xml .= '<cfdi:Domicilio calle="' . str_replace("  "," ",$Venta->R_DOMICILIO) . '" ';
        $xml .= 'noExterior="0" ';
        $xml .= 'colonia="' . str_replace("  "," ",$Venta->R_COLONIA)  . '" ';
        $xml .= 'municipio="' . str_replace("  "," ",$Venta->R_CIUDAD) . '" ';
        $xml .= 'estado="' . str_replace("  "," ",$Venta->ESTADOR)  . '" ';
        $xml .= 'pais="' . str_replace("  "," ",$Venta->PAISR)  . '" ';
        $xml .= 'codigoPostal="' . str_replace("  "," ",$Venta->R_CODIGO)  . '"/>';
        $xml .= '</cfdi:Receptor>';

        $Cadena = '||3.2|' . $Venta->FECHASAT . 'T' . $Venta->HORA . '|ingreso|' . $formaDePago . '|';
        $Cadena .= number_format($Venta->SUBTOTAL, $decimales_precio, '.', '') . '|' . number_format($Venta->TIPOCAMBIO, 4, '.', '') . '|' . $Venta->MONEDA . '|';
        $Cadena .= number_format($Venta->TOTAL, $decimales_precio, '.', '') . '|' . $metodoDePago . '|' . $InfoSat->ESTADOE . ',' . str_replace("  "," ",$InfoSat->PAISE) . '|' . $NumCtaPago . '|';
        $Cadena .= $InfoSat->RFC . '|' . str_replace("  "," ",$InfoSat->RAZON). '|' . str_replace("  "," ",$InfoSat->CALLE) . '|0|' . str_replace("  "," ",$InfoSat->COLONIA) . '|' . str_replace("  "," ",$InfoSat->MUNICIPIO) . '|' . str_replace("  "," ",$InfoSat->ESTADOE) . '|';
        $Cadena .= $InfoSat->PAISE . '|' . str_replace("  "," ",$InfoSat->CODIGO) . '|';
        $Cadena .= str_replace("  "," ",$InfoSat->CALLE). '|' . str_replace("  "," ",$InfoSat->PAISE) . '|' . str_replace("  "," ",$InfoSat->CODIGO) . '|' . str_replace("  "," ",$InfoSat->REGIMEN) . '|';
        $Cadena .= $Venta->RFC . '|' . str_replace("  "," ",$Venta->RAZON) . '|' . str_replace("  "," ",$Venta->R_DOMICILIO) . '|0|' . str_replace("  "," ",$Venta->R_COLONIA) . '|' . str_replace("  "," ",$Venta->R_CIUDAD) . '|' . str_replace("  "," ",$Venta->ESTADOR) . '|';
        $Cadena .= str_replace("  "," ",$Venta->PAISR) . '|' . str_replace("  "," ",$Venta->R_CODIGO) . '|';

        //Detalle de partidas
        $xml .= '<cfdi:Conceptos>';
        foreach ($Detalle as $item) {
            $xml .= '<cfdi:Concepto cantidad="' . number_format($item->CANTIDAD, $decimales_cantidad, '.', '') . '" unidad="' . $item->UNIDAD . '" descripcion="' . trim($item->DESCRIPCION) . '" valorUnitario="' . number_format($item->PRECIO, $decimales_precio, '.', '') . '" importe="' . number_format($item->IMPORTE, $decimales_precio, '.', '') . '"/>';
            $Cadena .= number_format($item->CANTIDAD, $decimales_cantidad, '.', '') . '|' . $item->UNIDAD . '|' . str_replace("  "," ",trim($item->DESCRIPCION)) . '|' . number_format($item->PRECIO, $decimales_precio, '.', '') . '|' . number_format($item->IMPORTE, $decimales_precio, '.', '') . '|';
        }

        $xml .= '</cfdi:Conceptos>';

        $xml .= '<cfdi:Impuestos totalImpuestosRetenidos="0.00" totalImpuestosTrasladados="' . number_format($Venta->IMP_IMPUESTO1, $decimales_precio, '.', '') . '">';
        $xml .= '<cfdi:Retenciones>';
        $xml .= '<cfdi:Retencion impuesto="IVA" importe="0.00"/>';
        $xml .= '</cfdi:Retenciones>';
        $xml .= '<cfdi:Traslados>';
        $xml .= '<cfdi:Traslado impuesto="IVA" tasa="' . number_format($Venta->IMPUESTO1, 2, '.', '') . '" importe="' . number_format($Venta->IMP_IMPUESTO1, $decimales_precio, '.', '') . '"/>';
        $xml .= '</cfdi:Traslados></cfdi:Impuestos></cfdi:Comprobante>';

        $Cadena .= 'IVA|0.00|0.00|IVA|' . number_format($Venta->IMPUESTO1, 2, '.', '') . '|' . number_format($Venta->IMP_IMPUESTO1, $decimales_precio, '.', '') . '|' . number_format($Venta->IMP_IMPUESTO1, $decimales_precio, '.', '') . '||';

        $ArRes[0] = $Cadena;
        $ArRes[1] = $xml;

        return $ArRes;
    }

    function getPrivateKey($IdEmpresa,$key_path, $password) {

        $cmd = 'openssl pkcs8 -inform DER -in ./negocios/' . $IdEmpresa . '/' . $key_path . ' -passin pass:' . $password;
        if ($result = shell_exec($cmd)) {
            unset($cmd);

            return $result;
        }
        return false;
    }

    function signData($key, $data) {

        $pkeyid = openssl_get_privatekey($key);

        // On 2011 Signing algorythm changes from MD5 to SHA1 (Thanks to eDwaRd for the reminder)
        if (openssl_sign($data, $cryptedata, $pkeyid, OPENSSL_ALGO_SHA256)) {

            openssl_free_key($pkeyid);

            return base64_encode($cryptedata);
        }
    }

    function getCertificate($IdEmpresa,$cer_path, $to_string = true) {
        $cmd = 'openssl x509 -inform DER -outform PEM -in ./negocios/' . $IdEmpresa . '/' . $cer_path . ' -pubkey';
        if ($result = shell_exec($cmd)) {
            unset($cmd);

            if ($to_string) {

                return $result;
            }

            $split = preg_split('/\n(-*(BEGIN|END)\sCERTIFICATE-*\n)/', $result);
            unset($result);

            return preg_replace('/\n/', '', $split[1]);
        }

        return false;
    }

}
