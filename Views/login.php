<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- base:css -->
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url; ?>Assets/img/logo.png" />
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/alertify.core.css" />
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/alertify.default.css" id="toggleCSS" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo text-center">
                                <p>INICIAR SESIÓN</p>
                            </div>
                            <form class="pt-3" id="frmLogin" onsubmit="frmLogin(event)" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="usuario" name="usuario" placeholder="Usuario o Correo Electrónico">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="clave" name="clave" placeholder="Contraseña">
                                </div>
                                <div class="form-group">
                                    <select id="rol" class="form-control" name="rol">
                                        <option value="">Seleccionar</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Cliente</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="btnAccion" type="submit">Login</button>
                                </div>                                
                                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div> -->
                                <div class="text-center mt-4 font-weight-light">
                                    No tienes una cuenta? <a href="<?php echo base_url . '#formulario' ?>" class="text-primary">Crear cuenta</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="<?php echo base_url; ?>Assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?php echo base_url; ?>Assets/js/off-canvas.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/hoverable-collapse.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/template.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/settings.js"></script>
    <!-- endinject -->
    <script src="<?php echo base_url; ?>Assets/js/alertify.min.js"></script>
    <script>
        const base_url = "<?php echo base_url; ?>";
    </script>
    <script src="<?php echo base_url; ?>Assets/js/login.js"></script>
</body>

</html>