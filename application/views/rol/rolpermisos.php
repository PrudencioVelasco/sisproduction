

 <!-- page content -->
      <div class="right_col" role="main">

        <div class="">
          
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Administrar Permisos del Rol</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
 

  <div class="row">
                          
                           <div class="col-md-12">
                              <?php if(isset($_SESSION['exito'])): ?>
                                  <script>
                                       swal({
                                           position: 'center',
                                              type: 'success',
                                              title: '<?= $this->session->userdata('exito'); ?>',
                                              showConfirmButton: false,
                                              timer: 1500

                                        })

                                             </script>

                                <?php endif ?>
                            <div class="row">
                                <div class="col-md-6">
                                    
                                       <a  href="<?= base_url('/user/index') ?>" class="btn btn-round btn-default">Usuarios</a>
                                          <a  href="<?= base_url('/rol/index') ?>" class="btn btn-round btn-default">Roles</a>
                                         <a  href="<?= base_url('/permiso/index') ?>" class="btn btn-round btn-default">Permisos</a>
                                       
                                </div>
                                <div class="col-md-6"></div>
                             </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <form method="POST" action="<?= base_url('rol/agregarrolpermiso') ?>">
                                  <?php foreach($permisos as $permiso) { ?>
                                        <div class="form-check form-check-flat">
                                          <label class="form-check-label">
                                            <input type="checkbox" name="permiso[]" class="form-check-input" value="<?php echo $permiso["id"] ?>"  <?php if($permiso["status"]=="1"){echo "checked";} ?>> <?php   if($permiso["description"] != "") { echo $permiso["description"]."  - ".$permiso["uri"]; }else{ echo "Sin descripcion"."  - ".$permiso["uri"];} ?>
                                          </label>
                                        </div>
                                    <?php } ?>
                                    <input type="hidden" name="rol" value="<?php echo $permiso["rol"] ?>">
                                     <button type="submit"  class="btn btn-primary btn-fw">Guardar</button>
                                  </form>
                                </div>
                                <div class="col-md-6">
                                    
                                </div>
                             </div>
                             
                           </div>
                        </div> 



                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
      <!-- /page content -->

 <script src="<?php echo base_url();?>/assets/js/appvue/apppermiso.js"></script> 