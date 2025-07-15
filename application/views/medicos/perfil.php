<div class="main-content side-content pt-0 h-100">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Pacientes</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Pacientes</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL(); ?>cliente">Listado</a></li>
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
                <div class="card custom-card">
                    <div class="card-body text-center">
                        <div class="main-profile-overview widget-user-image text-center">
                            <div class="main-img-user"><img alt="avatar" src="<?php echo BASE_URL(); ?>/tema/images/<?php echo $Info->SEXO;?>.png"></div>
                        </div>
                        <div class="item-user pro-user">
                            <h4 class="pro-user-username text-dark mt-2 mb-0"><?php echo $Info->NOMBRE_COMPLETO;?></h4>
                            <p class="pro-user-desc text-muted mb-1"><?php echo $Info->FECHA2;?></p>
                              
                        </div>
                    </div>
                    <div class="card-footer p-0">
                        <div class="row text-center">
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <h5 class="description-header mb-1">0</h5>
                                    <span class="text-muted">Referidos</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="description-block">
                                    <h5 class="description-header mb-1">$0.00</h5>
                                    <span class="text-muted">Comisión</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="card custom-card">
                    <div class="card-header custom-card-header">
                        <div>
                            <h6 class="card-title mb-0">Datos de Contacto</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="main-profile-contact-list main-profile-work-list">
                            <div class="media">
                                <div class="media-logo bg-light text-dark">
                                    <i class="fe fe-smartphone"></i>
                                </div>
                                <div class="media-body">
                                    <span>WhatsApp</span>
                                    <div>
                                        <?php echo $Info->WHATSAPP;?> 
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-logo bg-light text-dark">
                                    <i class="fe fe-phone"></i>
                                </div>
                                <div class="media-body">
                                    <span>Teléfono Recados</span>
                                    <div>
                                        <?php echo $Info->TELEFONO;?> 
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-logo bg-light text-dark">
                                    <i class="fe fe-mail"></i>
                                </div>
                                <div class="media-body">
                                    <span>Correo</span>
                                    <div>
                                        <?php echo $Info->CORREO;?> 
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-logo bg-light text-dark">
                                    <i class="fe fe-map-pin"></i>
                                </div>
                                <div class="media-body">
                                    <span>Dirección</span>
                                    <div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card custom-card main-content-body-profile">
                    <nav class="nav main-nav-line">
                        <a class="nav-link active" data-toggle="tab" href="#tab1over">Datos Principales</a>
                        <a class="nav-link" data-toggle="tab" href="#tab2rev">Tratamientos</a>
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
                            <div class="media mb-4">
                                <div class="main-img-user mr-3"><img alt="avatar" src="assets/img/users/5.jpg"></div>
                                <div class="media-body">
                                    <div class="media-contact-name mb-1">
                                        <h6 class="mb-0">Julia Carr<small class="text-muted ml-2"><i class="fe fe-clock"></i> Yesterday, 2:00 am</small> </h6>
                                    </div>
                                    <p class="mb-2">Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                                    <ul class="reviewnavs mb-0">
                                        <li><a href="#" title="" class="mr-2"><i class="fe fe-thumbs-up"></i> 794</a></li>
                                        <li><a href="#" title="" class="mr-2"><i class="fe fe-message-square"></i> 253</a></li>
                                        <li><a href="#" title="" class="mr-2"><i class="fa fa-share"></i> 24</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="media mb-4">
                                <div class="main-img-user mr-3"><img alt="avatar" src="assets/img/users/6.jpg"></div>
                                <div class="media-body">
                                    <div class="media-contact-name mb-1">
                                        <h6 class="mb-0">Victor	White<small class="text-muted ml-2"><i class="fe fe-clock"></i> Yesterday, 2:00 am</small> </h6>
                                    </div>
                                    <p class="mb-2">Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it?</p>
                                    <ul class="reviewnavs">
                                        <li><a href="#" title="" class="mr-2"><i class="fe fe-thumbs-up"></i> 794</a></li>
                                        <li><a href="#" title="" class="mr-2"><i class="fe fe-message-square"></i> 253</a></li>
                                        <li><a href="#" title="" class="mr-2"><i class="fa fa-share"></i> 24</a></li>
                                    </ul>
                                    <div class="media">
                                        <div class="main-img-user mr-3"><img alt="avatar" src="assets/img/users/7.jpg"></div>
                                        <div class="media-body">
                                            <div class="media-contact-name mb-1">
                                                <h6 class="mb-0">Megan Mackay<small class="text-muted ml-2"><i class="fe fe-clock"></i> Yesterday, 2:00 am</small> </h6>
                                            </div>
                                            <p class="mb-2">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.</p>
                                            <ul class="reviewnavs">
                                                <li><a href="#" title="" class="mr-2"><i class="fe fe-thumbs-up"></i> 794</a></li>
                                                <li><a href="#" title="" class="mr-2"><i class="fe fe-message-square"></i> 253</a></li>
                                                <li><a href="#" title="" class="mr-2"><i class="fa fa-share"></i> 24</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media mb-4">
                                <div class="main-img-user mr-3"><img alt="avatar" src="assets/img/users/8.jpg"></div>
                                <div class="media-body">
                                    <div class="media-contact-name mb-1">
                                        <h6 class="mb-0">Audrey	Hudson<small class="text-muted ml-2"><i class="fe fe-clock"></i> Yesterday, 2:00 am</small> </h6>
                                    </div>
                                    <p class="mb-2">These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. </p>
                                    <ul class="reviewnavs">
                                        <li><a href="#" title="" class="mr-2"><i class="fe fe-thumbs-up"></i> 794</a></li>
                                        <li><a href="#" title="" class="mr-2"><i class="fe fe-message-square"></i> 253</a></li>
                                        <li><a href="#" title="" class="mr-2"><i class="fa fa-share"></i> 24</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="media">
                                <div class="main-img-user mr-3"><img alt="avatar" src="assets/img/users/9.jpg"></div>
                                <div class="media-body">
                                    <div class="media-contact-name mb-1">
                                        <h6 class="mb-0">Sean Grant<small class="text-muted ml-2"><i class="fe fe-clock"></i> Yesterday, 2:00 am</small> </h6>
                                    </div>
                                    <p class="mb-2">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                    <ul class="reviewnavs mb-0">
                                        <li><a href="#" title="" class="mr-2"><i class="fe fe-thumbs-up"></i> 794</a></li>
                                        <li><a href="#" title="" class="mr-2"><i class="fe fe-message-square"></i> 253</a></li>
                                        <li><a href="#" title="" class="mr-2"><i class="fa fa-share"></i> 24</a></li>
                                    </ul>
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