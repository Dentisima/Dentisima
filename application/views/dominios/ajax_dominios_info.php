<?php if (isset($Info->ID)) { ?>
    <div class="block clearfix">
        <a href="#" class="thumb-mini inline" >
            <i class="fa fa-globe fa-lg "></i>
        </a> 
        &lt;<?php echo $Info->TIPO; ?>&gt; <?php echo $Info->DOMINIO; ?>
        <div class="pull-right inline"><?php echo $Info->ALTA2; ?> (<em>hace <?php echo $Info->DIAS_PASO; ?> días</em>) 
            <a href="#" data-toggle="class"><i class="fa fa-star-o text-muted fa-lg text"></i><i class="fa fa-star text-warning fa-lg text-active"></i></a>
            <div class="btn-group">
                <button class="btn btn-white btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu pull-right">
                    <li><a href="#">Dar de baja</a></li> 
                </ul>
            </div>
        </div>
    </div>
<?php } ?>

<div class="form-horizontal" data-validate="parsley">

    <div class="form-group">
        <label class="col-lg-2 control-label">Tipo</label> 
        <div class="col-lg-3"> 
            <select id="tipo" class="form-control">
                <option value="">- Seleccione -</option>
                <?php
                $infoValor = "";
                if (isset($Info->ID)) {
                    $infoValor = $Info->TIPO;
                }

                foreach ($Dominio as $item) {
                    $selValor = "";
                    if ($infoValor == $item->CONCEPTO) {
                        $selValor = "selected";
                    }
                    ?>
                    <option value="<?php echo $item->CONCEPTO; ?>" <?php echo $selValor; ?> ><?php echo $item->CONCEPTO; ?></option>
                    <?php
                }
                $selValor = "";
                $infoValor = "";
                ?>

            </select>
        </div> 
         
        
    </div> 

    <div class="form-group">
        <label class="col-lg-2 control-label">Dominio</label> 
        <div class="col-lg-10"> 
            <input type="text" id="dominio" placeholder="" class="bg-focus form-control" value="<?php
            if (isset($Info->ID)) {
                echo $Info->DOMINIO;
            }
            ?>" > 
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Alta</label> 
        <div class="col-lg-3"> 
            <input type="text" id="alta" placeholder="dd/mm/aaaa" class="bg-focus form-control" value="<?php
            if (isset($Info->ID)) {
                echo $Info->ALTA2;
            }
            ?>" > 

        </div>
        <label class="col-lg-1 control-label">Expira</label> 
        <div class="col-lg-3"> 
            <input type="text" id="expira" placeholder="dd/mm/aaaa" class="bg-focus form-control" value="<?php
            if (isset($Info->ID)) {
                echo $Info->EXPIRA2;
            }
            ?>" > 

        </div>

    </div>


    <div class="form-group">
        <label class="col-lg-2 control-label">&nbsp;</label> 
        <div class="col-lg-10">
            <div class="line line-dashed m-t-large"></div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label">Url 1</label> 
        <div class="col-lg-8">
            <input type="text" id="url1" class="bg-focus form-control" placeholder="http://" value="<?php
            if (isset($Info->ID)) {
                echo $Info->URL1;
            }
            ?>">
        </div>
        <div class="col-lg-2">
            <?php if(isset($Info->ID)){ if($Info->URL1!=""){ ?>
            <a href="<?php echo $Info->URL1;?>" target="_blank" class="btn btn-info">Abrir link</a>
            <?php }} ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label">Url 2</label> 
        <div class="col-lg-8">
            <input type="text" id="url2" class="bg-focus form-control" placeholder="http://" value="<?php
            if (isset($Info->ID)) {
                echo $Info->URL2;
            }
            ?>">    
        </div>
        <div class="col-lg-2">
            <?php if(isset($Info->ID)){ if($Info->URL2!=""){ ?>
            <a href="<?php echo $Info->URL2;?>" target="_blank" class="btn btn-info">Abrir link</a>
            <?php }} ?>
        </div>
    </div>
    <?php if($this->session->userdata('_usertipo')=="root"){ ?>
    <div class="form-group">
        <label class="col-lg-1 control-label">&nbsp;</label>
        <label class="col-lg-3 control-label">Datos de acceso</label>
        <div class="col-lg-6">
            <div class="line line-dashed m-t-large"></div>
        </div>
        <div class="col-lg-1">
            <?php if(isset($Info->ID)){ ?>
            <button class="btn btn-white" data-toggle="button" onclick="VerAcceso()"> 
                <i class="fa fa-eye-slash text "></i>
                <i class="fa fa-eye text-active text-success"></i> 
            </button>
            <?php } ?>
            
        </div> 
    </div><script>
        var Show = false;
        
    function VerAcceso(){
        
     var cambio = 0;
     
        if(Show==false){
            Show = true;
            $("#_showdatos").show();
            cambio = 1;
        }else if(Show==true){
            $("#_showdatos").hide();
            Show = false;
        }
        
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>dominios/Ajax_show",
            data: {
                Id: <?php if(isset($Info->ID)){ echo $Info->ID; }else{ echo "0";} ?>,
                cambio: cambio
            },
            cache: false,
            success: function (result) { 
                $("#_showdatos").html(result);
            }
        });
        
    }
    </script>
    
    <div id="_showdatos" style="display: <?php if(isset($Info->ID)){ echo "none"; }  ?>">
      <div class="form-group">
        <label class="col-lg-2 control-label">Usuario 1</label> 
        <div class="col-lg-4">
            <input type="text" id="user1" class="bg-focus form-control" value="">    
        </div>
        <label class="col-lg-2 control-label">Contraseña</label> 
        <div class="col-lg-4">
            <input type="text" id="pwd1" class="bg-focus form-control" value="">    
        </div>

      </div>
      <div class="form-group">
        <label class="col-lg-2 control-label">Usuario 2</label> 
        <div class="col-lg-4">
            <input type="text" id="user2" class="bg-focus form-control" value="">    
        </div>
        <label class="col-lg-2 control-label">Contraseña</label> 
        <div class="col-lg-4">
            <input type="text" id="pwd2" class="bg-focus form-control" value="">    
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="form-group">
        <label class="col-lg-2 control-label">&nbsp;</label> 
        <div class="col-lg-10">
            <div class="line line-dashed m-t-large"></div>
        </div>
    </div>
