<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de Producción Woori</title>
        <!-- plugins:css -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/icowoori.ico"> 
        <!-- Firefox, Opera  -->
        <link rel="icon" href="<?php echo base_url(); ?>/assets/images/icowoori.ico">
        <link rel="stylesheet" href="<?php echo base_url('assets/login/css/vendor.bundle.base.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/login/css/vendor.bundle.addons.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/login/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/login/css/materialdesignicons.min.css'); ?>">
        <!-- SweetAlert -->
        <script src="<?php echo base_url(); ?>/assets/js/sweetalert2/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/js/sweetalert2/dist/sweetalert2.min.css">
    </head>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper auth p-0 theme-two">
                    <div class="row d-flex align-items-stretch">
                        <div class="col-md-4 banner-section d-none d-md-flex align-items-stretch justify-content-center">
                            <div class="slide-content bg-1"> </div>
                        </div>
                        <div class="col-12 col-md-8 h-100 bg-white">
                            <div class="auto-form-wrapper d-flex align-items-center justify-content-center flex-column">
                                <div class="nav-get-started">

                                    <?php if (isset($_SESSION['err'])): ?>
                                        <script>
                                            swal({
                                                type: 'error',
                                                title: 'Oops...',
                                                text: '<?= $this->session->userdata('err'); ?>',
                                                footer: ''
                                            })

                                        </script>

                                    <?php endif ?>
                                </div>
                                <form method="POST"  action="<?= base_url('welcome/login') ?>" >
                                    <h3 class="mr-auto">Hola! bienvenido al Sistema de Producción Woori</h3>
                                    <p class="mb-5 mr-auto">Ingrese sus datos.</p>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="mdi mdi-account-outline"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required="required"> </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="mdi mdi-lock-outline"></i>
                                                </span>
                                            </div>
                                            <input type="password" name="password" class="form-control" placeholder="Contraseña" required="required"> </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary submit-btn" type="submit">Entrar</button>
                                    </div>
                                    <div class="wrapper mt-5 text-gray">
                                        <p class="footer-text">Copyright © <?php echo date("Y"); ?> Woori. Todos los derechos reservados.</p> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
    </body> 
</html>