<?php 

$IdP = 0;
$Con = 0;
foreach ($Listado as $item) { 
    
    $Con++;
    
    if($Con==1){
        $IdP = $item->ID;
    }
    
    ?>

    <a href="javascript:void(0)" class="list-group-item" id="_persona_<?php echo $item->ID; ?>" onclick="ActualizarDatos(<?php echo $item->ID; ?>)" >
        <small class="pull-right text-muted">
            <?php echo $item->FECHA2; ?>
        <span class="<?php if($item->ESTATUS=="Abierta" || $item->ESTATUS==""){ echo "text-success"; }else{ echo "text-danger"; } ;?>  m-t-small"> <i class="fa fa-circle"></i> </span>
        </small>
        <strong><?php echo "[".substr("000000".$item->ID, -6)."] - ".$item->ASUNTO; ?></strong><br>
        <small><?php echo $item->DEPARTAMENTO.", ".$item->HORA;?></small>
        
    </a> 
<?php } ?>

<?php if($Accion==0){ ?>
<script>
    ActualizarDatos(<?php echo $IdP; ?>);
</script>
<?php } ?>