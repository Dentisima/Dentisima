<section class="panel">
    <header class="panel-heading text-right">
        <ul class="nav nav-tabs pull-left">
            <li class="active"><a href="#upInv-1" data-toggle="tab"><i class="fa fa-star-half-o text-default"></i> CIRRUS</a></li>
            <li class=""><a href="#upInv-2" data-toggle="tab"><i class="fa fa-star-half-o text-default"></i> SICAR</a></li>
        </ul>

    </header>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade active in" id="upInv-1">

                <div class="clearfix panel-body">
                    <center>
                        <h5><strong>Cargar Ventas en Cirrus</strong></h5>
                    </center>
                    <p>Sucursal</p>
                    <select id="_suc_cirrus" class="form-control">
                        <option value="">- Selecciona una Sucursal -</option>
                        <?php foreach ($Cirrus as $item) { ?>
                            <option value="<?php echo $item->CODIGO; ?>"><?php echo $item->SUCURSAL; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <p> Archivo XLS</p>
                    <input type="file" id="_suc_file_cirrus" class="form-control">
                    <center >
                        <br><a href="#" class="btn btn-success" onclick="CargarVentas('Cirrus')" id="_ahrefupcirrus">Aceptar</a>
                        <span id="_spanupcirrus"></span>
                    </center>
                </div>

            </div>
            <div class="tab-pane fade" id="upInv-2"> 

                <div class="clearfix panel-body">
                    <center>
                        <h5><strong>Cargar Ventas en SICAR</strong></h5>
                    </center>
                    <p><i class="fa fa-building-o"></i> Empresa</p>

                    <label><input type="radio" name="radioBrands" value="1" onclick="CmbSicarStore(1)" style="width: 20px;height: 20px;border: 1px solid #93D3C4;border-radius: 10px;"> Reina Madre</label>
                    <label><input type="radio" name="radioBrands" value="2" onclick="CmbSicarStore(2)" style="width: 20px;height: 20px;border: 1px solid #93D3C4;border-radius: 10px;"> Maria Linda</label>   
                    <input type="hidden" id="_inpbransicar" value="0">
                    <p><i class="fa fa-hospital-o"></i> Sucursal</p>
                    <select id="_suc_sicar" class="form-control">
                        <option value="">- Selecciona una Sucursal --</option>
                    </select>
                    <br>
                    <p> Archivo XLS</p>
                    <input type="file" id="_suc_file_sicar" class="form-control">
                    <center>
                        <br><a href="#" class="btn btn-success" onclick="CargarVentas('Sicar')" id="_ahrefupsicar">Aceptar</a>
                        <span id="_spanupsicar"></span>
                    </center>
                </div>

            </div>

        </div>
    </div>

</section>
<script>
    function CmbSicarStore(Id) {

        $("#_inpbransicar").val(Id);

        $("#_suc_sicar").html("Cargando...");
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>productos/Ajax_sucursal",
            data: {Id: Id},
            cache: false,
            success: function (result) {
                $("#_suc_sicar").html(result);
            }
        });
    }


    function CargarVentas(Origen) {

        var Org = "";
        var Href = "";
        var Span = "";
        var Marca = "0";
        var FileUp = "";
        var Url = "";

        switch (Origen) {
            case "Cirrus":

                Org = $("#_suc_cirrus").val();
                Url = "<?php echo BASE_URL; ?>cirrus/Ajax_UpVentasExcel";
                FileUp = "_suc_file_cirrus";

                Href = "_ahrefupcirrus";
                Span = "_spanupcirrus";

                break;
            case "Sicar":
                Org = $("#_suc_sicar").val();
                Url = "<?php echo BASE_URL; ?>sicar/Ajax_UpVentasExcel";
                FileUp = "_suc_file_sicar";
                Marca = $("#_inpbransicar").val();

                Href = "_ahrefupsicar";
                Span = "_spanupsicar";
                break;

        }

        if (Org == "") {
            alert("Selecciona la Sucursal");
            return false;
        }

        $("#" + Href).hide();
        $("#" + Span).html("Procesando...");

        var formData = new FormData();

        var archivos = document.getElementById(FileUp);
        var archivo = archivos.files;

        formData.append('Marca', Marca);
        formData.append('Origen', Origen);
        formData.append('Org', Org);
        formData.append('arcXLS', archivo[0]);

        $.ajax({
            type: 'POST',
            url: Url,
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {

                $("#" + Href).show();
                $("#" + Span).html("");
                $("#" + FileUp).val("");

                switch (Origen) {
                    case "Cirrus":
                        $("#_suc_cirrus").val("");
                        break;
                    case "Sicar":
                        $("#_suc_sicar").val("");
                        break;
                }

                toastr.options = {"closeButton": false, "debug": false, "positionClass": "toast-bottom-right", "onclick": null, "showDuration": "300", "hideDuration": "1000", "timeOut": "5000", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut"}
                toastr["success"]("El archivo se proceso correctamente", "Mensaje");

            }
        });


    }

</script>