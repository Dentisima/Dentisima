<div class="modal-header">
    <h4 class="modal-title mt-0"><strong>NUEVA CITA</strong></h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body"> 
    <div class="row">
        <div class="col-md-12"><center>
                <label class="control-label"><strong>CLAVE DEL PACIENTE</strong></label>
                <input class="form-control form-white" placeholder="" type="text" onblur="ValidaReferido(this.value)" id="_ccodigo" style="text-align: center"/>
            </center>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-12">
            <center>
                <label class="control-label" id="_NOMBRE_CODIGO_REFERIDO"></label> 
            </center>
        </div> 
    </div>

    <div class="row">
        <div class="col-md-12" id="_divinfo">
            <center>
                XXX
                XXX
            </center>
        </div> 
    </div>
    <div class="row"><div class="col-md-12">&nbsp;</div></div>
    <div class="row">
        <div class="col-md-2">
            <label class="control-label"><strong>DIA</strong></label>
        </div>
        <div class="col-md-6">
            <label class="control-label"><?php echo $NomFecha; ?></label> 
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"><br><br>
            <label class="control-label"><strong>HORARIO</strong></label>
        </div>
        <div class="col-md-3">
            <label class="control-label">&nbsp;</label>
            <select class="form-control " id="_chora" >
                <?php foreach ($Horario as $item) { ?>
                    <option value="<?php echo $item->CONCEPTO; ?>"><?php echo $item->CONCEPTO; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3">
            <label class="control-label">&nbsp;</label>
            <select class="form-control " id="_cminutos"  >
                <option value="00">00</option>
                <option value="15">15</option>
                <option value="30">30</option>
                <option value="45">45</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="control-label">&nbsp;</label>
            <select class="form-control " id="_cpref"  >
                <option value="AM">AM</option>
                <option value="PM">PM</option>
            </select>
        </div> 
    </div>

    <div class="row"> 
        <div class="col-md-12">
            <label class="control-label">&nbsp;</label>
            <select class="form-control " id="_cdoctor">
                <option value="0">DOCTOR ASIGNADO</option>
            </select>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn ripple btn-secondary" data-dismiss="modal" id="btnCerrar">Cerrar</button>
    <button type="button" class="btn ripple btn-primary" id="btnGuarda" onclick="GuardarCita()" >Registrar</button>
</div>
<script>
    function ValidaReferido(Codigo) {

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>cliente/Ajax_referido",
            data: {CODIGO_REFERIDO: Codigo},
            cache: false,
            success: function (result) {
                $("#_NOMBRE_CODIGO_REFERIDO").html(result);
            }
        });
    }

    function GuardarCita() {

        if ($("#_ccodigo").val() == "") {
            $("#_ccodigo").focus();
            return false;
        }

        if (confirm("¿Los datos son correctos?")) {

            $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL; ?>cliente/Ajax_guardar",
                data: { Codigo: $("#_ccodigo").val(), Fecha: "<?php echo $Fecha;?>",
                    Hora: $("#_chora").val(), Minutos: $("#_cminutos").val(), Prefijo: $("#_cpref").val(),
                    Doctor: $("#_cdoctor").val()

                },
                cache: false,
                success: function (result) {
                    $("#btnCerrar").click();
                }
            });

        }


    }
</script>