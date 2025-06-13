<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button> 
    <h4 class="modal-title">Acceso <?php if (isset($Info->ID)) {
    echo " editar ";
} ?></h4>
</div>
<div class="modal-body">
    <div class="block"> 
        <label class="control-label">Nombre *</label> 
        <input type="text" class="form-control" placeholder="" id="_accnombre" value="<?php if (isset($Info->ID)) {echo $Info->NOMBRE;} ?>"> 
    </div>
    <div class="block"> 
        <label class="control-label">Correo / Nip *</label> 
        <input type="text" class="form-control" placeholder="" id="_acccorreo" value="<?php if (isset($Info->ID)) {echo $Info->CORREO;} ?>"> 
    </div>
    <div class="block"> 
        <label class="control-label">Contraseña</label> 
        <input type="password" class="form-control" placeholder="" id="_accpwd" value="" maxlength="20"> 
    </div>
    <div class="block"> 
        <label class="control-label">Estatus</label>
        <select name="_accestaus" class="form-control" id="_accestatus">
            <option value="" <?php if (isset($Info->ID)) {if ($Info->ESTATUS == "") {echo "selected";}} ?> >Activo</option> 
            <option value="Baja" <?php if (isset($Info->ID)) {if ($Info->ESTATUS == "Baja") {echo "selected";}} ?> >Baja</option>
        </select>
    </div>
    <div class="block">
        <label class="control-label">Tipo</label>
        <select name="_accestaus" class="form-control" id="_acctipo">
            <option value="root" <?php if (isset($Info->ID)) {if ($Info->TIPO == "root") {echo "selected";}} ?>>Root</option> 
            <option value="staff" <?php if (isset($Info->ID)) {if ($Info->TIPO == "staff") {echo "selected";}} ?>>Staff</option>
            <option value="usuario" <?php if (isset($Info->ID)) {if ($Info->TIPO == "usuario") {echo "selected";}} ?>>Usuario</option>
            <option value="soporte" <?php if (isset($Info->ID)) {if ($Info->TIPO == "soporte") {echo "selected";}} ?>>Soporte</option>
        </select>
    </div>
    <div class="block">
        <label class="control-label">Permisos</label>

        <div class="checkbox">
            <label><input name="_dashboad" type="checkbox" id="_DASHBOARD" <?php if (isset($Info->ID)){if ($Info->_DASHBOARD == 1) {echo "checked";}} ?> > Dashboard</label><br>
            <label><input name="_tickets" type="checkbox" id="_LOGS" <?php if (isset($Info->ID)){if ($Info->_LOGS == 1) {echo "checked";}} ?> > Logs</label><br>
            &nbsp;&nbsp;<label><input name="_tickets" type="checkbox" id="_LOGS_REPROCESA" <?php if (isset($Info->ID)){if ($Info->_LOGS_REPROCESA == 1) {echo "checked";}} ?> > Reprocesar</label><br>
            <label><input name="_users" type="checkbox" id="_FACTURAS" <?php if (isset($Info->ID)){if ($Info->_FACTURAS == 1) {echo "checked";}} ?> > Facturas</label><br>
            <label><input name="_drive" type="checkbox" id="_PRODUCTOS" <?php if (isset($Info->ID)){if ($Info->_PRODUCTOS == 1) {echo "checked";}} ?> > Productos</label><br>
            <label><input name="_reportes" type="checkbox" id="_REPORTES" <?php if (isset($Info->ID)){if ($Info->_REPORTES == 1) {echo "checked";}} ?> > Reportes</label><br>
            &nbsp;&nbsp;<input type="hidden" id="_REPORTES_USUARIOS" style="width:100%" value="<?php if (isset($Info->ID)) {
            echo $Info->_REPORTES_USUARIOS;} ?>" />
            <label><input name="_tickets" type="checkbox" id="_TICKETS" <?php if (isset($Info->ID)){if ($Info->_TICKETS == 1) {echo "checked";}} ?> > Soporte</label><br>
            <label><input name="_drive" type="checkbox" id="_DRIVE" <?php if (isset($Info->ID)){if ($Info->_DRIVE == 1) {echo "checked";}} ?> > Drive</label><br>
            <label><input name="_ajustes" type="checkbox" id="_ACCESOS" <?php if (isset($Info->ID)){if ($Info->_ACCESOS == 1) {echo "checked";}} ?> > Accesos</label><br>
            <label><input name="_ajustes" type="checkbox" id="_AJUSTES" <?php if (isset($Info->ID)){if ($Info->_AJUSTES == 1) {echo "checked";}} ?> > Ajustes</label><br>
            <label><input name="_ajustes" type="checkbox" id="_NOTAS" <?php if (isset($Info->ID)){if ($Info->_NOTAS == 1) {echo "checked";}} ?> > Notas</label><br>
            
            <label><input name="_ajustes" type="checkbox" id="_INVENTARIOS" <?php if (isset($Info->ID)){if ($Info->_INVENTARIOS == 1) {echo "checked";}} ?> > Inventarios</label><br>
            <label><input name="_ajustes" type="checkbox" id="_SERVICIOSOIC" <?php if (isset($Info->ID)){if ($Info->_SERVICIOSOIC == 1) {echo "checked";}} ?> > Servicios OIC</label><br>
            <label><input name="_ajustes" type="checkbox" id="_CARGAVENTAS" <?php if (isset($Info->ID)){if ($Info->_CARGAVENTAS == 1) {echo "checked";}} ?> > Cargar Ventas</label><br>
            <label><input name="_ajustes" type="checkbox" id="_TRX" <?php if (isset($Info->ID)){if ($Info->_TRX == 1) {echo "checked";}} ?> > Sincronizar Ventas OIC</label><br>
            

        </div>

    </div>
