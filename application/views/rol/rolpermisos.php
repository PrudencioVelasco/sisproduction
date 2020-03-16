

 <!-- page content -->
      <div class="right_col" role="main">

        <div class="">
          
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><strong>Administrar Permisos del Rol</strong></h2>
                  
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
                                <div class="col-md-8">
                                  <br>
                                 <table class="table">
                                  <tr>
                                    <td><strong>Nombre del Permiso</strong></td>
                                    <td><strong>Opción</strong></td>
                                  </tr>
                                  <form method="POST" action="<?= base_url('rol/agregarrolpermiso') ?>">
                                  <?php foreach($permisos as $permiso) { ?>
                                    <tr>
                                      <td>
                                         <?php   if($permiso["description"] != "") { echo $permiso["description"]."  - ".$permiso["uri"]; }else{ echo "Sin descripcion"."  - ".$permiso["uri"];} ?>
                                      </td> 
                                       <td>
                                          <div class="switch">
                                    <label>OFF<input type="checkbox" name="permiso[]" value="<?php echo $permiso["id"] ?>"  <?php if($permiso["status"]=="1"){echo "checked";} ?>><span class="lever"></span>ON</label>
                                </div>

                                       </td>
                                    <?php } ?>
                                    <tr>
                                      <td colspan="2">
                                        <input type="hidden" name="rol" value="<?php echo $permiso["rol"] ?>">
                                     <button type="submit"  class="btn btn-primary btn-fw"><i class='fa fa-floppy-o'></i> Guardar</button>
                                      </td>
                                    </tr>
                                    
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

 <script  data-my_var_1="<?php echo base_url() ?>" src="<?php echo base_url();?>/assets/js/appvue/apppermiso.js"></script> 