<section id="content" class="content-sidebar bg-white">
    <aside class="sidebar bg-lighter padder clearfix">

        <h5>Consulta de Productos</h5>
        <div class="line"></div>
        <label>Tipo</label>
        <div class="row">
            <div class="col-lg-12">
                <select name="TIPO" id="TIPO" class="form-control" >
                    <option value="">- Seleccione -</option>
                    <option value="Producto">Producto</option>
                    <option value="Servicio">Servicio</option> 
                </select> 
            </div>
        </div> 
        <label>Organización</label>
        <div class="row">
            <div class="col-lg-12">
                <select name="ORG" id="ORG" class="form-control" >
                    <option value="">- Seleccione -</option>
                    <?php foreach ($Org as $item) { ?>
                        <option value="<?php echo $item->ORGANIZACION; ?>"><?php echo $item->ORGANIZACION." - ".$item->NOMBRE; ?></option>
                    <?php } ?>

                </select> 
            </div>
        </div> 


        <label class="m-t-mini _evento">Sku / ValueId</label>
        <input type="text" placeholder="" id="sku"
               style="text-align: center"
               class="input-sm form-control" value="" data-date-format="" >

        <label class="m-t-mini _evento">Búsqueda abierta</label>
        <input type="text" placeholder="" id="descripcion"

               class="input-sm form-control" value="" data-date-format="" >
        <label class="m-t-mini _evento">Producto</label>
        <input type="text" placeholder="" id="producto"

               class="input-sm form-control" value="" data-date-format="" >

        <div class="m-t">
            <center>
                <button class="btn btn-sm btn-info" onclick="Consultar()" type="button">Consultar</button>
            </center>
        </div>

        <div class="line"></div>


    </aside>

    <section class="main" id="seccalendario">

        <section class="panel">

            <div class="table-responsive">
                <table class="table table-striped b-t text-small">

                    <thead>
                        <tr>
                            <th height="20" class="Estilo8"><div align="center">N°</div></th>
                    <th height="20" class="Estilo8"><div align="center">Tipo</div></th>
                    <th height="20" class="Estilo8"><div align="center">Sucursal</div></th>
                    <th class="Estilo8"><div align="center">Sku/ValueId</div></th>
                    <th class="Estilo8"><div align="center">Descripción</div></th>
                    <th class="Estilo8"><div align="center">Sub Inv</div></th>
                    <th class="Estilo8"><div align="center">Unidad</div></th>
                    <th class="Estilo8"><div align="center">Baja</div></th>
                    <th class="Estilo8"><div align="center">Precio $</div></th>
                    <th class="Estilo8" colspan="2"> 

                    <div align="">
                        <input type="checkbox" id="chkglobal" value=""  >
                        <a data-toggle="modal" href="#modal_global" class="btn btn-info btn-xs" title="Actualizar IdIntegraciones"
                           onclick="UpIdIntegraMasivo()"
                           ><i class="fa fa-cogs"></i></a> 
                    </div></th>

                    </tr>
                    </thead>

                    <tbody id="_tbodylista">

                    </tbody>
                </table>
            </div>
        </section>

    </section>



</section>
<script>
    function UpIdIntegraMasivo() {
        $("#_divglobal").html("");
        var CadIds = "";
        $("._chkidint:checked").each(function () {
            if ($(this).val() != "") {
                CadIds = CadIds + $(this).val() + ",";
            }
        });

        if (CadIds != "") {
            $("#_divglobal").html("Cargando...");
            $("#_mdglobal").html("Información de Servicio/Producto");

            $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL; ?>productos/Ajax_IdsIntegraciones",
                data: {Ids: CadIds},
                cache: false,
                success: function (result) {

                    $("#_divglobal").html(result);
                }
            });
        }

    }
    function Consultar() {

        $("#_tbodylista").html("Cargando...");

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>productos/Ajax_productos",
            data: {Tipo: $("#TIPO").val(),
                Org: $("#ORG").val(),
                Sku: $("#sku").val(),
                Descripcion: $("#descripcion").val(),
                Producto: $("#producto").val()
            },
            cache: false,
            success: function (result) {

                $("#_tbodylista").html(result);
            }
        });
    }



</script>