</div>
<div class="modal-footer"> 
    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" id="_btncerraraccesogda">Cerrar</button> 
    <button type="button" class="btn btn-sm btn-primary"  onclick="GuardaAcceso()" >Guardar</button> 
</div>
  
<script>
    function GuardaAcceso() {

        var Nombre = $("#_accnombre").val();
        var Correo = $("#_acccorreo").val();

        if (Nombre == "") {
            $("#_accnombre").focus();
            return false;
        }
        if (Correo == "") { 
            $("#_acccorreo").focus();
            return false;
        }
        
        var _DASHBOARD = 0;
        var _LOGS = 0;
        var _LOGS_REPROCESA = 0;
        var _FACTURAS = 0; 
        var _PRODUCTOS = 0;
        var _REPORTES = 0;
        var _TICKETS = 0;
        var _DRIVE = 0;
        var _ACCESOS = 0;
        var _AJUSTES = 0; 
        var _NOTAS = 0;
        var _INVENTARIOS = 0;
        var _TRX = 0;
        var _CARGAVENTAS = 0;
        var _SERVICIOSOIC = 0;
        
        
        if ($("#_DASHBOARD").prop('checked')) { _DASHBOARD = 1; }
        if ($("#_LOGS").prop('checked')) { _LOGS = 1; }
        if ($("#_LOGS_REPROCESA").prop('checked')) { _LOGS_REPROCESA = 1; }
        if ($("#_FACTURAS").prop('checked')) { _FACTURAS = 1; }
        if ($("#_PRODUCTOS").prop('checked')) { _PRODUCTOS = 1; }
        if ($("#_REPORTES").prop('checked')) { _REPORTES = 1; }
        if ($("#_TICKETS").prop('checked')) { _TICKETS = 1; }
        if ($("#_DRIVE").prop('checked')) { _DRIVE = 1; }
        if ($("#_ACCESOS").prop('checked')) { _ACCESOS = 1; } 
        if ($("#_AJUSTES").prop('checked')) { _AJUSTES = 1; } 
        if ($("#_NOTAS").prop('checked')) { _NOTAS = 1; }
        if ($("#_INVENTARIOS").prop('checked')) { _INVENTARIOS = 1; }
        if ($("#_TRX").prop('checked')) { _TRX = 1; }
        if ($("#_CARGAVENTAS").prop('checked')) { _CARGAVENTAS = 1; }
        if ($("#_SERVICIOSOIC").prop('checked')) { _SERVICIOSOIC = 1; }

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>ajustes/AjaxAccesos_Guarda",
            data: {
                Id: <?php if (isset($Info->ID)) { echo $Info->ID; } else { echo "0"; } ?>,
                Nombre: Nombre, Correo: Correo, Pwd: $("#_accpwd").val(), Estatus: $("#_accestatus").val(),
                Tipo: $("#_acctipo").val(), _LOGS:_LOGS, _FACTURAS:_FACTURAS, _PRODUCTOS:_PRODUCTOS, _REPORTES:_REPORTES, 
                _REPORTES_USUARIOS: $("#_REPORTES_USUARIOS").val(),
                _TICKETS:_TICKETS, _DRIVE:_DRIVE, _AJUSTES:_AJUSTES, _NOTAS:_NOTAS, _INVENTARIOS:_INVENTARIOS,
                _LOGS_REPROCESA: _LOGS_REPROCESA, _ACCESOS:_ACCESOS,
                _TRX:_TRX, _CARGAVENTAS:_CARGAVENTAS, _SERVICIOSOIC:_SERVICIOSOIC,
                _DASHBOARD: _DASHBOARD
               
            },
            cache: false,
            success: function (result) {
                
                $("#_btncerraraccesogda").click();
                $("#_divmodacceso").html("");
                ajaxAccesos();

                toastr.options = {"closeButton": false, "debug": false, "positionClass": "toast-bottom-right", "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"}
                toastr["success"]("Acceso guardado", "Mensaje");

            }
        });
    }
 
 <?php

$CadRep = '';

foreach($Reportes as $item){
    $CadRep .= '"'.$item->REPORTE.'",';
}

$CadRep = substr($CadRep,0,strlen($CadRep)-1);

?>

$("#_REPORTES_USUARIOS").select2({tags:[<?php echo $CadRep;?>],tokenSeparators:[","," "]});
</script>