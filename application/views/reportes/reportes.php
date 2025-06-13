<section id="content" class="content-sidebar bg-white">

    <aside class="sidebar sidebar-large">
        <div class="padder header-bar bg clearfix">            
            <h3>Reportes</h3>
        </div>
        <div class="list-group list-normal m-t-n-xmini scroll-y scrollbar" style="max-height:600px" id="_lstreportes"> 


        </div>
    </aside>
    <!-- /.sidebar --> <!-- .main --> 
    <section class="main" id="_inforeporte">

    </section>

</section>

<span style="display:" id="_ajaxinfo"></span>
<script>

    function ActualizarDatos(Id) {

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>reportes/Ajax_reportes_info",
            data: {Id: Id},
            cache: false,
            success: function (result) {

                $("#_inforeporte").html(result);
            }
        });
    }

    function Reportes() {

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>reportes/Ajax_reportes",
            data: {},
            cache: false,
            success: function (result) {

                $("#_lstreportes").html(result);
            }
        });

    }


    setTimeout(function () {
        Reportes();
    }, 100);

</script>