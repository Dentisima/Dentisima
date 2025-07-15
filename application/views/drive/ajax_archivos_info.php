<h5>
    <strong><?php echo $InfoArchivo->ARCHIVO; ?></strong>
</h5>
<div class="line"></div>
<table class="table table-bordered table-striped">
    <tbody>
        <tr>
            <td class="view-file-details-first-row">
                Cargado por:
            </td>
            <td class="responsiveTable"><?php echo $InfoArchivo->NOMBRE2; ?></td>
        </tr>
        <tr>
            <td class="view-file-details-first-row">
                Fecha / Hora:
            </td>
            <td class="responsiveTable"><?php echo $InfoArchivo->FECHA2; ?> <?php echo $InfoArchivo->HORA; ?></td>
        </tr>
        <tr>
            <td class="view-file-details-first-row">
                Tamaño:
            </td>
            <td class="responsiveTable"><?php echo $InfoArchivo->PESO; ?> bytes</td>
        </tr>
    </tbody>
</table>

<label class="m-t-mini">Url descarga: </label>
<textarea placeholder="" rows="3" class="form-control " data-rangelength="[20,200]"
          
          ><?php echo BASE_URL . "expediente/drive/" . $InfoArchivo->IDETIQUETA . "/" . $InfoArchivo->ARCHIVO; ?></textarea>

<label class="m-t-mini">Notas </label>
<textarea placeholder="" rows="5" class="form-control " data-trigger="keyup" data-rangelength="[20,200]"
          onkeyup="GuardaNotas()" id="_notasinternas"
          ><?php echo $InfoArchivo->NOTAS; ?></textarea>
<p class="text-muted"> 
    <small id="_lblsave"> </small> 
</p>

<div class="m-t" align="center">
    
    <a class="btn btn-sm btn-success" target="_blank" href="<?php echo BASE_URL . "expediente/drive/" . $InfoArchivo->IDETIQUETA . "/" . $InfoArchivo->ARCHIVO; ?>">Ver</a>
    &nbsp;&nbsp;&nbsp;
    <a class="btn btn-sm btn-info" target="_blank" href="<?php echo BASE_URL . "expediente/drive/" . $InfoArchivo->IDETIQUETA . "/" . $InfoArchivo->ARCHIVO; ?>">Descargar</a>
    <br><br>
    <a href="#" class="btn btn-danger btn-xs" onclick="EliminarArchivo('<?php echo $InfoArchivo->ARCHIVO; ?>')">Eliminar</a>
</div>

<script>

    function GuardaNotas() {
        $("#_lblsave").html("Guardando...");

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>drive/Ajax_notasinternas",
            data: {Id:<?php echo $InfoArchivo->ID; ?>, Notas: $("#_notasinternas").val()},
            cache: false,
            success: function (result) {
                $("#_lblsave").html("");
            }
        });

    }

    function EliminarArchivo(Archivo) {

        if (confirm("Eliminar el archivo: " + Archivo + " ?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL(); ?>drive/Ajax_eliminararchivo",
                data: {Id:<?php echo $InfoArchivo->ID; ?>,IdEtiqueta:<?php echo $InfoArchivo->IDETIQUETA; ?>, Archivo: Archivo},
                cache: false,
                success: function (result) {
                    $("#thumbnail_<?php echo $InfoArchivo->ID; ?>").remove();
                    $("#_infoacciones").html("Cargando...");
                }
            });
        }

    }

</script>