<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <?php if (isset($_SESSION['err'])): ?>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Permiso!</h4>
                    <p>Acceso denegado para entrar a esta opcion.</p>
                    <hr>
                    <p class="mb-0">Si requiere permiso solicitelo al administrador.</p>
                </div>
            <?php endif ?>
        </div>  
    </div>
    <br />
    <div class="row" align="center">
       
        <img src="<?php echo base_url();?>/assets/images/woorilogo.png" width="60%"/>
         <h1>Sistema de Producción Woori</h1> 
         <small><strong>Versión: 1 Build: 10</strong></small> 
    </div>

</div>
