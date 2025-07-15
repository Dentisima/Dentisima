<section class="panel">
    <header class="panel-heading"> 
        <span class="label pull-right">
            <a class="btn btn-sm btn-white" data-toggle="modal" href="#modal_acceso" 
               onclick="CargaAcceso(0)"><i class="fa fa-plus"></i> Nuevo</a>
        </span> 
        
        <strong>Accesos</strong>
    </header>
    <div>
        <table class="table table-striped m-b-none text-small">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo / Nip</th>
                    <th width="60">Tipo</th>
                    <th width="50">Estatus</th>
                    <th width="100">Acciones</th> 
                </tr>
            </thead>
            <tbody>
                <?php  
                $Total = 0;
                foreach($Lista as $item){    
                $Total++;
                    ?>
                <tr id="_acceso_id_<?php echo $item->ID;?>">  
                    <td><?php echo $item->NOMBRE;?></td>
                    <td><?php echo $item->CORREO;?></td>
                    <td>
                        <label class="label bg-primary m-l-mini"><?php echo $item->TIPO;?></label>
                        
                    </td>
                    <td>
                        <span class="label <?php if($item->ESTATUS==""){ echo "bg-success";}else{ echo "bg-danger";} ?>"><?php echo $item->ESTATUS;?></span>
                        
                    </td>
                    <td class="text-right">
                        <a class="btn btn-default btn-xs" data-toggle="modal" href="#modal_acceso" onclick="CargaAcceso(<?php echo $item->ID;?>)" ><i class="fa fa-pencil"></i></a>
                        &nbsp;
                        <a href="javascript:void(0);" class="btn btn-default btn-xs"  onclick="BajaAcceso(<?php echo $item->ID;?>)" ><i class="fa fa-trash-o"></i></a>
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

    $("#_lblregistros").html("Mostrando <strong><?php echo $Total;?></strong> registros");
    
    
    function CargaAcceso(Id){
        
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>ajustes/AjaxAccesos_Info",
            data: { Id:Id },
            cache: false,
            success: function (result) {
                
                $("#_divmodacceso").html(result);
            }
        });
    }
    
    function BajaAcceso(Id){
        if( confirm("Deseas eliminar el acceso? ")){
            $.ajax({
               type: "POST",
               url: "<?php echo BASE_URL(); ?>ajustes/AjaxAccesos_Baja",
               data: { Id:Id },
               cache: false,
               success: function (result) {
                $("#_acceso_id_"+Id).remove();
                toastr.options = {"closeButton": false, "debug": false, "positionClass": "toast-bottom-right", "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"}
                toastr["error"]("Acceso eliminado", "Mensaje");                
               }
            });
         }
         
    }


</script>