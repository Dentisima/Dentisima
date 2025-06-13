<?php foreach($Comentarios as $item){ ?>
<article id="comment-id-1" class="comment-item media arrow arrow-left">
    <a class="pull-left thumb-small"><span class="btn btn-circle btn-warning btn-xs"><i class="fa fa-comments-o"></i></span></a>

    <section class="media-body panel">
        <header class="panel-heading clearfix"> <a href="#"><?php echo $item->ACCESO;?></a>
            <label class="label bg-info m-l-mini"><?php echo $item->FECHA2." , ".$item->HORA;?></label> 
            
            <span class="text-muted m-l-small pull-right"><i class="fa fa-clock-o"></i> 
                
                <?php if($item->DIAS_PASO==0){ echo "Hoy"; }else{ echo $item->DIAS_PASO." días"; }?>
                
            </span> 
        </header>
        <div class="panel-body">
            <div>
                <?php echo $item->COMENTARIO;?>
                <div id="_com_archivos_<?php echo $item->ID;?>" >
                    <script>ArchivosComentario(<?php echo $item->ID;?>); </script> 
                </div>

            </div>
        </div>
    </section>
</article>
<?php } ?>