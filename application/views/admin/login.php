<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sistema de Producción Litho</title>

  <!-- Bootstrap core CSS -->

  <link href="<?php echo base_url();?>/assets/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?php echo base_url();?>/assets/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>/assets/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?php echo base_url();?>/assets/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url();?>/assets/css/icheck/flat/green.css" rel="stylesheet">


  <script src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>

  <script src="<?php echo base_url();?>/assets/js/sweetalert2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/js/sweetalert2/dist/sweetalert2.min.css">

 
</head>

<body style="background:#fff;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>
    <?php if(isset($_SESSION['err'])): ?>
                    <script>
                         swal({
                            type: 'error',
                            title: 'Oops...',
                            text: '<?= $this->session->userdata('err'); ?>',
                            footer: ''
                          })

                               </script>

                  <?php endif ?>
    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <form method="POST"  action="<?= base_url('welcome/login') ?>" >
            <h1>Sistema de Producción Litho</h1>
            <div>
              <input type="text" autocomplete="off" class="form-control" name="usuario" placeholder="Usuario" required="" />
            </div>
            <div>
              <input type="password" autocomplete="off" class="form-control" name="password" placeholder="Contraseña" required="" />
            </div>
            <div>
                <button class="btn btn-primary submit-btn" type="submit">Entrar</button> 
            </div>
            <div class="clearfix"></div>
            <div class="separator">
 
              <div class="clearfix"></div>
              <br />
              <div> 
<img src="<?php echo base_url();?>/assets/images/woori1.jpeg" width="80%" class="img-fluid" alt="Responsive image">
                <p style="padding-top: 20px;">©<?php echo date('Y') ?> Todos los derechos reservados.</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>  
    </div>
  </div>

</body>

</html>
