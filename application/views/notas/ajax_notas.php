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
        <small class="pull-right text-muted"><?php echo $item->FECHA2; ?></small>
        <strong><?php echo substr($item->NOTA,0,100);
        if( strlen($item->NOTA)>100 ){  echo "...";}
        ?>
        </strong> 
    </a> 
<?php } ?>

<script>
    ActualizarDatos(<?php echo $IdP; ?>);
</script>