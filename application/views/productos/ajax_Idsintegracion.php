<style>
    .scrollme {
        overflow-x: auto;
    }
</style>
<div class="row"> 
    <br>&nbsp;
    <div class="col-lg-12"> 
        <div class="form-group">
            <label class="col-lg-3 control-label">Id Integraciones</label>
            <div class="col-lg-6"> 
                <input type="text" placeholder="" class="bg-focus form-control" value="" id="_idintegra" > 
            </div> 
            <div class="col-lg-3"> 
                <a class="btn btn-success" onclick="UpdateActualizaIdsIntegra()" href="javascript:void(0)" title="Actualiza Id Integraciones" >
                    Actualizar
                </a>
            </div>
        </div>
    </div> 
    <div class="col-lg-12">
        <table class="table table-striped m-b-none text-small">
            <thead>
                <tr>
                    <th>Organización</th>
                    <th>ValueId</th>
                    <th>Description</th>
                    <th>SubinventoryCode</th>
                    <th>Id Integraciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $Ids = "";
                foreach ($Lista as $item) {
                    $Ids .= $item->ID . ",";
                    ?>
                    <tr>
                <input type="hidden" id="_hdOrg_<?php echo $item->ID; ?>" value="<?php echo $item->OrganizationCode; ?>">
                <input type="hidden" id="_hdValue_<?php echo $item->ID; ?>" value="<?php echo $item->ValueId; ?>">
                <td><?php echo $item->OrganizationCode; ?></td>
                <td><?php echo $item->ValueId; ?></td>
                <td><?php echo $item->Description; ?></td>
                <td><?php echo $item->SubinventoryCode; ?></td>
                <td><?php echo $item->idIntegraciones; ?></td>
                </tr>
                <?php
            }
            $Ids = substr($Ids, 0, strlen($Ids) - 1);
            ?>

            </tbody>
        </table>
    </div>
    <div class="col-lg-12" id="_divresupid">

    </div>
    <br>&nbsp;&nbsp;<br>

</div>
<script>

    function UpdateActualizaIdsIntegra() {
        
        $("#_divresupid").html("");
        
        var Codigo = $("#_idintegra").val();

        if (Codigo == "") {
            return false;
        }

        var CadIs = "<?php echo $Ids; ?>";

        var ArCad = CadIs.split(",");

        for (var i = 0; i < ArCad.length; i++) {

            var Id = ArCad[i];
            var Org = $("#_hdOrg_" + Id).val();
            var ItemNumber = $("#_hdValue_" + Id).val();

            $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL(); ?>oracle/UpIdIntegra",
                data: {Id: Id, Org: Org, ItemNumber: ItemNumber, Codigo: Codigo},
                cache: false,
                success: function (result) {
                    $("#_divresupid").append(result);

                }
            });
        }



    }


</script>