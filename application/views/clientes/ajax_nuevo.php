<div class="modal-header">
    <h4 class="modal-title mt-0"><strong><?php if (isset($Info->ID)) {
    echo "EDITAR PACIENTE";
} else {
    echo "NUEVO PACIENTE";
} ?></strong></h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
    <form class="form" autocomplete="off">
        <div class="row">
            <div class="col-md-12">
                <label>Pasado <input type="radio" name="steppaciente" id="steppaciente_0" value="Pasado" style="height: 25px; width: 25px" /></label>&nbsp;&nbsp; 
                <label>Actual <input type="radio" name="steppaciente" id="steppaciente_1" value="Actual" style="height: 25px; width: 25px" /></label>&nbsp;&nbsp;
                <label>Nuevo <input type="radio" name="steppaciente" id="steppaciente_2" value="Nuevo" style="height: 25px; width: 25px" checked /></label>
            </div> 
        </div>
        <div class="row ">
            <div class="col-md-12">
                <label class="control-label"><br>Nombre</label>
                <input class="form-control " placeholder="" type="text" id="_NOMBRE" style="color: #000"/>
            </div>
            <div class="col-md-12">
                <label class="control-label"><br>Apellido(s)</label>
                <input class="form-control " placeholder="" type="text" id="_APELLIDOS" style="color: #000" />
            </div> 
        </div> 
        <div class="row">
            <div class="col-md-12"><br>
                <center>
                    <label>HOMBRE <input type="radio" name="_SEXO" id="_SEXO_0" value="Hombre" checked  style="height: 25px; width: 25px"/></label>&nbsp;&nbsp; 
                    <label>MUJER <input type="radio" name="_SEXO" id="_SEXO_1" value="Mujer"  style="height: 25px; width: 25px"/></label> 
                </center>
            </div> 
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="control-label"><br>Fecha de Nacimiento</label>
            </div>
            <div class="col-md-4">
                <select class="form-control" id="_FNACIO_DIA" onchange="CalculaEdad();" style="color: #000">
                    <option value="">- Día -</option>
                    <?php for($d=1; $d<=31; $d++){ ?>
                    <option value="<?php echo substr("0".$d, -2) ;?>"><?php echo substr("0".$d, -2) ;?></option>
                    <?php } ?>
                </select>
                
            </div>
            <div class="col-md-4">
                <select class="form-control" id="_FNACIO_MES" onchange="CalculaEdad();" style="color: #000">
                    <option value="">- Mes -</option>
                    <?php for($m=1; $m<=12; $m++){ ?>
                    <option value="<?php echo substr("0".$m, -2) ;?>" ><?php echo $this->fechas->MesTxt($m);?></option>
                    <?php } ?>
                </select>
                
            </div>
            <div class="col-md-4">
                <select class="form-control" id="_FNACIO_ANIO" onchange="CalculaEdad();" style="color: #000">
                    <option value="">- Año -</option>
                    <?php for($a=date("Y"); $a>=1900; $a--){ ?>
                    <option value="<?php echo $a ;?>"><?php echo $a;?></option>
                    <?php } ?>
                </select> 
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12"> <br>
                <strong>EDAD: <span id="_spanedad"></span></strong>
            </div> 
        </div>
        <div class="row" id="_divtutor" style="display:none">
            <div class="col-md-12">
                <input class="form-control " placeholder="Nombre completo del padre/tutor" type="text" id="_TUTOR"  style="color: #000"/>
            </div> 
        </div> 
        <div class="row">
            <div class="col-md-12">
                <label class="control-label"><br>WhatsApp</label>
                <div class="input-group">

                    <input class="form-control" placeholder="" type="text" id="_WHATSAPP"   style="color: #000"
                           maxlength="10"
                          
                           ><!--  onkeypress="return ValidarNumeros(event)" -->
                </div>
            </div> 
        </div>
        <div class="row"> 
            <div class="col-md-12"><br>
                <select class="form-control " id="_COMO_SE_ENTERO" style="color: #000">
                    <option value="">¿Cómo se enteró de nosotros?</option>
