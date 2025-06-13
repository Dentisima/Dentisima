<?php if (isset($Info->ID)) { ?>
    <div class="bg-primary clearfix padder m-b">
        <h3 class="m-b" id="_nombreticket"><?php echo "[" . substr("000000" . $Info->ID, -6) . "] - " . $Info->ASUNTO; ?></h3> 
    </div>
    <div class="text-small padder" >


        <div class="block clearfix">
            Departamento: <strong>&lt;<?php echo $Info->DEPARTAMENTO; ?>&gt;</strong>
            <label class="label bg-inverse m-l-mini">Prioridad: <?php echo $Info->PRIORIDAD; ?></label>
            
            <div class="pull-right inline">
                <?php echo $Info->FECHA2; ?> (<em><?php
                    if ($Info->DIAS_PASO == 0) {
                        echo "Hoy";
                    } else {
                        echo $Info->DIAS_PASO . " días";
                    }
                    ?></em>) 
                    &nbsp;&nbsp; 
                    
                    <a href="#" data-toggle="class" class="<?php if($Info->IMPORTANTE==1){ echo "active";} ?>" id="_idimportante_<?php echo $Info->ID;?>"
                       onclick="AccionImportante(<?php echo $Info->ID;?>)"
                       >
                        <i class="fa fa-star-o text-muted fa-lg text"></i>
                        <i class="fa fa-star text-warning fa-lg text-active"></i>  
                    </a>
                    
                &nbsp;&nbsp;&nbsp;
                <button type="button" class="btn <?php
                if ($Info->ESTATUS == "" || $Info->ESTATUS == "Abierta") {
                    echo "btn-success";
                } else {
                    echo "btn-danger";
                }
                ?>" id="btn-1-estatus" 
                        onclick="AccionTicket()" > 
                    <?php if ($Info->ESTATUS == "" || $Info->ESTATUS == "Abierta") { ?>
                        <i class="fa fa-eye text"></i> <span class="text">Abierto</span>
    <?php } else { ?>
                        <i class="fa fa-eye-slash text"></i> <span class="text">Cerrado</span>
    <?php } ?>
                </button>
                <script>
                    var _estatusticket = "<?php echo $Info->ESTATUS; ?>";
                    var _importante = <?php echo $Info->IMPORTANTE; ?>;

                    function AccionTicket() {

                        if (_estatusticket == "" || _estatusticket == "Abierta") {
                            _estatusticket = "Cerrada";
                            $("#btn-1-estatus").html("<i class='fa fa-eye-slash text'></i> <span class='text'>Cerrado</span>");
                            $("#btn-1-estatus").removeClass("btn-success");
                            $("#btn-1-estatus").addClass("btn-danger");
                        }else if (_estatusticket == "Cerrada") {
                            _estatusticket = "Abierta";
                            $("#btn-1-estatus").html("<i class='fa fa-eye text'></i> <span class='text'>Abierto</span>");
                            $("#btn-1-estatus").removeClass("btn-danger");
                            $("#btn-1-estatus").addClass("btn-success");
                        }

                        $.ajax({
                            type: "POST",
                            url: "<?php echo BASE_URL; ?>tickets/Ajax_estatus",
                            data: {Id: <?php echo $Info->ID; ?>, Estatus: _estatusticket},
                            cache: false,
                            success: function (result) {
                                
                            }
                        });

                    }
                    
                    
                    function AccionImportante(Id) {

                        if (_importante == 0) {
                            _importante = 1;
                        }else {
                            _importante = 0;
                        }
                        

                        $.ajax({
                            type: "POST",
                            url: "<?php echo BASE_URL; ?>tickets/Ajax_importante",
                            data: {Id: <?php echo $Info->ID; ?>, Importante: _importante},
                            cache: false,
                            success: function (result) {
                                
                            }
                        });

                    }
                    
                </script>
            </div>
        </div> 
        
        <?php if($Info->REPORTA!="" || $Info->TELEFONO!="" || $Info->CORREO!=""){ ?>
        <div class="well m-t">
        <?php if($Info->REPORTA!=""){ ?><h4><i class="fa fa-smile-o"></i> <?php echo $Info->REPORTA; ?></h4><br><?php } ?>
        <?php if($Info->TELEFONO!=""){ ?><i class="fa fa-phone"></i> <?php echo $Info->TELEFONO; ?><br><?php } ?>
        <?php if($Info->CORREO!=""){ ?><i class="fa fa-envelope"></i> <?php echo $Info->CORREO; ?><br><?php } ?>
        </div>
        <?php } ?>
        <p><?php echo $Info->ASUNTO;?></p>
        <blockquote>       
            <em>
    <?php echo $Info->NOTAS; ?>
            </em> 
        </blockquote>
        



        <section class="comment-list block" id="_lista_comentarios">

        </section>

        <article class="comment-item media" id="comment-form">

            <input type="file" id="_archivos" multiple style="display:none" value="" >                                     

            <a class="pull-left thumb-small" onclick="$('#_archivos').click()" title="Adjuntar archivos">
                <span class="btn btn-circle btn-success btn-xs"><i class="fa fa-paperclip"></i></span>
            </a>
            <section class="media-body">
                <div   class="m-b-none">
                    <div class="input-group">
                        <input type="text" placeholder="Escribir comentario..." class="form-control" id="_comentario" value=""> 
                        <span class="input-group-btn"> <button class="btn btn-primary" type="button" id="_btncomentar" onclick="SubirComentario()">Comentar</button> </span> 
                    </div>
                </div>
            </section>
        </article>




    </div>

    <script>

        function Comentarios(Limit) {

            $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL; ?>tickets/Ajax_comentarios",
                data: {Id: <?php echo $Info->ID; ?>, Limit: Limit},
                cache: false,
                success: function (result) {
                    if (Limit == 0) {
                        $("#_lista_comentarios").html(result);
                    } else {
                        $("#_lista_comentarios").after(result);
                    }
                }
            });
        }

        function ArchivosComentario(Id) {

            $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL; ?>tickets/Ajax_archivos",
                data: {Id: Id},
                cache: false,
                success: function (result) {
                    $("#_com_archivos_" + Id).html(result);
                }
            });
        }

        function SubirComentario() {

            if ($("#_comentario").val() == "") {
                $("#_comentario").focus();
                return false;
            }

            $("#_btncomentar").html("Enviando...");
            $("#_btncomentar").prop("disabled", true);

            var formData = new FormData();
            formData.append("Id", <?php echo $Info->ID; ?>);

            var archivos = document.getElementById("_archivos");
            var archivo = archivos.files;

            formData.append("TotArchivos", archivo.length);
            formData.append("Comentario", $("#_comentario").val());
            

            for (i = 0; i < archivo.length; i++) {
                formData.append('archivo' + i, archivo[i]);
            }

            $.ajax({
                type: 'POST',
                url: "<?php echo BASE_URL; ?>tickets/Ajax_upload_comentario",
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {

                    Comentarios(1);

                    $("#_btncomentar").html("Comentar");
                    $("#_btncomentar").prop("disabled", false);
                    $("#_archivos").val("");
                    $("#_comentario").val("");

                    toastr.options = {"closeButton": false, "debug": false, "positionClass": "toast-bottom-right", "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"}
                    toastr["success"]("Comentario enviado", "Mensaje");

                }
            });

        }

        // setTimeout(function () {
        Comentarios(0);
        // }, 50);

    </script>
<?php } ?>