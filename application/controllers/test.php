<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->model("testdb");
        $this->load->library('fechas');
    }

    function Trx() {

        $Rs = $this->testdb->Trx();

        foreach ($Rs as $item) {

            $Items = $this->testdb->TrxItems($item->ID);

            foreach ($Items as $item2) {

                $Producto = $item2->descripcionLinea;

                $RsOrc = $this->testdb->OracleProd($item->organizationCode, $Producto);

                if (isset($RsOrc->ID)) {
                    $SQL = "UPDATE transaccion_items SET Auxiliar='" . $RsOrc->ID . "' WHERE ID=" . $item2->ID;
                    $this->db->query($SQL);
                }
            }
        }
    }

    function Mb() {

        for ($i = 1; $i <= 144; $i++) {

            $arc = "p_" . substr("000" . $i, -3) . ".txt";
            $html = file_get_contents('./temp_mb/' . $arc);


            $oldSetting = libxml_use_internal_errors(true);
            libxml_clear_errors();

            $dom = new DOMDocument();

            @$dom->loadHTML($html);
            $finder = new DomXPath($dom);
            $spaner = $finder->query('//tr');
            foreach ($spaner as $item) {

                $id = trim($item->getAttribute("id"));
                $title = utf8_decode(trim($item->getAttribute("title")));

                if ($id != "") {
                    echo $id . " - " . $title . "<br>";
                }
            }
        }
    }

    function Reporte() {


        $wsdl_url = "https://fa-evtw-saasfaprod1.fa.ocs.oraclecloud.com:443/xmlpserver/services/ExternalReportWSSService?WSDL";

        $wsdl_usuario = "INTGRM";
        $wsdl_contrasena = "0r4cl3.10%De100";

        //**********************************************************************
        $soap_request = <<<XML
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:pub="http://xmlns.oracle.com/oxp/service/PublicReportService">
   <soap:Header/>
   <soap:Body>
      <pub:runReport>
         <pub:reportRequest>
            <pub:parameterNameValues>
               <pub:item> 
                  <pub:name>P_TRX_DATE</pub:name>
                  <pub:values>
                     <pub:item>02-27-2023</pub:item>
                  </pub:values>
               </pub:item>
            </pub:parameterNameValues>
            <pub:reportAbsolutePath>/Custom/Integraciones/reporte_recibos.xdo</pub:reportAbsolutePath>
            <pub:sizeOfDataChunkDownload>-1</pub:sizeOfDataChunkDownload>
         </pub:reportRequest>
      </pub:runReport>
   </soap:Body>
</soap:Envelope>
XML;


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $wsdl_url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array(
            'Content-Type: application/soap+xml; charset=utf-8',
            'SOAPAction: "run"',
            'Accept: text/xml',
            'Cache-Control: no-cache',
            'Pragma: no-cache',
            'Content-length: ' . strlen($soap_request),
            'User-Agent: PHP-SOAP/7.0.10'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_USERPWD, $wsdl_usuario . ":" . $wsdl_contrasena);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soap_request);
        $response = curl_exec($ch);
        if (empty($response)) {
            throw new SoapFault('CURL error: ' . curl_error($ch), curl_errno($ch));
        }
        curl_close($ch);

        $dom = new DOMDocument();
        $dom->loadXML($response);
        echo base64_decode($dom->textContent);
    }

    function XmlServ() {
        
        $Xml = file_get_contents('temp/servicios.xml');

        $_xml = new SimpleXMLElement($Xml);
        $items = $_xml->xpath('/DATA_DS/G_1');
        
        foreach ($items as $child) {

            $Precio = (string) $child->PRECIO;
            $Precio = str_replace(",", ".", $Precio);

            $Activo = 0;
            if ((string) $child->ENABLED_FLAG == "Y") {
                $Activo = 1;
            }

            $data_producto = array(
                'TIPO' => 'Servicio',
                'OrganizationCode' => (string) $child->FLEX_VALUE_SET_NAME,
                'ItemNumber' => (string) $child->ID,
                'ValueId' => (string) $child->ID,
                'Description' => (string) $child->SERVICIO,
                'SalesPrice' => $Precio,
                'SubinventoryCode' => (string) $child->TIPOTRANSACCION,
                'PrimaryUnitOfMeasure' => (string) $child->UOM,
                'idIntegraciones' => (string) $child->IDINTEGRACIONES,
                'DESCUENTO' => (string) $child->DESCUENTO,
                'DEVOLUCION' => (string) $child->DEVOLUCION,
                'ENABLED_FLAG' => (string) $child->ENABLED_FLAG,
                 
                'Activo' => $Activo
            );

            $this->db->insert('oracle_productos_test', $data_producto);
        }
    }

}
