<div class="main-content side-content pt-0">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Pacientes</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Pacientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Listado</li>
                </ol>
            </div>
            <div class="btn btn-list">
                <a class="btn ripple btn-primary" href="#" data-toggle="modal" data-target="#modal-generico" onclick="NuevoCliente(0)"><i class="fe fe-plus"></i> Nuevo Paciente</a>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-9 col-lg-12">


                <div class="card custom-card">
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" id="_busqueda" placeholder="Buscar por..." type="text"
                                   onkeypress="if (event.keyCode == 13) {
                                                           Busqueda();
                                                       }"
                                   >
                            <span class="input-group-btn">
                                <button class="btn ripple btn-primary" type="button" onclick="Busqueda()">
                                    <span class="input-group-btn"><i class="fa fa-search"></i></span>
                                </button>
                            </span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mg-b-0">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nombre</th>
                                        <th>WhatsApp</th>
                                        <th>Saldo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="_tbodylista">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-xl-3 col-lg-12 d-none d-xl-block custom-leftnav">
                <div class="main-content-left-components">
                    <div class="card custom-card">
                        <div class="card-header custom-card-header">
                            <h6 class="card-title mb-0">Reportes</h6>
                        </div>
                        <div class="card-body component-item">
                            <nav class="nav flex-column">
                                <a class="nav-link" href="#basic">Lista de Pacientes</a>
                                <a class="nav-link" href="#tarns">Saldos Deudores</a>
                            </nav>
                        </div>
                    </div>
                    <div class="card custom-card">
                        <div class="card-body text-center">
                            <div class="icon-service bg-primary-transparent rounded-circle text-primary">
                                <i class="fe fe-user"></i>
                            </div>
                            <p class="mb-1 text-muted">Número de Pacientes</p>
                            <h3 class="mb-0"><?php echo $PacientesTotal->TOTAL; ?></h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
</div>
<script>
    function Busqueda() {

        $("#_tbodylista").html("");

        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>cliente/Ajax_busqueda",
            data: {Busqueda: $("#_busqueda").val()},
            cache: false,
            success: function (result) {
                $("#_tbodylista").html(result);
            }
        });

    }

    setTimeout(function () {
        Busqueda();
    }, 500);

</script>