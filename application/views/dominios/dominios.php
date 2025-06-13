<section id="content" class="content-sidebar bg-white">
 
    <aside class="sidebar sidebar-large">
        <div class="padder header-bar bg clearfix">
        
            <div class="btn-group m-t m-b">
                <input type="text" class="input-sm form-control"
                       onkeypress="if (event.keyCode == 13) {
                                   Dominios(0,'');  
                               }"
                       id="_busqueda" placeholder="Buscar..." value="">
            </div> 
            <div class="btn-group m-t m-b">
                <!--<button class="btn btn-sm btn-white" onclick="Tickets(0);"><i class="fa fa-search"></i></button>-->
                <button class="btn btn-white btn-sm dropdown-toggle" data-toggle="dropdown" id='_lblbtn'>Tipo <span class='caret'></span></button>
                <ul class="dropdown-menu text-left text-small">
                    <li><a href="#" onclick="Dominios(0,''); ">Todos</a></li>
                    <?php foreach($Dominio as $item){ ?>
                    <li><a href="#" onclick="Dominios(0,'<?php echo $item->CONCEPTO;?>'); "><?php echo $item->CONCEPTO;?></a></li>
                    <?php } ?> 
                </ul>
            </div>
             <button class="btn btn-sm btn-success m-t m-b" title="Nuevo registro"
                      onclick="ActualizarDatos(0)"
                    ><i class="fa fa-plus"></i></button>
        </div>
        
        <div class="list-group list-normal m-t-n-xmini scroll-y scrollbar" style="max-height:600px" id="_lstdominio"> 
            
            
            
        </div>
    </aside>
    <!-- /.sidebar --> <!-- .main --> 
    <section class="main">
        <div class="bg-primary clearfix padder m-b">
            <h3 class="m-b" id="_nombredominio"> </h3>
        </div>
        <div class="text-small padder" id="_infodominio">
                       
            
        </div> 
    </section>
    <!-- /.main --> 
    <!-- .sidebar --> 
    <aside class="sidebar bg-lighter sidebar" id="_infoacciones" style="display:none"></aside>
    <!-- /.sidebar --> 
</section>
      <div id="modal_archivos" class="modal fade">
         <form class="m-b-none">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button> 
                     <h4 class="modal-title">Documentos archivados</h4>
                  </div>
                  <div class="modal-body">
                     <div class="block"> 
                         <label class="control-label">Seleccionar archivo(s)</label> 
                         <input type="file" class="form-control" multiple id="archivos" value=""  ><br>
                         <a href="#" class="btn btn-white btn-sm" onclick="SubirArchivo()" id="_btnsubirarchivo">Subir archivo(s)</a>
                     </div>
                      <ul class="list-group" id="_divlistarchivos"></ul>     
                      
                  </div>
                  <div class="modal-footer"> 
                      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button> 
                  </div>
               </div>
               <!-- /.modal-content --> 
            </div>
         </form>
      </div>

<span style="display:" id="_ajaxinfo"></span>
<script>
    
    function ActualizarDatos(Id){
        
        $("#_nombredominio").html("Nuevo acceso");
        
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>dominios/Ajax_dominios_info",
            data: {Id: Id },
            cache: false,
            success: function (result) {
                
                $("#_infodominio").html(result);
            }
        }); 
    }
    
    function Dominios(Accion,Tipo) {
    
        $("#_lblbtn").html("Tipo <span class='caret'></span>");
        
        if(Tipo!=""){
            $("#_lblbtn").html(Tipo+" <span class='caret'></span>");
        }

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>dominios/Ajax_dominios",
            data: {Accion:Accion, Busqueda: $("#_busqueda").val(), Tipo: Tipo },
            cache: false,
            success: function (result) {
                
                $("#_lstdominio").html(result);
            }
        });

    }
    
    
    setTimeout(function () {
    
        Dominios(0,'');
    }, 100);
    
</script>