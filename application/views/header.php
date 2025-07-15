<?php
$RsUser = $this->session->userdata('_userinfo');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="icon" href="<?php echo BASE_URL(); ?>tema/images/favicon.png" type="image/png"/>
        <title>Dentísima - Admin Panel</title>

        <!---Fontawesome css-->
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/typicons.font/typicons.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/feather/feather.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/css/style.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/css/skins.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/css/dark-style.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/select2/css/select2.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/sidebar/sidebar.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/css/sidemenu-responsive-tabs.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/css/toggle-sidemenu.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/modales.css" rel="stylesheet">
        <style>
            .modal-wide-95 {
                width: 95%;
            }
            .modal-wide-75 {
                width: 75%;
            }
            .modal-wide-50 {
                width: 50%;
            }
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

        </style>
    </head>

    <body class="main-body app sidebar-mini sidenav-toggled">

        <!-- Loader -->
        <div id="global-loader">
            <img src="<?php echo BASE_URL(); ?>tema/images/logo.png" class="loader-img" alt="Loader">
        </div>
        <!-- End Loader -->

        <!-- Page -->
        <div class="page">

            <!-- Main Header-->
            <div class="main-header side-header sticky">
                <div class="container-fluid">
                    <div class="main-header-left">
                        <a class="main-logo" href="<?php echo BASE_URL(); ?>calendario">
                            <img src="<?php echo BASE_URL(); ?>tema/images/logo.png" class="header-brand-img desktop-logo" alt="logo">
                            <img src="<?php echo BASE_URL(); ?>tema/images/logo.png" class="header-brand-img icon-logo" alt="logo">
                            <img src="<?php echo BASE_URL(); ?>tema/images/logo.png" class="header-brand-img desktop-logo theme-logo" alt="logo">
                            <img src="<?php echo BASE_URL(); ?>tema/images/logo.png" class="header-brand-img icon-logo theme-logo" alt="logo">
                        </a>
                        <a href="#" data-toggle="sidebar" class="nav-link nav-link toggle"><span></span></a>
                    </div>
                    <div class="main-header-right">
                        <div class="dropdown d-md-flex header-search">
                            <a class="nav-link icon header-search">
                                <i class="fe fe-search"></i>
                            </a>
                            <div class="dropdown-menu">
                                <div class="main-form-search p-2">
                                    <input class="form-control" placeholder="Search" type="search">
                                    <button class="btn"><i class="fe fe-search"></i></button>
                                </div>
                            </div>
                        </div> 
                        <div class="dropdown main-header-notification">
                            <a class="nav-link icon" href="">
                                <i class="fe fe-bell"></i>
                                <span class="pulse bg-danger"></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="header-navheading">
                                    <p class="main-notification-text">You have 1 unread notification<span class="badge badge-pill badge-primary ml-3">View all</span></p>
                                </div>
                                <div class="main-notification-list">
                                    <div class="media new">
                                        <div class="main-img-user online"><img alt="avatar" src="<?php echo BASE_URL(); ?>tema/assets/img/users/5.jpg"></div>
                                        <div class="media-body">
                                            <p>Congratulate <strong>Olivia James</strong> for New template start</p><span>Oct 15 12:32pm</span>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="main-img-user"><img alt="avatar" src="<?php echo BASE_URL(); ?>tema/assets/img/users/2.jpg"></div>
                                        <div class="media-body">
                                            <p><strong>Joshua Gray</strong> New Message Received</p><span>Oct 13 02:56am</span>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="main-img-user online"><img alt="avatar" src="<?php echo BASE_URL(); ?>tema/assets/img/users/3.jpg"></div>
                                        <div class="media-body">
                                            <p><strong>Elizabeth Lewis</strong> added new schedule realease</p><span>Oct 12 10:40pm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-footer">
                                    <a href="">View All Notifications</a>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown main-profile-menu">
                            <a class="main-img-user" href=""><img alt="avatar" src="<?php echo BASE_URL(); ?>tema/images/user_0.png"></a>
                            <div class="dropdown-menu">
                                <div class="header-navheading">
                                    <h6 class="main-notification-title"><?php echo $this->session->userdata('_usernombre');?></h6>
                                    <p class="main-notification-text"><?php echo $this->session->userdata('_usertipo');?></p>
                                </div>
                                <a class="dropdown-item border-top" href="">
                                    <i class="fe fe-user"></i> Cambiar contraseña
                                </a> 
                                <a class="dropdown-item" href="<?php echo BASE_URL(); ?>login/logout">
                                    <i class="fe fe-power"></i> Salir
                                </a>
                            </div>
                        </div>
                        <div class="dropdown d-md-flex header-settings">
                            <a href="#" class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
                                <i class="fe fe-align-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Main Header-->

            <!-- Sidebar menu-->
            <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
            <aside class="app-sidebar">
                <div class="side-tab-body p-0 border-0" id="parentVerticalTab">
                    <nav class="first-sidemenu">
                        <ul class="resp-tabs-list  ">
                            <li class="home-dashlead" onclick="location.href='<?php echo BASE_URL(); ?>calendario'"><i class="side-menu__icon fe fe-calendar"></i><span class="side-menu__label">Calendario</span></li>
                            <li class="apps-dashlead" onclick="location.href='<?php echo BASE_URL(); ?>cliente'"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Pacientes</span></li>
                            <li class="apps-dashlead" onclick="location.href='<?php echo BASE_URL(); ?>medico'"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Médicos</span></li>
                            <li class="submenu-dashlead"><i class="side-menu__icon fe fe-settings"></i><span class="side-menu__label">Config</span></li>
                        </ul>
                    </nav>
                    <nav class="second-sidemenu">
                        <ul class="resp-tabs-container hor_1">
                            <li class="home-dashlead">
                                <a class="slide-item" href="index.html">Dashboard 01</a>
                                <div class="card custom-card box-shadow-0 border mt-5">
                                    <div class="card-body text-center">
                                        <div class="icon-service bg-primary-transparent rounded-circle text-primary">
                                            <i class="fe fe-user"></i>
                                        </div>
                                        <p class="mb-1 text-muted">Total Users</p>
                                        <h3 class="mb-0">34,789</h3>
                                    </div>
                                </div>
                                <div class="card custom-card box-shadow-0 border">
                                    <div class="card-body text-center">
                                        <div class="icon-service bg-secondary-transparent rounded-circle text-secondary">
                                            <i class="fe fe-trending-up"></i>
                                        </div>
                                        <p class="mb-1 text-muted">Total Sales</p>
                                        <h3 class="mb-0">98,674</h3>
                                    </div>
                                </div>
                                <div class="card custom-card box-shadow-0 border">
                                    <div class="card-body text-center">
                                        <div class="icon-service bg-info-transparent rounded-circle text-info">
                                            <i class="fe fe-dollar-sign"></i>
                                        </div>
                                        <p class="mb-1 text-muted">Total Profits</p>
                                        <h3 class="mb-0"><span>$</span>45,078</h3>
                                    </div>
                                </div>
                            </li>
                           
                        </ul>
                    </nav>
                </div>
            </aside>