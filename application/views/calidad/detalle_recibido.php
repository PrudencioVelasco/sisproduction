<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Detalles de la parte</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                  <h4><small>Número de parte:</small> <?php echo $detalle->numeroparte;?></h4>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                <div class="form-group">
                  <p><h3 style="color: #228b22;"><i class="fa fa-clock-o" aria-hidden="true"></i> EN ESPERA DE VALIDACIÓN</h3></p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                  <h4><small>Modelo:</small> <?php echo $detalle->modelo;?></h4>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                  <h4><small>Revisión:</small> <?php echo $detalle->revision ?></h4>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                  <h4><small>Linea:</small> <?php echo $detalle->linea ?></h4>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                  <h4><small>Número de Pallet:</small ><?php echo $detalle->pallet ?></h4>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                  <h4><small>Cantidad de cajas:</small> <?php echo $detalle->cantidad ?></h4>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                  <h4><small>Cliente:</small> <?php echo $detalle->nombre ?></h4>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-sendBodega">Enviar</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectPart">Rechazar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal para enviar a Bodega -->
<!-- /. Modal para enviar a Bodega -->
<div class="modal fade" id="modal-sendBodega" tabindex="-1" role="dialog" aria-labelledby="sendBodegaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-sendBodega">Enviar a Bodega</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="sendBodega">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
             <label>Enviarlo a Bodega</label>
             <select class="form-control" name="usuariobodega" id="usuariobodega">
              <option value="">Seleccionar un usuario</option>
              <?php foreach ($usuariosbodega as $value): ?>
              <option value="<?php echo $value->idusuario; ?>"><?php echo $value->name; ?></option>
               <?php endforeach; ?>
             </select>
             <input type="hidden" name="iddetalleparte" value="<?php echo $detalle->iddetalleparte ?>">
             <!--<input type="hidden" name="idparte" value="<?php echo $detalle->idparte ?>">-->
             <input type="hidden" name="idoperador" value="<?php echo $detalle->id ?>">
             <label style="color:red;"><?php echo form_error('usuariobodega'); ?></label>
           </div>
         </div>
       
     </div>
     <div class="modal-footer">
      <button type="button" id="btnCancel" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      <button type="button" id="btnSend" class="btn btn-primary">Enviar</button>
    </div>
    </form>
  </div>
</div>
</div>
<!-- Modal para rechazar -->
<script src="<?php echo base_url();?>/assets/js/validateQuality.js"></script>
<!--<?php var_dump($detalle);?>-->