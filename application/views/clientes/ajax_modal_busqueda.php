<?php foreach ($Lista as $item) { ?>
    <tr>
        <td width="50">
            <!--<a class="btn btn-sm btn-success btn-rounded " href="#" data-toggle="modal" data-target="#modal-generico_2"
               onclick="DetallePaciente(<?php echo $item->ID;?>)"
               >Ver</a>-->
           <a class="btn btn-sm btn-success btn-rounded " href="<?php echo BASE_URL(); ?>cliente/perfil/<?php echo $item->ID;?>" target="_blank" 
               >Ver</a> 
        </td>
        <td><?php echo $item->NOMBRE_COMPLETO; ?></td>
        <td width="80"> </td>
        <td width="80"> </td>
        <td width="80"> </td>
        <td width="80">
            $<?php echo number_format($item->SALDO,2,'.',','); ?>
        </td>
        <td width="100">
            ...
        </td>
    </tr>
<?php } ?>

<script>
    function DetallePaciente(Id){
        
        $("#div-modal-generico_2").html("Cargando...");
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>cliente/Ajax_modal_detalle",
            data: {Id:Id},
            cache: false,
            success: function (result) { 

                $("#div-modal-generico_2").html(result);
            }
        });
    }
    
</script>