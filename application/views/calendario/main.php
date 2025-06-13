<div class="main-content side-content pt-0">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <!--<h2 class="main-content-title tx-24 mg-b-5">Calendario Dentísima</h2>-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Calendario</li>
                </ol>
            </div>
            <div class="btn btn-list">
                <a class="btn ripple btn-info" href="#"><i class="fe fe-calendar"></i> Calendario</a>
                <a class="btn ripple btn-primary" href="#" data-toggle="modal" data-target="#modal-generico" onclick="NuevoCliente(0)"><i class="fe fe-plus"></i> Nuevo Paciente</a>
                <a class="btn ripple btn-secondary" href="#" data-toggle="modal" data-target="#modal-generico-busqueda" ><i class="fe fe-user"></i> Buscar Pacientes</a>
                 
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="main-content-calendar">
                            <div class="main-content-left-calendar">
                                <!--<a href="#" data-toggle="modal" data-target="#modal-generico" class="btn ripple btn-secondary btn-block mb-3" onclick="NuevaCita()">
                                    <i class="fa fa-plus"></i> Nueva Cita
                                </a>-->
                                <label class="main-content-label tx-13 tx-bold mg-b-10">Eventos</label>
                                <nav class="nav main-nav-column main-nav-calendar-event mb-4 border">
                                    <a class="nav-link p-2" href="">
                                        <i class="fe fe-calendar tx-primary"></i>
                                        <div>Primeras citas</div>
                                    </a>
                                    <a class="nav-link p-2" href="">
                                        <i class="fe fe-calendar tx-success"></i>
                                        <div>Ortodoncia</div>
                                    </a>
                                    <a class="nav-link p-2" href="">
                                        <i class="fe fe-calendar tx-danger"></i>
                                        <div>Profilaxis</div>
                                    </a>
                                    <a class="nav-link p-2" href="">
                                        <i class="fe fe-calendar tx-warning"></i>
                                        <div>Julio</div>
                                    </a>
                                    <a class="nav-link p-2" href="">
                                        <i class="fe fe-calendar tx-info"></i>
                                        <div>Brenda</div>
                                    </a>
                                    <a class="nav-link p-2" href="">
                                        <i class="fe fe-calendar tx-info"></i>
                                        <div>x</div>
                                    </a>
                                </nav>
                                <div class="fc-datepicker main-datepicker mb-4 mb-lg-0"></div>
                            </div>
                            <div class="main-content-body main-content-body-calendar">
                                <div class="main-calendar" id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
</div>
<script>

    function NuevaCita(Fecha){
        
        $("#div-modal-generico").html("");
        
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>calendario/Ajax_nuevacita",
            data: {Fecha:Fecha },
            cache: false,
            success: function (result) {
                
                $("#div-modal-generico").html(result);
            }
        }); 
    }
</script>