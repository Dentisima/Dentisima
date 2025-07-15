<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
        <meta name="description" content="Dentisima | Plataforma de Administración">
        <meta name="author" content="">
        <meta name="keywords" content="">

        <link rel="icon" href="<?php echo BASE_URL(); ?>tema/images/favicon.png" type="image/png"/>
        <title>Dentisima | Plataforma de Administración</title>

        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/typicons.font/typicons.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/feather/feather.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/plugins/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/css/style.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/css/skins.css" rel="stylesheet">
        <link href="<?php echo BASE_URL(); ?>tema/assets/css/dark-style.css" rel="stylesheet">

    </head>

    <body class="main-body app">

        <!-- Loader -->
        <div id="global-loader">
            <img src="<?php echo BASE_URL(); ?>tema/assets/img/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- End Loader -->

        <!-- Page -->
        <div class="page main-signin-wrapper">

            <!-- Row -->
            <div class="row text-center pl-0 pr-0 ml-0 mr-0">
                <div class="col-lg-3 d-block mx-auto">
                    <div class="text-center mb-2">
                        <img src="<?php echo BASE_URL(); ?>tema/images/logo.png" class="header-brand-img" alt="logo">
                        <img src="<?php echo BASE_URL(); ?>tema/images/logo.png" class="header-brand-img theme-logos" alt="logo">
                    </div>
                    <div class="card custom-card">
                        <div class="card-body">
                            <h4 class="text-center">Accesar a Dentísima</h4>

                            <div class="form-group text-left">
                                <label>Usuario</label>
                                <input class="form-control" placeholder="" type="text" id="username">
                            </div>
                            <div class="form-group text-left">
                                <label>Contraseña</label>
                                <input class="form-control" placeholder="" type="password" id="pwdacces">
                            </div>
                            
                            <button type="button" class="btn ripple btn-main-primary btn-block"
                                    onclick="ValidAcceso()" 
                                    >Iniciar Sesión</button>
                            <div class="md-form-group" id="_msg"></div>
                            <span id="_result" style="display: none"></span>
                            
                            <script>
                                function ValidAcceso() {

                                    $("#_msg").html("");

                                    var user = $("#username").val();
                                    var pwd = $("#pwdacces").val();

                                    if (user == "" || pwd == "") {
                                        $("#username").focus();
                                        return false;
                                    }

                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo BASE_URL(); ?>login/AjaxAcceso",
                                        data: {user: user, pwd: pwd},
                                        cache: false,
                                        success: function (result) {
                                            $("#_result").html(result);
                                        }
                                    });

                                }

                            </script>
                            <div class="mt-3 text-center">
                                <p class="mb-0"><a href="#" onclick="alert('Si olvidó sus credenciales de acceso, pidale a su supervisor que restablezca sus credenciales de acceso')">Olvide mi contraseña?</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

        </div>
        <script src="<?php echo BASE_URL(); ?>tema/assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo BASE_URL(); ?>tema/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASE_URL(); ?>tema/assets/plugins/ionicons/ionicons.js"></script>
        <script src="<?php echo BASE_URL(); ?>tema/assets/js/custom.js"></script>

    </body>
</html>