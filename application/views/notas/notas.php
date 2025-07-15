<section id="content" class="content-sidebar bg-white">
 
    <aside class="sidebar sidebar-large">
        <div class="padder header-bar bg clearfix">
        
            <div class="btn-group m-t m-b">
                <input type="text" class="input-sm form-control"
                       onkeypress="if (event.keyCode == 13) {
                                   Notas();  
                               }"
                       id="_busqueda" placeholder="Buscar..." value="">
            </div> 
             <button class="btn btn-sm btn-success m-t m-b" title="Nueva nota"
                      onclick="ActualizarDatos(0)"
                    ><i class="fa fa-plus"></i></button>
        </div>
        
        <div class="list-group list-normal m-t-n-xmini scroll-y scrollbar" style="max-height:600px" id="_lstnotas"> 
            
            
            
        </div>
    </aside>
    <!-- /.sidebar --> <!-- .main --> 
    <section class="main">
        <div class="bg-primary clearfix padder m-b">
            <h3 class="m-b" id="_nombrenota"> </h3>
        </div>
        <div class="text-small padder" id="_infonota">
                       
            
        </div> 
    </section>

</section>
      

<span style="display:" id="_ajaxinfo"></span>
<script>
    
    function ActualizarDatos(Id){
        
        $("#_nombrenota").html("");
        
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>notas/Ajax_notas_info",
            data: {Id: Id },
            cache: false,
            success: function (result) {
                
                $("#_infonota").html(result);
            }
        }); 
    }
    
    function Notas() { 

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL(); ?>notas/Ajax_notas",
            data: {Busqueda: $("#_busqueda").val() },
            cache: false,
            success: function (result) {
                
                $("#_lstnotas").html(result);
            }
        });

    }
    
    setTimeout(function () {
        Notas();
    }, 100);
    
</script>