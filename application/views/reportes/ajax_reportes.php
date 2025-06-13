<?php 

$RsUser = $this->session->userdata('_userinfo');

$ArRep = explode(",", $RsUser->_REPORTES_USUARIOS );
 
$IdP = 0;
$Con = 0;
foreach ($Listado as $item) { 
    
    $Con++;
    $PasoRep = false;
    
    for($r=0; $r<count($ArRep); $r++){
        if( $ArRep[$r]==$item->REPORTE ){
            $PasoRep = true;
            break;
        }
    }
    
    if($Con==1 && $PasoRep==true){
        $IdP = $item->ID;
    }
    

    if( $PasoRep==true ){
    
    ?>

    <a href="javascript:void(0)" class="list-group-item" id="_reporte_<?php echo $item->ID; ?>" onclick="ActualizarDatos(<?php echo $item->ID; ?>)" >
        <small class="pull-right text-muted"><?php echo $item->FECHA2; ?></small>
        <strong><?php echo $item->REPORTE; ?></strong><br>
        <small> </small>
    </a> 
<?php } } ?>

<script>
    ActualizarDatos(<?php echo $IdP; ?>);
</script>