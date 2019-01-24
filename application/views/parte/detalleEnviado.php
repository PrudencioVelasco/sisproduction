<!-- page content -->
     <div class="right_col" role="main">

       <div class="">

         <div class="clearfix"></div>

         <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="x_panel">
               <div class="x_title">
                 <h3>Detalles del envio a Calidad</h3>

                 <div class="clearfix"></div>
               </div>
               <div class="x_content">
                   <form method="POST"  action="<?= base_url('parte/enviarCalidad') ?>">

                     <div class="row">
                       <div class="col-md-6 col-sm-6 col-xs-6">
                       <div class="form-group">
                         <h4>Número de parte: <?php echo $detalle->numeroparte;?></h4>
                       </div>
                     </div>
                     <div class="col-md-6 col-sm-6 col-xs-6" align="right" >
                     <div class="form-group">
                       <p><h3 <?php if($detalle->idestatus == 1){echo 'style="color:green;"';}?> ><?php echo $detalle->nombrestatus; ?></h3></p>
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
                             <select class="form-control" name="usuariocalidad">
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
                     </div>
                      <div class="row">
                       <div class="col-md-6">
                         <input type="hidden" name="iddetalleparte" value="<?php echo $detalle->iddetalleparte ?>">
                           <button type="submit" class="btn btn-success"><i class="fa fa-pencil-square" aria-hidden="true"></i>
 Modificar</button>
                            <a  class="btn btn-default" href="<?php echo site_url('parte/'); ?>"><i class="fa fa-print" aria-hidden="true"></i>
 Imprimir etiqueta</a>

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
            }else{

            }
        });
    </script>
