<?php

class Push {

    function NotificaPush($API, $AppId, $Title, $Msj, $IdCita = "", $MensajeEspecial = "") {

        //define('API_ACCESS_KEY', 'AIzaSyAYV-jdTrVS_kk1OSwjTrv8SIjU3TV5SSA');

        $registrationIds = array($AppId);

// prep the bundle
        $msg = array
            (
            'body' => $Msj,
            'title' => $Title,
            'vibrate' => 1,
            'sound' => 1,
            'tickerText' => $IdCita,  
            'message' 	=> $MensajeEspecial,
        );
        $fields = array(
            'registration_ids' => $registrationIds,
            'notification' => $msg,
            'data' => $msg
        );

        $headers = array
            (
            'Authorization: key=' . $API,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        //echo $result;
    }

    function NotificaPushIos($API, $AppId, $Title, $Msj) {

        //define('API_ACCESS_KEY', 'AIzaSyAYV-jdTrVS_kk1OSwjTrv8SIjU3TV5SSA');

        $registrationIds = array($AppId);

// prep the bundle
        $msg = array
            (
            'body' => $Msj,
            'title' => $Title,
            'vibrate' => 1,
            'sound' => 1,
        );
        $fields = array
            (
            'registration_ids' => $registrationIds,
            'notification' => $msg
        );

        $headers = array
            (
            'Authorization: key=' . $API,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        //echo $result;
    }

}
