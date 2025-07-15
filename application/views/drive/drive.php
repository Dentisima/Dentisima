<section id="content" class="content-sidebar bg-white">

    <aside class="sidebar bg-lighter sidebar-small">
        <div class="text-center clearfix bg-white">
            <a class="btn btn-sm btn-success m-t m-b" 
               data-toggle="modal" href="#modal_etiqueta"
               ><i class="fa fa-plus"></i> Nueva etiqueta</a>
        </div>

        <div class="list-group list-normal m-b-none" id="_lstetiquetas"> 
        </div> 
    </aside>

    <section class="main" id="_seccionarchivos">

    </section>
    <aside class="sidebar sidebar-large bg-lighter padder clearfix" id="_infoacciones">
    </aside>

</aside>

</section>

<div id="modal_etiqueta" class="modal fade">
    <form class="m-b-none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
                    <h4 class="modal-title" id="myModalLabel">Etiqueta nueva</h4> </div>
                <div class="modal-body">
                    <div class="block">
                        <label class="control-label">Introduce el nombre de la nueva etiqueta</label>
                        <input type="text" class="form-control" placeholder="" id="_etiquetanombre"> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" id="_btncerraretiqueta">Cerrar</button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="CrearEtiqueta()" >Crear</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
</div>

<script>

    function CrearEtiqueta() {

        if ($("#_etiquetanombre").val() == "") {
            $("#_etiquetanombre").focus();
            return false;
        }

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>drive/Ajax_nuevo",
            data: {Etiqueta: $("#_etiquetanombre").val()},
            cache: false,
            success: function (result) {

                $("#_etiquetanombre").val("");

                $("#_btncerraretiqueta").click();

                toastr.options = {"closeButton": false, "debug": false, "positionClass": "toast-bottom-right", "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"}
                toastr["success"]("Se ha creado la etiqueta", "Mensaje");

                Etiquetas();
            }
        });
    }

    function Etiquetas() {
    
       $("#_infoacciones").html("");
    
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>drive/Ajax_etiquetas",
            data: {},
            cache: false,
            success: function (result) {
                $("#_lstetiquetas").html(result);
            }
        });
    }

    function Archivos(Id) {
       $("#_infoacciones").html("");
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>drive/Ajax_archivos",
            data: {Id: Id},
            cache: false,
            success: function (result) {
                $("#_seccionarchivos").html(result);
            }
        });
    }


    setTimeout(function () {
        Etiquetas();
    }, 100);

</script>