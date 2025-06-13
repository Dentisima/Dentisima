<?php if (isset($Info->ID)) { ?>
<div class="block clearfix" >
    <a href="#" class="thumb-mini inline" >
        <i class="fa fa-globe fa-lg "></i>
    </a> 

    <div class="pull-right inline"><?php echo $Info->FECHA2; ?> (<em>hace <?php echo $Info->DIAS_PASO; ?> días</em>) 
        <a href="#" data-toggle="class"><i class="fa fa-star-o text-muted fa-lg text"></i><i class="fa fa-star text-warning fa-lg text-active"></i></a>
        <div class="btn-group">
            <button class="btn btn-white btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
            <ul class="dropdown-menu pull-right">
                <li><a href="#" onclick="DarDebaja(<?php echo $Info->ID;?>)">Dar de baja</a></li> 
            </ul>
        </div>
    </div>
</div> 
<script>
function DarDebaja(Id){
    
    if( confirm("Eliminar la nota?") ){
        
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>notas/Ajax_notasbaja",
            data: {Id: Id },
            cache: false,
            success: function (result) { 
                Notas(); 
            }
        });
        
    }
    
}
</script>
<?php } ?>
<div class="form-horizontal" data-validate="parsley">
    <div class="form-group"> 
        <div class="col-lg-12">
            <textarea id="notas" placeholder="" rows="30" 
                      onkeyup="GuardaNotas()"
                      class="form-control parsley-validated agrnota" data-trigger="keyup" data-rangelength="[20,200]"><?php
                          if (isset($Info->ID)) {
                              echo $Info->NOTA;
                          }
                          ?></textarea>
        </div>
    </div>
</div>
<span id="_spannota" style="display:none"></span>
<script>

    function GuardaNotas() {

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>notas/Ajax_notasinternas",
            data: {Id: <?php if (isset($Info->ID)) { echo $Info->ID; } else { echo "0"; } ?>, 
                   Notas: $("#notas").val(), Folio: '<?php echo $Folio;?>'
                  },
            cache: false,
            success: function (result) { 
            }
        });

    }
<?php if (isset($Info->ID)) { ?>
        $("#_nombrenota").html("Editar nota");
<?php } else { ?>
        $("#_nombrenota").html("Nueva nota");
<?php } ?>
</script>