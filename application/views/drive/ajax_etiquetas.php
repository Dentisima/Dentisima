<?php 
$con = 0;
$Id = 0;
foreach($Lista as $item){ 
    $con++;
    
    if($con==1){
        $Id = $item->ID;
    }
    ?>
<a href="#" onclick="Archivos('<?php echo $item->ID;?>')" class="list-group-item"> 
    <i class="fa fa-fw fa-bookmark text-info "></i>
    <span class="badge m-r"></span> <?php echo $item->ETIQUETA;?>
</a>
<?php 

} 
?>

<script>
    <?php if($Id>0){ ?>
    setTimeout(function () {
        Archivos(<?php echo $Id;?>);
    }, 100);
    <?php } ?>
</script>