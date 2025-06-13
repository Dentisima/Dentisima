<?php if(count($Archivos)>0){ ?>
<br>
<p id="social-buttons"> 
    <?php foreach ($Archivos as $item) { ?> 
    <a href="<?php echo BASE_URL; ?>expediente/tickets/<?php echo $item->IDTICKET;?>/<?php echo $item->ARCHIVO;?>" target="_blank" class="btn btn-circle btn-xs btn-info"><i class="fa fa-file"></i> <?php echo $item->ARCHIVO; ?></a> 
    <?php } ?>
</p>
<?php } ?>