<section class="panel">
    <header class="panel-heading"> 
        <span class="label pull-right">
            <a class="btn btn-sm btn-white" data-toggle="modal" href="#modal_catalogo" 
               onclick="AltaCategoria('','',0)"><i class="fa fa-plus"></i> Nuevo</a>
        </span> 
        
        <strong id="_lblcategoria"></strong>
    </header>
    <div>
        <table class="table table-striped m-b-none text-small">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <?php if($CategoriaInfo=="Procesos"){ ?>
                    <th width="20">Activado</th>
                    <?php } ?>
                    <th width="100">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $Categoria = "";
                $Total = 0;
                foreach($Lista as $item){ 
                $Categoria = $item->CATEGORIA;    
                $Total++;
                    ?>
                <tr>
                    <td><?php echo $item->CONCEPTO;?></td>
                    <?php if($CategoriaInfo=="Procesos"){ ?>
                    <td><?php echo $item->ACTIVADO;?></td>
                    <?php } ?>
                    <td class="text-right">
                        <a class="btn btn-default btn-xs" data-toggle="modal" href="#modal_catalogo" onclick="AltaCategoria('<?php echo $item->CONCEPTO;?>','<?php echo $item->ACTIVADO;?>',<?php echo $item->ID;?>)" ><i class="fa fa-pencil"></i></a>
                        &nbsp;
                        <a href="javascript:void(0);" class="btn btn-default btn-xs"  onclick="BajaCategoria('<?php echo $item->CONCEPTO;?>',<?php echo $item->ID;?>)" ><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
<footer class="panel-footer">
    <div class="row">
        <div class="col-sm-4 hidden-xs">
            <small class="text-muted inline m-t-small m-b-small"  id="_lblregistros"></small>
        </div>
        <div class="col-sm-3 text-center">  </div>
        <div class="col-sm-5 text-right text-center-sm">
            
        </div>
    </div>
</footer>
        
    </div>
</section>
<script>
    
    <?php
    if($Categoria==""){$Categoria = $CategoriaInfo; }
    ?>
    
    $("#_lblcategoria").html("<?php echo $Categoria;?>");
    $("#_divcatalogo").html("<?php echo $Categoria;?>");
    $("#_lblregistros").html("Mostrando <strong><?php echo $Total;?></strong> registros");
    
    var Id = 0;
    var Accion = "Alta";
    function AltaCategoria(Item,Activado,IdItem){
        
        $("#_divactivado").hide();
        <?php if($CategoriaInfo=="Procesos"){ ?>
                $("#_divactivado").show();
        <?php } ?>
        
        
        $("#itemdescripcion").val(Item);
        $("#itemactivado").val(Activado);
        
        Id = IdItem;
        
        if(Item!=""){
            Accion = "Update";   
        }
        
    }
    
    function BajaCategoria(Item,IdItem){
        
        $("#itemdescripcion").val("");
        $("#itemactivado").val("Si");
        Id = IdItem;
        
        if(Item!=""){
            Accion = "Borrado";   
        }
        
        if(confirm("Deseas eliminar la categoría?")){
            GuardaCategoria();
        }
    }
    
    function GuardaCategoria(){
        
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>ajustes/AjaxCatalogoRegistro",
            data: {Accion: Accion, Id:Id, Categoria: "<?php echo $Categoria;?>", Item: $("#itemdescripcion").val(), Activado:$("#itemactivado").val()  },
            cache: false,
            success: function (result) {
                
                ajaxCategoria("<?php echo $Categoria;?>");
                $("#itemdescripcion").val("");
                $("#itemactivado").val("Si");
                Accion = "Alta";
                Id = 0;
                
                toastr.options = {"closeButton": false, "debug": false, "positionClass": "toast-bottom-right", "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"}
                toastr["success"]("Categoría guardada", "Mensaje");
                
            }
        });
    }
</script>