<?php

class Cadenas {

    function AgregaCeros($CADENA_ORIGINAL, $POSICION, $TIPO, $TOTAL){ 

       $LONGITUD   = strlen(trim($CADENA_ORIGINAL));
       $DIFERENCIA = $TOTAL - $LONGITUD;
       $CAD_CEROS  = "";
       $CADENA     = "";
       
       switch($TIPO){
          case 0:
             for($i=1; $i<=$DIFERENCIA; $i++){$CAD_CEROS .= "0";}
          break;
          case 1:
             for($i=1; $i<=$DIFERENCIA; $i++){$CAD_CEROS .= " ";}
          break;
       }
       
       switch($POSICION){
          case 0://Posicion a la izquierda
             $CADENA = $CAD_CEROS.$CADENA_ORIGINAL;
          break;
          case 1://Posicion a la derecha
             $CADENA = $CADENA_ORIGINAL.$CAD_CEROS;
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
    
    function paypal($correo, $amount, $description, $invoice, $moneda, $urlReturnAcepted, $urlReturnCancel ){

     $target = "https://www.paypal.com/xclick";
     $amount = sprintf("%.02f", $amount);
     $params="business=$correo&item_name=$description&item_number=$invoice&amount=$amount&currency_code=$moneda&return=$urlReturnAcepted&cancel_return=$urlReturnCancel";
     $params = str_replace(" ", "%20", $params);
     header("Location: $target/$params");

   }
   
   function encrypt($string, $key) {
	  
      $result = '';
	  if($string!=""){
      for($i=0; $i<strlen($string); $i++) {
         $char = substr($string, $i, 1);
         $keychar = substr($key, ($i % strlen($key))-1, 1);
         $char = chr(ord($char)+ord($keychar));
         $result.=$char;
      }
	  }
      return base64_encode($result);
   }
   
   function decrypt($string, $key) {
      $result = '';
	  
	  if($string!=""){
	  
	  $string = base64_decode($string);
	  for($i=0; $i<strlen($string); $i++) {
		  $char = substr($string, $i, 1);
		  $keychar = substr($key, ($i % strlen($key))-1, 1);
		  $char = chr(ord($char)-ord($keychar));
		  $result.=$char;
      }
	  }
	  return $result;
    } 
        
    function CortaCadena( $CADENA_ORIGINAL , $TOTAL ){
       
       $LONGITUD = strlen(trim($CADENA_ORIGINAL));
       $LINEAS   = 0;
       $ArCadena = array();
       
       if( $TOTAL >= $LONGITUD ){
          $ArCadena[] = array( "CADENA"=>$CADENA_ORIGINAL );
       }else{
          
          $LINEAS  = $LONGITUD / $TOTAL;
          $LINEAS2 = round( $LINEAS );
          
          #Si hay diferencia por decimales se suma una linea mas
          if( $LINEAS!=$LINEAS2 ){ $LINEAS2 = $LINEAS2 + 1; }
          
          $ORIGEN  = 0;
          $TERMINO = $TOTAL;
          
          for($i=1; $i<=$LINEAS2; $i++){
             
             $ArCadena[] = array( "CADENA"=> trim( substr( $CADENA_ORIGINAL , $ORIGEN , $TOTAL  ) ) );
             
             $ORIGEN  = $TERMINO;
             $TERMINO = $TERMINO + $TOTAL;
          }
       }
       
       return $ArCadena;
       
    }
    
    function SeparaCadena( $CADENA_ORIGINAL , $TOTAL, $FILAS ){
       
       $CADENA_ORIGINAL .= " ";
       $LONGITUD = strlen($CADENA_ORIGINAL)-1;
       $ArCadena = array();
       $NUEVA = "";
       $Cont = 0;
       $Rows = 0;
          
       if( $TOTAL > $LONGITUD ){
          $ArCadena[] = array( "CADENA"=>$CADENA_ORIGINAL );
       }else{
                 
          for($a=0; $a<=$LONGITUD; $a++){
             
             $Cont++;
             
             $NUEVA .= $CADENA_ORIGINAL[$a];
             
             if( $Cont==$TOTAL || $a==$LONGITUD ){
                $Rows++;
                $ArCadena[] = array( "CADENA"=>$NUEVA."<br>" );
                $NUEVA = "";
                $Cont = 0;
                
                if($Rows==$FILAS){
                   break;
                }
             }
             
             
          }
          
       }
       
       return $ArCadena;
       
    }

}