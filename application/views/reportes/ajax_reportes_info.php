<?php if (isset($Info->ID)) { ?>
    <section class="main">
        <div class="bg-primary clearfix padder m-b">
            <h3 class="m-b"><?php echo $Info->ID." - ".$Info->REPORTE; ?></h3> </div>
        <div class="text-small padder">


            <!-- -->

            <section class="panel">
                <div class="panel-body">
                    <form class="form-horizontal" target="_blank" method="post" action="<?php echo BASE_URL; ?>reportes/ReportesExcel">
                        <input type="hidden" name="Id" value="<?php echo $Info->ID; ?>">
                        <input type="hidden" name="Formato" value="html">
                        <?php if ($Info->FILTROFECHA == 1) { ?>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Rango de fechas</label> 
                                <div class="col-lg-4"> 
                                    <input type="text" name="startdate" placeholder="" class="bg-focus form-control datepicker"  data-date-format="dd/mm/yyyy"
                                           value="<?php echo $this->fechas->fecha(1); ?>" style="text-align:center" > 
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" name="enddate" placeholder="" class="bg-focus form-control datepicker"  data-date-format="dd/mm/yyyy" 
                                           value="<?php echo $this->fechas->fecha(1); ?>" style="text-align:center" > 
                                </div>
                            </div>
                        <?php } ?>



                        <?php if ($Info->FILTROTEXT1 == 1) { ?>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Filtro 1</label> 
                                <div class="col-lg-8">
                                    <strong><?php echo $Info->FILTROTEXT1_MASCARA; ?></strong><br>
                                    <div class="input-group" id="_divfiltro1_<?php echo $Info->ID; ?>">
                                        <input type="text" name="filtro1" class="form-control">
                                    </div>
                                    <?php if ($Info->CONDICION1_TABLA != "") { ?>
                                        <script>
                                            setTimeout(function () {
                                                CargaTabla(<?php echo $Info->ID; ?>, "_divfiltro1_<?php echo $Info->ID; ?>", "filtro1", "CONDICION1_TABLA");
                                            }, 300);
                                        </script>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>


                        <?php if ($Info->FILTROTEXT2 == 1) { ?>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Filtro 2</label> 
                                <div class="col-lg-8"> 

                                    <strong><?php echo $Info->FILTROTEXT2_MASCARA; ?></strong><br>
                                    <div class="input-group" id="_divfiltro2_<?php echo $Info->ID; ?>">
                                        <input type="text" name="filtro2" class="form-control">
                                    </div>
                                    <?php if ($Info->CONDICION2_TABLA != "") { ?>
                                        <script>
                                            setTimeout(function () {
                                                CargaTabla(<?php echo $Info->ID; ?>, "_divfiltro2_<?php echo $Info->ID; ?>", "filtro2", "CONDICION2_TABLA");
                                            }, 300);
                                        </script>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($Info->FILTROTEXT3 == 1) { ?>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Filtro 2</label> 
                                <div class="col-lg-8"> 

                                    <strong><?php echo $Info->FILTROTEXT3_MASCARA; ?></strong><br>
                                    <div class="input-group" id="_divfiltro3_<?php echo $Info->ID; ?>">
                                        <input type="text" name="filtro3" class="form-control">
                                    </div>
                                    <?php if ($Info->CONDICION3_TABLA != "") { ?>
                                        <script>
                                            setTimeout(function () {
                                                CargaTabla(<?php echo $Info->ID; ?>, "_divfiltro3_<?php echo $Info->ID; ?>", "filtro3", "CONDICION3_TABLA");
                                            }, 300);
                                        </script>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <div class="col-lg-9 col-lg-offset-3"> 
                                <button type="button" class="btn btn-primary" onclick="TipoReporte(this.form, 'xls')">Descargar Excel</button>
                                &nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn btn-info" onclick="TipoReporte(this.form, 'html')">Ver en Pantalla</button> 
                            </div>
                        </div>
                        <?php if ($Info->CRONJOB == "Si") { ?>
                            <hr>
                            <div class="form-group">
                                <label class="col-lg-6 control-label">CRON JOB</label> 

                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Título</label> 
                                <div class="col-lg-9"> 
                                    <input type="text" id="TITULO" class="form-control" value="<?php echo $Info->TITULO;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Se envia</label> 
                                <div class="col-lg-2">en los Minutos:
                                    <input type="hidden" id="MINUTO" style="width:100%" 
                                           value="<?php if (isset($Cron->ID)) {echo $Cron->MINUTO;} ?>" />
                                </div>
                                <div class="col-lg-2">a la Hora(s):
                                    <input type="hidden" id="HORA" style="width:100%" 
                                           value="<?php if (isset($Cron->ID)) {echo $Cron->HORA;} ?>" />
                                      
                                </div>
                                <div class="col-lg-2">los Días:
                                    <input type="hidden" id="DIA" style="width:100%" 
                                           value="<?php if (isset($Cron->ID)) {echo $Cron->DIA;} ?>" />
                                    
                                </div>
                                <div class="col-lg-2">de cada Mes(es):
                                    <input type="hidden" id="MES" style="width:100%" 
                                           value="<?php if (isset($Cron->ID)) {echo $Cron->MES;} ?>" />
                                    
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Rango de fechas</label> 
                                <div class="col-lg-4"> 
                                    <input type="text" id="CronFecha1" placeholder="" class="bg-focus form-control datepicker"  data-date-format="dd/mm/yyyy"
                                           value="<?php if (isset($Cron->ID)) { echo $Cron->FECHA1_A;} ?>" style="text-align:center" > 
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" id="CronFecha2" placeholder="" class="bg-focus form-control datepicker"  data-date-format="dd/mm/yyyy" 
                                           value="<?php if (isset($Cron->ID)) { echo $Cron->FECHA2_B;} ?>" style="text-align:center" > 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Ids Reportes</label> 
                                <div class="col-lg-9"> 
                                    <input type="text" id="IDSREPORTES" class="bg-focus form-control" value="<?php if (isset($Cron->ID)) {
                                    echo $Cron->IDSREPORTES;
                                }
                                ?>" />
                                    <small>ej. 1,2,3</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Correos</label> 
                                <div class="col-lg-9"> 
                                    <input type="hidden" id="CORREOS" style="width:100%" value="<?php if (isset($Cron->ID)) {
                                    echo $Cron->CORREOS;
                                }
                                ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Activado</label> 
                                <div class="col-lg-2"> 
                                    <select name="ACTIVO" id="ACTIVO" class="form-control" >
                                        <option value="1" <?php if (isset($Cron->ID)) {
                                    if ($Cron->ACTIVO == 1) {
                                        echo "selected";
                                    }
                                } ?> >Si</option>
                                        <option value="0" <?php if (isset($Cron->ID)) {
                                    if ($Cron->ACTIVO == 0) {
                                        echo "selected";
                                    }
                                } ?> >No</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-9 col-lg-offset-3">  
                                    <button type="button" class="btn btn-success" onclick="ActualizarCron()">Actualizar CronJob</button> 
                                </div>
                            </div>
                            <script>
                                function ActualizarCron() {

                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo BASE_URL; ?>reportes/AjaxActualizaCron",
                                        data: {
                                            IdReporte: <?php echo $Info->ID;?>,
                                            Id: <?php if (isset($Cron->ID)) { echo $Cron->ID; } else {echo "0";} ?>,
                                            TITULO: $("#TITULO").val(), MINUTO: $("#MINUTO").val(), DIA: $("#DIA").val(), 
                                            HORA: $("#HORA").val(),
                                            MES: $("#MES").val(), CORREOS: $("#CORREOS").val(), ACTIVO: $("#ACTIVO").val(),
                                            FECHA1: $("#CronFecha1").val(), FECHA2: $("#CronFecha2").val(),
                                            IDSREPORTES: $("#IDSREPORTES").val()

                                        },
                                        cache: false,
                                        success: function (result) { 

                                            toastr.options = {"closeButton": false, "debug": false, "positionClass": "toast-bottom-right", "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"}
                                            toastr["success"]("CronJob Actualizado", "Mensaje");

                                        }
                                    });

                                }
                            </script>
    <?php } ?>




                    </form>
                </div>
            </section>

            <!-- -->



        </div>
    </section>
    <script src="<?php echo BASE_URL; ?>tema/js/select2/select2.min.js"></script>
    <script>
                            function TipoReporte(form, Formato) {
                                form.Formato.value = Formato;
                                form.submit();
                            }
                            function CargaTabla(Id, Div, Nombre, Condicion) {

                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo BASE_URL; ?>reportes/Ajax_Tabla",
                                    data: {Id: Id, Nombre: Nombre, Condicion: Condicion},
                                    cache: false,
                                    success: function (result) {

                                        $("#" + Div).html(result);
                                    }
                                });

                            }



    <?php
    $CadCorreos = '';

    foreach ($Correos as $item) {
        $CadCorreos .= '"' . $item->Correo . '",';
    }

    $CadCorreos = substr($CadCorreos, 0, strlen($CadCorreos) - 1);
    ?>

                            $("#CORREOS").select2({tags: [<?php echo $CadCorreos; ?>], tokenSeparators: [",", " "]});

                            
<?php 
$Minutos = '';
for ($i = 0; $i <= 55; $i = $i + 5) { 
    $Minutos .= '"'.substr("0" . $i, -2).'",';
    
 } 
 $Minutos = substr($Minutos,0,strlen($Minutos)-1);
 ?> 
                                            
$("#MINUTO").select2({tags:[<?php echo $Minutos;?>],tokenSeparators:[","," "]});

<?php 
$Horas = '"Cada Hora",';
for ($i = 0; $i <= 23; $i++) {  
    $Horas .= '"'.substr("0" . $i, -2).'",';
    
 } 
 $Horas = substr($Horas,0,strlen($Horas)-1);
 ?> 
                                            
$("#HORA").select2({tags:[<?php echo $Horas;?>],tokenSeparators:[","," "]});

<?php 
$Dias = '"Todos",';
for ($i = 1; $i <= 31; $i++) { 
    $Dias .= '"'.substr("0" . $i, -2).'",';
    
 } 
 $Dias = substr($Dias,0,strlen($Dias)-1);
 ?> 
                                            
$("#DIA").select2({tags:[<?php echo $Dias;?>],tokenSeparators:[","," "]});


<?php 
$Meses = '"Todos",';
for ($i = 1; $i <= 12; $i++) { 
    $Meses .= '"'.substr("0" . $i, -2).'",';
    
 } 
 $Meses = substr($Meses,0,strlen($Meses)-1);
 ?> 
                                            
$("#MES").select2({tags:[<?php echo $Meses;?>],tokenSeparators:[","," "]});

$(".datepicker").each(function () {$(this).datepicker();});
    </script>
<?php } ?>

