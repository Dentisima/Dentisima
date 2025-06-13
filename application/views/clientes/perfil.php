<div class="main-content side-content pt-0 h-100">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Pacientes</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Pacientes</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>cliente">Listado</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                </ol>
            </div>
            <div class="btn btn-list">
                <a class="btn ripple btn-success" href="#"><i class="fe fe-save"></i> Guardar</a>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Row -->
        <div class="row">
            <div class="col-lg-4 col-md-12"> 
                
                <div class="card custom-card our-team">
                    <div class="card-body  ">
                       <div class="main-profile-overview widget-user-image text-center">
                            <div class="main-img-user"><img alt="avatar" src="<?php echo BASE_URL; ?>/tema/images/<?php echo $Info->SEXO;?>.png"></div>
                        </div>
                        <div class="item-user pro-user  text-center">
                            <h4 class="pro-user-username text-dark mt-2 mb-0"><?php echo $Info->NOMBRE_COMPLETO;?></h4>
                            <p class="pro-user-desc text-muted mb-1">&nbsp;</p>
                              
                        </div>

                        <table class="table mg-b-0"> 
                            <tbody>
                                <tr>
                                    <th>Edad:</th>
                                    <td><?php echo $Info->EDAD;?> años</td>
                                </tr> 
                                <tr>
                                    <th>Fecha Nac.:</th>
                                    <td><?php echo $Info->FNACIO2;?></td>
                                </tr> 
                                <tr>
                                    <th>Cumpleaños:</th>
                                    <td>Faltan <?php echo $Info->DIAS;?> días</td>
                                </tr> 
                                <tr>
                                    <th>Sexo:</th>
                                    <td><?php echo $Info->SEXO;?></td>
                                </tr> 
                                <tr>
                                    <th>Teléfono:</th>
                                    <td><?php echo $Info->WHATSAPP;?></td>
                                </tr> 
                                <tr>
                                    <th>Tratamientos:</th>
                                    <td></td>
                                </tr> 
                                
                            </tbody>
                        </table>     
                    </div>
                </div>
                 <div class="card custom-card our-team">
                     <div class="card-body">
                         <button class="btn ripple btn-warning btn-rounded btn-block">Estado de cuenta</button>
                     </div>
                 </div>
                <div class="card custom-card our-team">
                    <div class="card-body"> 

                        <table class="table mg-b-0"> 
                            <tbody>
                                <tr>
                                    <th>Upline nombre:</th>
                                    <td><?php echo $Info->UP_NOMBRE;?></td>
                                </tr> 
                                <tr>
                                    <th>Upline clave:</th>
                                    <td><?php echo $Info->UP_CODIGO;?></td>
                                </tr> 
                                <tr>
                                    <th>Personas invitadas:</th>
                                    <td><?php echo $Info->INVITADOS;?></td>
                                </tr> 
                                <tr>
                                    <th>Ganancias:</th>
                                    <td>$0.00</td>
                                </tr>  
                                
                            </tbody>
                        </table><br>
                        <button class="btn ripple btn-light btn-rounded btn-block">Ver detalle de comisiones</button>
                    </div>
                </div>
           
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card custom-card main-content-body-profile">
                    <nav class="nav main-nav-line">
                        <a class="nav-link active" data-toggle="tab" href="#tab1over">Personales</a>
                        <a class="nav-link" data-toggle="tab" href="#tab2rev">Antecedentes</a>
                        <a class="nav-link" data-toggle="tab" href="#tab3rev">Diagnostico</a>
                        <a class="nav-link" data-toggle="tab" href="#tab4rev">Tratamiento</a>
                        <a class="nav-link" data-toggle="tab" href="#tab5rev">Consulta</a>
                        <a class="nav-link" data-toggle="tab" href="#tab6rev">Edo Cuenta</a>
                    </nav>
                    <div class="card-body tab-content h-100">
                        <div class="tab-pane active" id="tab1over">
                            <div class="main-content-label tx-13 mg-b-20">
                                Personal Information
                            </div>
                            <div class="table-responsive ">
                                <table class="table row table-borderless">
                                    <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Full Name :</strong>Sonia Taylor</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Location :</strong> UK</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Languages :</strong> English, German, Spanish.</td>
                                        </tr>
                                    </tbody>
                                    <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Website :</strong> domain.com</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email :</strong> klomitoor@doamin.com</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone :</strong> +125 254 3562 </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="main-content-label tx-13 mg-b-20">
                                About
                            </div>
                            <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy  when an unknown printer took a galley of type and scrambled Lorem Ipsum has been the industry's standard dummy  when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived .</p>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit Lorem Ipsum has been the industry's standard dummy  when an unknown printer took a galley of type and scrambled in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                            <div class="main-content-label tx-13 mg-b-20">
                                Work &amp; Education
                            </div>
                            <div class="main-profile-work-list">
                                <div class="media">
                                    <div class="media-logo bg-success">
                                        <i class="icon ion-logo-whatsapp"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6>UI/UX Designer at <a href="">Whatsapp</a></h6><span>2016 - present</span>
                                        <p>Past Work: spruko, Inc.</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-logo bg-primary">
                                        <i class="icon ion-logo-buffer"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6>Studied at <a href="">Buffer University</a></h6><span>2002 - 2006</span>
                                        <p>Degree: Bachelor of Science in Computer Science</p>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="tab-pane" id="tab2rev">
                            2
                        </div>
                        <div class="tab-pane" id="tab3rev">
                            3
                        </div>
                        <div class="tab-pane" id="tab4rev">
                            4
                        </div>
                        <div class="tab-pane" id="tab5rev">
                            5
                        </div>
                        <div class="tab-pane" id="tab6rev">
                            
                <div class="table-responsive">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <h6 class="card-title mb-1">ESTADO DE CUENTA</h6>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <div class="dataTables_length" id="example2_length">
                                    <label>
                                        <select name="example2_length"  
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="">Último mes</option>

                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <a class="btn  btn-success" href="#"><i class="fe fe-external-link"></i> Exportar</a>
                            </div>
                        </div>
                        <div class="row"><div class="col-sm-12">
                                <table class="table dataTable no-footer dtr-inline collapsed"  >
                                    <thead>
                                        <tr role="row">
                                            <th>Fecha</th>
                                            <th>Tratamiento</th>
                                            <th>N° Pago</th>
                                            <th>Por Pagar</th>
                                            <th>Pagado</th>
                                            <th>Forma de Pago</th>
                                            <th>Referencia</th>
                                            <th>Notas</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
</div>