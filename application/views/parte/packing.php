 <!-- page content -->
      <div class="right_col" role="main">

        <div class="">

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h3>Agregar número de parte a packing</h3>

                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h5>Numero de parte: <?php echo $detalleparte->numeroparte ?></h5>
                    <form method="POST"  action="<?= base_url('parte/enviarCalidad') ?>">
                    <div class="row">
                      <div class="col-md-4 col-sm-12 col-xs-12">
                         <div class="form-group">
                            <label>* Modelo</label>
                            <input type="text" class="form-control" name="modelo" autcomplete="off" placeholder="Modelo" value="<?php echo set_value('modelo'); ?>">
                            <label style="color:red;"><?php echo form_error('modelo'); ?></label>
                         </div>
                      </div>
                      <div class="col-md-4 col-sm-12 col-xs-12">
                         <div class="form-group">
                            <label>* Revision</label>
                            <input type="text" class="form-control" name="revision" autcomplete="off" placeholder="Revision" value="<?php echo set_value('revision'); ?>">
  <label style="color:red;"><?php echo form_error('revision'); ?></label>
                         </div>
                      </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                         <div class="form-group">
                            <label>* Linea</label>
                            <input type="text" class="form-control" name="linea" autcomplete="off" placeholder="Linea" value="<?php echo set_value('linea'); ?>">
<label style="color:red;"><?php echo form_error('linea'); ?></label>
                         </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-4 col-sm-12 col-xs-12">
                         <div class="form-group">
                            <label>* Número de Pallet</label>
                            <input type="text" class="form-control" name="numeropallet" autcomplete="off" placeholder="Número de Pallet" value="<?php echo set_value('numeropallet'); ?>">
<label style="color:red;"><?php echo form_error('numeropallet'); ?></label>
                         </div>
                      </div>
                  <div class="col-md-4 col-sm-12 col-xs-12">
                         <div class="form-group">
                            <label>* Cantidad de cajas</label>
                            <input type="text" class="form-control" name="cantidadcaja" autcomplete="off" placeholder="Cantidad de cajas" value="<?php echo set_value('cantidadcaja'); ?>">
<label style="color:red;"><?php echo form_error('cantidadcaja'); ?></label>
                         </div>
                      </div>
                      <div class="col-md-4 col-sm-12 col-xs-12">
                         <div class="form-group">
                            <label>* Cliente</label>
                            <input type="text" class="form-control" name="cliente" autcomplete="off" placeholder="Linea" value="<?php echo $detalleparte->nombre ?>" disabled>
                         </div>
                      </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                         <div class="form-group">
                            <label>* Enviarlo a calidad</label>
                            <select class="form-control" name="usuariocalidad">
                              <option value="">Seleccionar</option>
                              <?php
                                foreach ($usuarioscalidad as $value) {
                                 echo '<option value='.$value->idusuario.' >'.$value->name.'</option>';
                                }
                              ?>
                            </select>
                            <label style="color:red;"><?php echo form_error('usuariocalidad'); ?></label>
                         </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-6">
                        <input type="hidden" name="idparte" value="<?php echo $idparte ?>">
                          <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i>
 Enviar</button>
                          <a  class="btn btn-danger" href="<?php echo site_url('parte/'); ?>"><i class="fa fa-ban" aria-hidden="true"></i>
 Cancelar</a>

                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
