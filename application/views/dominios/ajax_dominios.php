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
        <small class="pull-right text-muted"><?php echo $item->ALTA2; ?></small>
        <strong><?php echo $item->DOMINIO; ?></strong><br>
        <small><?php echo $item->TIPO; ?></small>
    </a> 
<?php } ?>

<?php if($Accion==0){ ?>
<script>
    ActualizarDatos(<?php echo $IdP; ?>);
</script>
<?php } ?>