<div class="modal-header">
    <h4 class="modal-title mt-0"><strong><?php if( isset($Info->ID) ){ echo "EDITAR MEDICO";}else{ echo "NUEVO MEDICO";} ?></strong></h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
    <form class="form" autocomplete="off">
 
         <div class="row">
            <div class="col-md-12">
                <label class="control-label">Nombre(s)</label>
                <input class="form-control form-white" placeholder="" type="text" id="_NOMBRE"/>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label">Apellido(s)</label>
                <input class="form-control form-white" placeholder="" type="text" id="_APELLIDOS" />
            </div> 
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <label class="control-label">Sexo</label>
                <select class="form-control form-white" id="_SEXO">
                    <option value="">- Seleccione -</option>
                    <?php foreach($Genero as $item){ ?>
                    <option value="<?php echo $item->CONCEPTO;?>"><?php echo $item->CONCEPTO;?></option>
                    <?php } ?> 
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label">Fecha de Nacimiento</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fe fe-calendar lh--9 op-6"></i></div>
                    </div>
                    <input class="form-control fc-datepicker" placeholder="DD/MM/YYYY" type="text" style="text-align: center" id="_FNACIO">
                </div>
                 
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label">WhatsApp</label>
                <div class="input-group">
                    
                    <input class="form-control" placeholder="(000) 000-0000" type="text" id="_WHATSAPP">
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label">Teléfono recados</label>
                <div class="input-group"> 
                    <input class="form-control" placeholder="(000) 000-0000" type="text" id="_TELEFONO">
                </div>
            </div> 
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label">Cédula Profesional</label>
                <input class="form-control form-white" placeholder="" type="text" id="_APELLIDOS" />
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label">Especialidad</label>
                <input class="form-control form-white" placeholder="" type="text" id="_APELLIDOS" />
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label">Sub Especialidad</label>
                <input class="form-control form-white" placeholder="" type="text" id="_APELLIDOS" />
            </div> 
        </div>

        
        
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn ripple btn-secondary" data-dismiss="modal" id="btnCerrar">Cerrar</button>
    <button type="button" class="btn ripple btn-primary" id="btnGuarda" onclick="GuardarCliente()" >Registrar</button>
</div>
<script>
    function ValidaReferido(Codigo){
        
           $.ajax({
              type: "POST",
              url: "<?php echo BASE_URL(); ?>cliente/Ajax_referido",
              data: {CODIGO_REFERIDO: Codigo},
              cache: false,
              success: function (result) {
                 $("#_NOMBRE_CODIGO_REFERIDO").html("Referido: "+result);
              }
           });
    }
    
    function GuardarCliente(){
    
       if($("#_NOMBRE").val()==""){
           $("#_NOMBRE").focus();
           return false;
       }
        
        if( confirm("¿Los datos son correctos?") ){
           
           $.ajax({
              type: "POST",
              url: "<?php echo BASE_URL(); ?>cliente/Ajax_guardar",
              data: {
                  ID:<?php if( isset($Info->ID) ){ echo $Info->ID;}else{ echo "0";} ?>,
                  NOMBRE: $("#_NOMBRE").val(), APELLIDOS: $("#_APELLIDOS").val(), TELEFONO: $("#_TELEFONO").val(),
                  WHATSAPP: $("#_WHATSAPP").val(), SEXO: $("#_SEXO").val(), FNACIO: $("#_FNACIO").val(), 
                  COMO_SE_ENTERO: $("#_COMO_SE_ENTERO").val(), CODIGO_REFERIDO: $("#_CODIGO_REFERIDO").val()
                   
              },
              cache: false,
              success: function (result) {
                 $("#btnCerrar").click();
              }
           });
           
        } 
 
        
    }
</script>