<section id="content" class="content-sidebar">

    <aside class="sidebar sidebar-large bg-lighter padder clearfix"><br>
        <section class="panel">
            <header class="panel-heading bg bg-primary"> 
                <strong>Catálogos</strong>
            </header>

            <div class="list-group m-b-small">
                <a href="#" class="list-group-item" onclick="ajaxCategoria('Departamento');"> <i class="fa fa-chevron-right"></i> 
                    <i class="fa fa-fw fa-bookmark"></i> Departamento 
                </a>
                <a href="#" class="list-group-item" onclick="ajaxCategoria('Prioridad');"> <i class="fa fa-chevron-right"></i> 
                    <i class="fa fa-fw fa-sort-alpha-asc"></i> Prioridad
                </a>
                <a href="#" class="list-group-item" onclick="ajaxCategoria('Tipo dominio');"> <i class="fa fa-chevron-right"></i> 
                    <i class="fa fa-fw fa-unlock"></i> Tipo acceso
                </a>
                <a href="#" class="list-group-item" onclick="ajaxCategoria('Procesos');"> <i class="fa fa-chevron-right"></i> 
                    <i class="fa fa-fw fa-bolt"></i> Procesos
                </a> 
                
            </div>
        </section>

        <section class="panel">
            <header class="panel-heading bg bg-primary"> 
                <strong>Sistema</strong>
            </header>

            <div class="list-group m-b-small">
                <a href="#" class="list-group-item" onclick="ajaxAccesos();"> <i class="fa fa-chevron-right"></i> 
                    <i class="fa fa-fw fa-group"></i> Accesos
                </a> 
            </div>
        </section>

    </aside>

    <section class="main">
        <div class="padder m-t m-b" id="_divlistado">

        </div>
    </section>

</section>

<div id="modal_catalogo" class="modal fade">
    <form class="m-b-none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button> 
                    <h4 class="modal-title" id="_divcatalogo"> </h4>
                </div>
                <div class="modal-body">
                    <div class="block"> 
                        <label class="control-label">Descripción</label> 
                        <input type="text" class="form-control" placeholder="" id="itemdescripcion"> 
                    </div>
                </div>
                <div class="modal-body" id="_divactivado" style="display:none">
                    <div class="block"> 
                        <label class="control-label">Activado</label> 
                        <select id="itemactivado" class="form-control">
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                        
                    </div>
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button> 
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" onclick="GuardaCategoria()" >Guardar</button> 
                </div>
            </div>
        </div>
    </form>
</div>

<div id="modal_acceso" class="modal fade">
    <form class="m-b-none">
        <div class="modal-dialog">
            <div class="modal-content" id="_divmodacceso">
                
                

            </div>
        </div>
    </form>
</div>

<script>
    function ajaxCategoria(Categoria) {

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>ajustes/AjaxCatalogo",
            data: {Categoria: Categoria},
            cache: false,
            success: function (result) {

                $("#_divlistado").html(result);
            }
        });

    }

    function ajaxAccesos() {

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>ajustes/AjaxAccesos",
            data: {},
            cache: false,
            success: function (result) {

                $("#_divlistado").html(result);
            }
        });

    }

    setTimeout(function () {
        ajaxCategoria('Departamento');
    }, 200);



</script>