<div class="form-group">
    <label class="col-lg-2 control-label">Notas</label>
    <div class="col-lg-10">
        <textarea id="notas" placeholder="" rows="9" class="form-control parsley-validated" data-trigger="keyup" data-rangelength="[20,200]"><?php
            if (isset($Info->ID)) {
                echo $Info->NOTAS;
            }
            ?></textarea>
        
    </div>
</div>
    


    <div class="form-group">
        <div class="col-lg-8 col-lg-offset-4"> 

            <button type="button" class="btn btn-primary" onclick="GuardaDatos()">Guardar</button> 
        </div>
    </div>
</div>

<script>
    $("#_nombredominio").html("<?php
                   if (isset($Info->ID)) {
                       echo $Info->DOMINIO;
                   } else {
                       echo "Nuevo acceso";
                   }
            ?>");

    function GuardaDatos() {
        
        var cambio = 0;
        
        if(Show==true){
            cambio = 1;
        }

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>dominios/Ajax_guardadominio",
            data: {
                Id: <?php echo $Id; ?>,
                tipo: $("#tipo").val(), 
                dominio: $("#dominio").val(),
                alta: $("#alta").val(),
                expira: $("#expira").val(),
                url1: $("#url1").val(),
                url2: $("#url2").val(),
                notas: $("#notas").val(),
                cambio: cambio
             <?php if($this->session->userdata('_usertipo')=="root"){ ?>
                 ,user1: $("#user1").val(), 
                         pwd1: $("#pwd1").val(),
                         user2: $("#user2").val(),
                         pwd2: $("#pwd2").val()
             <?php } ?>
            },
            cache: false,
            success: function (result) {
                
                $("#_ajaxinfo").html(result);
            }
        });
    }
    
    <?php if (isset($Info->ID)) { ?>
    $("#_infoacciones").show();
    
        var infouser = "";
        
infouser = infouser + "<aside class='sidebar bg-lighter '> ";
infouser = infouser + "    <div class='text-center clearfix bg-white'> ";
infouser = infouser + "        <?php echo $Info->DOMINIO; ?><br><small class='block m-t-mini'><strong> </strong></small> ";
infouser = infouser + "    </div> ";
infouser = infouser + "    <div class='list-group list-normal m-b-none'>  ";
infouser = infouser + "      <a href='#' class='list-group-item'><i class='fa fa-fw fa-calendar'></i><span class='badge m-r'><?php echo $Info->FECHA2; ?></span> Registro</a>  ";
infouser = infouser + "      <a href='#' class='list-group-item'><i class='fa fa-fw fa-random'></i><span class='badge m-r'><?php echo $Info->FACTUALIZA; ?></span> Actualizado</a>  ";
infouser = infouser + "   </div> ";
infouser = infouser + "</aside> ";
        
        $("#_infoacciones").html(infouser);
    <?php }else{ ?>
        $("#_infoacciones").html("");
    <?php } ?>


</script>