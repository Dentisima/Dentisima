<section id="content" class="content-sidebar bg-white">
    <!-- .sidebar -->
    <aside class="sidebar bg-lighter sidebar-small">
        <div class="text-center clearfix bg-white">
            <a class="btn btn-sm btn-success m-t m-b" data-toggle="modal" href="#modal_ticket"><i class="fa fa-plus"></i> Nuevo ticket</a>
        </div>
        <div class="list-group list-normal m-b-none"> 
            <a href="#" onclick="Tickets(0,'','')" class="list-group-item"><i class="fa fa-fw fa-inbox text-info "></i><span class="badge m-r"><?php echo ($Abierto->TOTAL + $Cerrado->TOTAL);?></span> Inbox</a> 
            <a href="#" onclick="Tickets(0,'','Abierta')" class="list-group-item"><i class="fa fa-fw fa-bookmark text-success"></i><span class="badge m-r"><?php echo $Abierto->TOTAL;?></span> Abiertos</a> 
            <a href="#" onclick="Tickets(0,'','Cerrada')" class="list-group-item"><i class="fa fa-fw fa-bookmark text-danger"></i><span class="badge m-r"><?php echo $Cerrado->TOTAL;?></span> Cerrados</a>
            <a href="#" onclick="Tickets(0,'','Importante')" class="list-group-item"><i class="fa fa-fw fa-star text-warning"></i><span class="badge m-r"><?php echo $Importante->TOTAL;?></span> Importante</a>
            <?php foreach ($Prioridad as $item) { ?>
                <a href="#" onclick="Tickets(0,'','<?php echo $item->CONCEPTO; ?>')" class="list-group-item"><i class="fa fa-fw fa-caret-right"></i>Prioridad <?php echo $item->CONCEPTO; ?></a> 
            <?php } ?>
        </div> 
    </aside>
    <!-- /.sidebar -->
    <!-- .sidebar -->
    <aside class="sidebar sidebar-large"> 

        <div class="padder header-bar bg clearfix">

            <div class="btn-group m-t m-b">
                <input type="text" class="input-sm form-control"
                       onkeypress="if (event.keyCode == 13) {
                                   Tickets(0, '','');
                               }"
                       id="_busqueda" placeholder="#Ticket..." value="">
            </div> 
            <div class="btn-group m-t m-b">
                <!--<button class="btn btn-sm btn-white" onclick="Tickets(0);"><i class="fa fa-search"></i></button>-->
                <button class="btn btn-white btn-sm dropdown-toggle" data-toggle="dropdown" id='_lblbtn'>Depto <span class='caret'></span></button>
                <ul class="dropdown-menu text-left text-small">
                    <li><a href="#" onclick="Tickets(0, '','');
                            ">Todos</a></li>
                    <?php foreach ($Depto as $item) { ?>
                        <li><a href="#" onclick="Tickets(0, '<?php echo $item->CONCEPTO; ?>','');
                                "><?php echo $item->CONCEPTO; ?></a></li>
<?php } ?> 
                </ul>
            </div>

        </div>


        <div class="list-group list-normal m-t-n-xmini scroll-y scrollbar" style="max-height:700px" id="_lsttickets">
        </div>

    </aside>
    <!-- /.sidebar -->
    <!-- .main -->

    <section class="main" id="_infotickets">



    </section>


</section>

<div id="modal_ticket" class="modal fade">
    <form class="m-b-none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
                    <h4 class="modal-title" id="myModalLabel">Detalles del Ticket</h4> </div>
                <div class="modal-body">
                    <div class="block">
                        <label class="control-label">Asunto</label>
                        <input type="text" class="form-control" placeholder="Asunto del ticket..." id="_ticketasunto"> 
                    </div>
                    <div class="block">
                        <label class="control-label">Reporta</label>
                        <input type="text" class="form-control" placeholder="Nombre de quien reporta..." id="_ticketreporta"> 
                    </div>
                    <div class="block">
                        <label class="control-label">Teléfono(s)</label>
                        <input type="text" class="form-control" placeholder="Teléfono(s)..." id="_tickettelefono"> 
                    </div>
                    <div class="block">
                        <label class="control-label">Correo</label>
                        <input type="text" class="form-control" placeholder="Correo electrónico de contacto..." id="_ticketcorreo"> 
                    </div>
                    <div class="block">
                        <label class="control-label">Departamento</label>
                        <select id="_ticketdepartamento" class="form-control">
                            <option value="">- Seleccione -</option>
                            <?php foreach ($Depto as $item) { ?>
                                <option value="<?php echo $item->CONCEPTO; ?>" ><?php echo $item->CONCEPTO; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="block">
                        <label class="control-label">Prioridad</label>
                        <select id="_ticketprioridad" class="form-control">
                            <option value="">- Seleccione -</option>
                            <?php foreach ($Prioridad as $item) { ?>
                                <option value="<?php echo $item->CONCEPTO; ?>" ><?php echo $item->CONCEPTO; ?></option>
                            <?php } ?>

                        </select>

                    </div>
                    <div class="block">
                        <label class="control-label">Mensaje</label>
                        <textarea class="form-control" placeholder="" rows="5"  id="_ticketmensaje"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" id="_btncerrarticket">Cerrar</button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="CrearTicket()" >Crear ticket</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
</div>

<span style="display:" id="_ajaxinfo"></span>
<script>

    function CrearTicket() {

        if ($("#_ticketasunto").val() == "") {
            $("#_ticketasunto").focus(); 
            return false;
        }
  
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>tickets/Ajax_nuevo",
            data: {Asunto: $("#_ticketasunto").val(), Reporta: $("#_ticketreporta").val(),
                   Telefono: $("#_tickettelefono").val(), Correo: $("#_ticketcorreo").val(),
                  Departamento: $("#_ticketdepartamento").val(),
                Prioridad: $("#_ticketprioridad").val(), Mensaje: $("#_ticketmensaje").val()},
            cache: false,
            success: function (result) {

                $("#_ticketasunto").val("");
                $("#_ticketdepartamento").val("");
                $("#_ticketprioridad").val("");
                $("#_ticketmensaje").val("");
                $("#_ticketreporta").val("");
                $("#_tickettelefono").val("");
                $("#_ticketcorreo").val("");

                $("#_btncerrarticket").click();

                toastr.options = {"closeButton": false, "debug": false, "positionClass": "toast-bottom-right", "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"}
                toastr["success"]("Ticket registrado correctamente", "Mensaje");

                Tickets(0, '','');
            }
        });
    }

    function ActualizarDatos(Id) {

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>tickets/Ajax_tickets_info",
            data: {Id: Id},
            cache: false,
            success: function (result) {

                $("#_infotickets").html(result);
            }
        });
    }

    function Tickets(Accion, Depto, Estatus) {

        $("#_lblbtn").html("Depto <span class='caret'></span>");

        if (Depto != "") {
            $("#_lblbtn").html(Depto + " <span class='caret'></span>");
        }


        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>tickets/Ajax_tickets",
            data: {Accion: Accion, Busqueda: $("#_busqueda").val(), Depto: Depto, Estatus: Estatus },
            cache: false,
            success: function (result) {

                $("#_lsttickets").html(result);
            }
        });

    }


    setTimeout(function () {

        Tickets(0, '','Abierta');
    }, 100);

</script>