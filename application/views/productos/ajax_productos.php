<?php 
$Con = 1;
foreach ($Listado as $item) { 
    ?>
    <tr class="Estilo10">
        <td><?php echo $Con++; ?></td>
        <td><?php echo $item->Tipo; ?></td>
        <td><?php 
        echo $item->OrganizationCode." - ".$item->SUCURSAL; 
        ?></td>
        <td><?php 
        if($item->Tipo=="Producto"){
            echo $item->ItemNumber;
        }else{
            echo $item->ValueId; 
        }
        ?></td>
        <td><?php echo $item->Description; ?></td>
        <td><?php echo $item->SubinventoryCode; ?></td>
        <td><?php echo $item->PrimaryUnitOfMeasure; ?></td>
        <td>
            <div align="center">
            <?php if($item->Activo==0){ echo "Sí";}  ?>
            </div>
        </td>
        <td><div align="right">$<?php echo number_format($item->SalesPrice,2,'.',','); ?></div></td> 
        <td><div align="center">
                <?php if($item->Tipo=="Servicio"){ ?>
            <input type="checkbox" id="_chk_<?php echo $item->ID;?>" name="_chk_<?php echo $item->ID;?>" class="_chkidint" value="<?php echo $item->ID;?>" >
                <?php } ?>
            </div>
        </td>
        <td> 
            <?php if($item->Tipo=="Servicio"){ ?>
            <a data-toggle="modal" href="#modal_global" class="btn btn-info btn-xs" title="Actualizar IdIntegraciones"
               onclick="UpIdIntegra(<?php echo $item->ID;?>)"
               ><i class="fa fa-cogs"></i></a> 
            <?php } ?>
        </td>
    </tr>
<?php } ?>  
    
<script>
    function UpIdIntegra(Id){
        
        $("#_divglobal").html("Cargando...");
        $("#_mdglobal").html("Información de Servicio/Producto");

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>productos/Ajax_Integraciones",
            data: {Id: Id},
            cache: false,
            success: function (result) {

                $("#_divglobal").html(result);
            }
        });
    }
</script>