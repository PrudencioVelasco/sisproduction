<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
      <?php if(isset($_SESSION['err'])): ?>
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">Permiso!</h4>
          <p>Usted tiene acceso denegado para entrar a esta menu.</p>
          <hr>
          <p class="mb-0">Si requiere permiso solicitelo al administrador.</p>
        </div>
      <?php endif ?>
    </div>  
  </div>
  <br />
  <!--<div class="">
    <div class="row top_tiles">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-barcode"></i>
          </div>
          <div class="count"><?php //echo $totalarticulo; ?></div>
          <h3>Partes</h3>
          <p>Número total registrado en el sistema.</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-users"></i>
          </div>
          <div class="count"><?php //echo $totalcliente; ?></div>
          <h3>Clientes</h3>
          <p>Número total registrados en el sistema.</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-user"></i>
          </div>
          <div class="count"><?php //echo $totalusuario; ?></div>
          <h3>Usuarios</h3>
          <p>Número total registrados en el sistema.</p>
        </div>
      </div>
    </div>
  </div>-->
</div>