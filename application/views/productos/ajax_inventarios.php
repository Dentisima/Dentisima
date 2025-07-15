<section class="panel">
    <header class="panel-heading text-right">
        <ul class="nav nav-tabs pull-left">
            <li class="active"><a href="#upInv-1" data-toggle="tab"><i class="fa fa-star-half-o text-default"></i> CIRRUS</a></li>
            <li class=""><a href="#upInv-2" data-toggle="tab"><i class="fa fa-star-half-o text-default"></i> SICAR</a></li>
            <li class=""><a href="#upInv-3" data-toggle="tab"><i class="fa fa-star-half-o text-default"></i> MINDBODY</a></li>
        </ul>

    </header>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade active in" id="upInv-1">

                <div class="clearfix panel-body">
                    <center>
                        <h5><strong>Descargar inventario en Cirrus</strong></h5>
                    </center>
                    <p>N° Inventario</p>
                    <input type="text" class="form-control" id="_suc_ninv" value="" >
                    <p>Sucursal</p>
                    <select id="_suc_cirrus" class="form-control">
                        <option value="">- Selecciona una Sucursal -</option>
                        <?php foreach ($Cirrus as $item) { ?>
                            <option value="<?php echo $item->CODIGO; ?>"><?php echo $item->SUCURSAL; ?></option>
                        <?php } ?>
                    </select>
                    <center >
                        <br><a href="#" class="btn btn-success" onclick="GenerarArchivo('Cirrus')" id="_ahrefupcirrus">Generar archivo</a>
                        <span id="_spanupcirrus"></span>
                    </center>
                </div>

            </div>
            <div class="tab-pane fade" id="upInv-2"> 

                <div class="clearfix panel-body">
                    <center>
                        <h5><strong>Descargar inventario en SICAR</strong></h5>
                    </center>
                    <p><i class="fa fa-building-o"></i> Empresa</p>

                    <label><input type="radio" name="radioBrands" value="1" onclick="CmbSicarStore(1)" style="width: 20px;height: 20px;border: 1px solid #93D3C4;border-radius: 10px;"> Reina Madre</label>
                    <label><input type="radio" name="radioBrands" value="2" onclick="CmbSicarStore(2)" style="width: 20px;height: 20px;border: 1px solid #93D3C4;border-radius: 10px;"> Maria Linda</label>   
                    <input type="hidden" id="_inpbransicar" value="0">
                    <p><i class="fa fa-hospital-o"></i> Sucursal</p>
                    <select id="_suc_sicar" class="form-control">
                        <option value="">- Selecciona una Sucursal --</option>
                    </select>
                    <center>
                        <br><a href="#" class="btn btn-success" onclick="GenerarArchivo('Sicar')" id="_ahrefupsicar">Generar archivo</a>
                        <span id="_spanupsicar"></span>
                    </center>
                </div>

            </div>
            <div class="tab-pane fade" id="upInv-3">

                <div class="clearfix panel-body">
                    <center>
                        <h5><strong>Descargar inventario en MINDBODY</strong></h5>
                    </center>
                    <p>Sucursal</p>
                    <select id="_suc_mindbody" class="form-control">
                        <option value="">- Selecciona una Sucursal --</option>
                    </select>
                    <center>
                        <br><a href="#" class="btn btn-success" onclick="GenerarArchivo('MindBody')" id="_ahrefupmindbody">Generar archivo</a>
                        <span id="_spanupmindbody"></span>
                    </center>
                </div>

            </div>
        </div>
    </div>
    <span id="_upinvprocess" style="display: none">
        <iframe id="frameFile" src="" width="100%" height="300"></iframe>
    </span>
</section>
<script>
    function CmbSicarStore(Id) {
        
        $("#_inpbransicar").val(Id);
        
        $("#_suc_sicar").html("Cargando...");
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>productos/Ajax_sucursal",
            data: {Id: Id},
            cache: false,
            success: function (result) {
                $("#_suc_sicar").html(result);
            }
        });
    }

    function SucursalMindbody(Id) {
        if (Id == "") {
            Id = "0";
        }
        $("#_suc_mindbody").html("Cargando...");
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>factura/Ajax_sucursal",
            data: {Id: Id},
            cache: false,
            success: function (result) {
                $("#_suc_mindbody").html(result);
            }
        });
    }
    
    function GenerarArchivo(Origen){
       
       var Org = ""; 
       var Href = "";
       var Span = "";
       var Marca = "0";
       var NumInv = "";
       
       switch(Origen){
           case "Cirrus":
               
               Org = $("#_suc_cirrus").val(); 
               NumInv = $("#_suc_ninv").val();
               
               Href = "_ahrefupcirrus";
               Span = "_spanupcirrus"; 
               
               break;
           case "Sicar":
               Org = $("#_suc_sicar").val();
               Marca = $("#_inpbransicar").val(); 
               
               Href = "_ahrefupsicar";
               Span = "_spanupsicar";
               break;
           case "MindBody":
               Org = $("#_suc_mindbody").val(); 
               Marca = "1";
               
               Href = "_ahrefupmindbody";
               Span = "_spanupmindbody";
               break;
       }
       
       if(Org==""){
           alert("Selecciona la Sucursal");
           return false; 
       }
       if(Origen=="Cirrus"){
           if(NumInv==""){
               alert("N° Inventario Cirrus");
               return false;
           }
       }
       
       $("#"+Href).hide();
       $("#"+Span).html("Procesando...");
       
      // alert(Marca + " - " + Origen + " - " + Org + " " +  NumInv);
       
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>oracle/Ajax_UpInventario",
            data: { Marca:Marca,  Origen:Origen,  Org: Org, NumInv: NumInv  },
            cache: false,
            success: function (result) {
                 
                
                $("#"+Href).show();
                $("#"+Span).html("");
                $("#frameFile").attr("src", "<?php echo BASE_URL(); ?>oracle/ForzaDescarga/"+result);
                
            }
        });
    
    }
    
    setTimeout(function () { SucursalMindbody(1); }, 200);
</script>