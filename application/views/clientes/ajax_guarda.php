<?php if ($Esnuevo > 0) { ?>
    <div class="modal-header">
        <h4 class="modal-title mt-0"><strong>&nbsp;</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                data-dismiss="modal" id="btnCerrar"
                >&times;</button>
    </div>
    <div class="modal-body">
        <div class=" text-center">

            <div class="icon-service bg-primary-transparent rounded-circle text-success">
                <i class="fe fe-check"></i>
            </div>
            <p class="mb-1 text-muted">¡REGISTRO EXITOSO!</p>
            <h3 class="mb-0">
                <?php echo $Info->NOMBRE_COMPLETO; ?><br>
                <?php echo $Info->FOLIO_CLIENTE; ?>

            </h3>
        </div>

    </div>
<div class="modal-footer">
    <button type="button" class="btn ripple btn-info btn-lg btn-block" data-dismiss="modal">IR A CALENDARIO PARA REGISTRAR CITA</button>    
</div>

<?php } else { ?>
    <script>
        $("#btnCerrar").click();
    </script>
<?php } ?>