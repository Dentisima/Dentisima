<style>
    .scrollme {
        overflow-x: auto;
    }
</style>
<div class="row"> 
    <div class="col-lg-12"> 
        <div class="form-group">
            <label class="col-lg-3 control-label">Tipo</label>
            <div class="col-lg-9"> 
                <input type="text" placeholder="" class="bg-focus form-control" value="<?php echo $Info->Tipo; ?>" readonly> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Organización</label>
            <div class="col-lg-9"> 
                <input type="text" placeholder="" class="bg-focus form-control" value="<?php echo $Info->OrganizationCode; ?>" readonly> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Value Id</label>
            <div class="col-lg-9"> 
                <input type="text" placeholder="" class="bg-focus form-control" value="<?php echo $Info->ValueId; ?>" readonly> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Item Number</label>
            <div class="col-lg-9"> 
                <input type="text" placeholder="" class="bg-focus form-control" value="<?php echo $Info->ItemNumber; ?>" readonly> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Description</label>
            <div class="col-lg-9"> 
                <input type="text" placeholder="" class="bg-focus form-control" value="<?php echo $Info->Description; ?>" readonly> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">SubinventoryCode</label>
            <div class="col-lg-9"> 
                <input type="text" placeholder="" class="bg-focus form-control" value="<?php echo $Info->SubinventoryCode; ?>" readonly> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Unidad Medida</label>
            <div class="col-lg-9"> 
                <input type="text" placeholder="" class="bg-focus form-control" value="<?php echo $Info->PrimaryUnitOfMeasure; ?>" readonly> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Id Integraciones</label>
            <div class="col-lg-6"> 
                <input type="text" placeholder="" class="bg-focus form-control" value="<?php echo $Info->idIntegraciones; ?>" id="_idintegra" > 
            </div>
            <div class="col-lg-3"> 
                <a class="btn btn-success" onclick="UpdateActualizaIdIntegra()" href="javascript:void(0)" title="Actualiza Id Integraciones" >
                    <i class="fa fa-undo"></i>
                </a>
            </div>
        </div>
        <div class="form-group" >
            <div class="col-lg-12 " id="_divresupid"></div>
        </div>
    </div> 
    
    <br>&nbsp;&nbsp;<br>

</div>
<script>
    
    function UpdateActualizaIdIntegra(){
        
        $("#_divresupid").html("Procesando...");
        
        var Codigo = $("#_idintegra").val();
        if(Codigo==""){
            return false;
        }
        
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>oracle/UpIdIntegra",
            data: {Id:<?php echo $Info->ID; ?> ,Org: "<?php echo $Info->OrganizationCode; ?>",ItemNumber: "<?php echo $Info->ItemNumber; ?>", Codigo: Codigo  },
            cache: false,
            success: function (result) {
                $("#_divresupid").html(result);
                
            }
        }); 
    }
    
    
</script>