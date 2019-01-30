<!-- page content -->
     <div class="right_col" role="main">

       <div class="">

         <div class="clearfix"></div>

         <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="x_panel">
               <div class="x_title">
                 <h3>Detalles del envio</h3>

                 <div class="clearfix"></div>
               </div>
               <div class="x_content">
                   <form method="POST"  action="<?= base_url('parte/reenviarCalidad') ?>">

                     <div class="row">
                       <div class="col-md-6 col-sm-6 col-xs-6">
                       <div class="form-group">
                         <h4>Número de parte: <?php echo $detalle->numeroparte;?></h4>
                       </div>
                     </div>
                     <div class="col-md-6 col-sm-6 col-xs-6" align="right" >
                     <div class="form-group">
                       <p><h3 <?php
                       if($detalle->idestatus == 1)
                       {
                         echo 'style="color:green;"';
                       }elseif($detalle->idestatus == 3){
                         echo 'style="color:red;"';
                       }elseif($detalle->idestatus == 2) {
                         echo 'style="color:green;"';
                       }else {
                         // code...
                       }?> >
                       <?php
                      if($detalle->idestatus == 1)
                      {
                        echo '<i class="fa fa-paper-plane" aria-hidden="true"></i>';
                      }elseif($detalle->idestatus == 3){
                        echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';
                      }elseif($detalle->idestatus == 2) {
                         echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                      }else {
                        // code...
                      }?>


 <?php echo $detalle->nombrestatus; ?></h3></p>
                     </div>
                   </div>
                     </div>

                     <div class="row">
                       <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                             <label>* Modelo</label>
                             <input type="text" class="form-control" name="modelo" id="modelo" autcomplete="off" placeholder="Modelo" value="<?php echo $detalle->modelo ?>">
                             <label style="color:red;"><?php echo form_error('modelo'); ?></label>
                          </div>
                       </div>
                       <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                             <label>* Revision</label>
                             <input type="text" class="form-control" id="revision" name="revision" autcomplete="off" placeholder="Revision" value="<?php echo $detalle->revision ?>">
   <label style="color:red;"><?php echo form_error('revision'); ?></label>
                          </div>
                       </div>
                     <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                             <label>* Linea</label>
                             <input type="text" class="form-control" name="linea" id="linea" autcomplete="off" placeholder="Linea" value="<?php echo $detalle->linea ?>">
 <label style="color:red;"><?php echo form_error('linea'); ?></label>
                          </div>
                       </div>
                     </div>
                      <div class="row">
                       <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                             <label>* Número de Pallet</label>
                             <input type="text" class="form-control" name="numeropallet" id="pallet" autcomplete="off" placeholder="Número de Pallet" value="<?php echo $detalle->pallet ?>">
 <label style="color:red;"><?php echo form_error('numeropallet'); ?></label>
                          </div>
                       </div>
                   <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                             <label>* Cantidad de cajas</label>
                             <input type="text" class="form-control" name="cantidadcaja" id="cantidad" autcomplete="off" placeholder="Cantidad de cajas" value="<?php echo $detalle->cantidad ?>">
 <label style="color:red;"><?php echo form_error('cantidadcaja'); ?></label>
                          </div>
                       </div>
                       <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                             <label>* Cliente</label>
                             <input type="text" class="form-control" name="cliente" autcomplete="off" placeholder="Linea" value="<?php echo $detalle->nombre ?>" disabled>
                          </div>
                       </div>
                     </div>
                     <div class="row">
                     <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                             <label>* Enviarlo a calidad</label>
                             <select class="form-control" id="usuariocalidad" name="usuariocalidad">
                               <option value="">Seleccionar</option>
                               <?php
                                 foreach ($usuarioscalidad as $value) { ?>
                                   <option <?php if($value->idusuario==$detalle->idoperador){echo "selected";} ?> value=" <?php echo $value->idusuario ?>"><?php echo $value->name ?></option>
<?php   }
                               ?>
                             </select>
                             <label style="color:red;"><?php echo form_error('usuariocalidad'); ?></label>
                          </div>
                       </div>
                       <?php if($detalle->idestatus==3){ ?>
                       <div class="col-md-8 col-sm-12 col-xs-12" align="center">
                            <div class="form-group">
                              <label>Motivos de rechazo</label><br>
                              <?php
                                if (isset($dataerrores) && !empty($dataerrores)) {
                                  // code...
                                  foreach ($dataerrores as $value) {

                                    echo "<label style='color:red;'>";
                                    echo "* ".$value->comentariosrechazo." - ".$value->fecharegistro;
                                    echo "</label>";
                                    echo "<br>";
                                    // code...
                                  }
                                }
                              ?>
                            </div>
                        </div>
                      <?php }?>
                     </div>
                      <div class="row">
                       <div class="col-md-6">
                         <input type="hidden" name="iddetalleparte" value="<?php echo $detalle->iddetalleparte ?>">
                          <?php
                            if ($detalle->idestatus == 1) {
                              // code...
                              echo '<button type="submit" name="modificar" class="btn btn-success"><i class="fa fa-pencil-square" aria-hidden="true"></i>
           Modificar</button>';
         }else if ($detalle->idestatus == 3) {
                              // code...
                               echo '<button type="submit" name="reenviar" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i>

           Reenviar</button>';
                            } else if($detalle->idestatus == 2){
                              // code...
                            }else {
                              // code...
                            }

                          ?>
                            <a  class="btn btn-default" href="<?php echo site_url('parte/'); ?>"><i class="fa fa-print" aria-hidden="true"></i>
 Imprimir etiqueta</a>
 <a  class="btn btn-default" href="<?php echo site_url('parte/'); ?>"><i class="fa fa-print" aria-hidden="true"></i>
Imprimir envio</a>

                       </div>
                     </div>

                 </form>
               </div>
             </div>
           </div>
         </div>
       </div>


     </div>

     <script type="text/javascript">
        $(document).ready(function(){
            var estatus = '<?php echo($detalle->idestatus);?>';
          //  alert(estatus);
            if(estatus == '1'){
              $("#cantidad").attr("disabled", false);
              $("#pallet").attr("disabled", false);
              $("#modelo").attr("disabled", false);
              $("#revision").attr("disabled", false);
              $("#linea").attr("disabled", false);
            }else if(estatus == '3'){
              $("#cantidad").attr("disabled", false);
              $("#pallet").attr("disabled", false);
              $("#modelo").attr("disabled", false);
              $("#revision").attr("disabled", false);
              $("#linea").attr("disabled", false);
            }else if (estatus == '2') {
              $("#cantidad").attr("disabled", true);
              $("#pallet").attr("disabled", true);
              $("#modelo").attr("disabled", true);
              $("#revision").attr("disabled", true);
              $("#linea").attr("disabled", true);
                $("#usuariocalidad").attr("disabled", true);
            }else{

            }
        });
    </script>