<?php foreach ($ComoSeEntero as $item) { ?>
                        <option value="<?php echo $item->CONCEPTO; ?>"><?php echo $item->CONCEPTO; ?></option>
<?php } ?> 
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8"><br>
                <label class="control-label">Tiene saldo pendiente</label>
            </div>
            <div class="col-md-4"><br>
                <input class="form-control "  type="text" style="text-align: center; color: #000"
                       value="0.00"
                           maxlength="10" onblur="if (this.value == '') {
                                       this.value = '0.00';
                                   }"
                           onfocus="if (parseFloat(this.value) == 0) {
                                       this.value = '';
                                   }" 
                           onkeypress="return ValidarNumerosDec(event, this)"
                           onkeyup="TotDecimales(this, 2)"  style="text-align: center"
                       
                       
                       />
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12"><br>
                <textarea id="_notaspaciente" rows="3" cols="50" class="form-control" style="color: #000"></textarea>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label"><br>CLAVE DE QUIEN TE INVITA</label>
                <input class="form-control " placeholder="" type="text" onblur="ValidaReferido(this.value)" id="_CODIGO_REFERIDO" 
                       style="text-align: center; color: #000"/>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12"> 
                <label class="control-label" id="_NOMBRE_CODIGO_REFERIDO">Referido: </label> 
            </div> 
        </div>


    </form>
</div>
<div class="modal-footer">

    <button type="button" class="btn ripple btn-secondary" data-dismiss="modal" id="btnCerrar">Cerrar</button>
    <button type="button" class="btn ripple btn-primary" id="btnGuarda" onclick="GuardarCliente()" >Registrar</button>
</div>
<script>
    function ValidaReferido(Codigo) {

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>cliente/Ajax_referido",
            data: {CODIGO_REFERIDO: Codigo},
            cache: false,
            success: function (result) {
                $("#_NOMBRE_CODIGO_REFERIDO").html("Referido: " + result);
            }
        });
    }

    function GuardarCliente() {

        if ($("#_NOMBRE").val() == "") {
            $("#_NOMBRE").focus();
            return false;
        }

        var _Step = "Nuevo";
        var _Sexo = "Hombre";

        if ($("#steppaciente_0").prop('checked')) {
            _Step = "Pasado";
        }
        if ($("#steppaciente_1").prop('checked')) {
            _Step = "Actual";
        }

        if ($("#_SEXO_0").prop('checked')) {
            _Sexo = "Mujer";
        }

        //***************
$(function(e) {
        swal({
            title: "Importante",
            text: "¿Los datos son correctos?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "SI, SON CORRECTOS",
            cancelButtonText: "REGRESAR",
            closeOnConfirm: true,
            closeOnCancel: true
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo BASE_URL(); ?>cliente/Ajax_guardar",
                            data: {
                                ID:<?php if (isset($Info->ID)) { echo $Info->ID; } else { echo "0"; } ?>,
                                NOMBRE: $("#_NOMBRE").val(), APELLIDOS: $("#_APELLIDOS").val(), TELEFONO: "",
                                WHATSAPP: $("#_WHATSAPP").val(), SEXO: _Sexo,
                                DIA: $("#_FNACIO_DIA").val(), MES: $("#_FNACIO_MES").val(), ANIO: $("#_FNACIO_ANIO").val(),
                                TUTOR: $("#_TUTOR").val(),
                                COMO_SE_ENTERO: $("#_COMO_SE_ENTERO").val(), CODIGO_REFERIDO: $("#_CODIGO_REFERIDO").val(),
                                STEP: _Step, NOTAS: $("#_notaspaciente").val()

                            },
                            cache: false,
                            success: function (result) {

                                $("#div-modal-generico").html(result);

                            }
                        });
                    }
                });
             });


        //****************



    }

    function CalculaEdad() {

        var dia = $("#_FNACIO_DIA").val();
        var mes = $("#_FNACIO_MES").val();
        var anio = $("#_FNACIO_ANIO").val();

        $("#_spanedad").html("");
        $("#_divtutor").hide();


        if (dia == "" || mes == "" || anio == "") {

        } else {

            $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL(); ?>cliente/Ajax_Edad",
                data: {Dia: dia, Mes: mes, Anio: anio},
                cache: false,
                success: function (result) {

                    $("#_spanedad").html(result + " años");

                    if (parseInt(result) < 18) {
                        $("#_divtutor").show();
                    }

                }
            });
        }

    }

</script>