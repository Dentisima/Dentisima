<?php

class Sms {

    function Mensaje($User, $Pwd, $Celular, $Msj) {
        
        $CadenaPwd = base64_encode("$User:$Pwd");
        
        $curl = curl_init();
        curl_setopt_array($curl, array(CURLOPT_URL => "http://broadcaster.cm-operations.com/dashboard/broadcasterwebsms/bin/tu_empresa_copia.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>  "{\"msisdn\":\"$Celular\",\"message\":\"$Msj\",\"tag\":\"Notificación\",\"user\":\"$User\"}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic $CadenaPwd",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "error:" . $err;
        } else {
            return "ok:" . $response;
        }

    }

}
