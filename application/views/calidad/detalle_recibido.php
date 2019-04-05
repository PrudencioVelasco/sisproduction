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
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Número de parte: <?php echo $detalle->numeroparte; ?></h4>
                                    <h4><small>Número de transferencia:</small> <?php echo $detalle->folio; ?></h4>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Modelo: <strong><?php echo $detalle->modelo; ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Revisión: <strong><?php echo $detalle->revision ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Linea: <strong><?php echo $detalle->nombrelinea ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Cliente: <strong><?php echo $detalle->nombre ?></strong></h4>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12" >
                                <form method="POST" id="frmdetalle"  action="">
                                    <label id="errormsg" style="color:red;"></label>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <!--<th>#</th>-->
                                                <th>Pallet</th>
                                                <th>Cajas</th>
                                                <th>Estatus</th> 
                                                <th></th>  
                                                <th></th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             if(isset($palletcajas) && !empty($palletcajas)){
                                            $i = 1;
                                            foreach ($palletcajas as $value) {
                                                ?>
                                                <tr>
                                                    <td>
                                                       <?php if($value->idestatus == 1 || $value->idestatus == 6 || $value->idestatus == 12){ ?>
                                                        <div class="checkbox-group required">
                                                            <input type="checkbox" name="id[]" value="<?php echo $value->idpalletcajas; ?>">
                                                        </div>
                                                        <?php } ?>
                                                    </td>
                                                    <td><strong><?php echo $i++; ?></strong></td>
                                                    <td><?php echo $value->cajas ?></td>
                                                    <td>
                                                    <?php
                                                    if($value->idestatus == 1){
                                                        echo '<label style="color:green;">EN VALIDACIÓN</label>';
                                                    }else if($value->idestatus == 3){
                                                        echo '<label style="color:red;">R. A PACKING</label>'; 
                                                    }else if($value->idestatus == 4){
                                                        echo '<label style="color:green;">E. A ALMACEN</label>'; 
                                                    }
                                                    else if($value->idestatus == 8){
                                                            echo '<label style="color:green;">EN ALMACEN</label>'; 
                                                        }
                                                else if($value->idestatus == 12){
                                                            echo '<label style="color:green;">EN HOLD</label>'; 
                                                        }
                                                else if($value->idestatus == 6){ ?>
                                                    <a style="color:red;" class="btnquitar" href="<?php echo site_url('calidad/quitarPalletCajas/' . $value->idpalletcajas . '/' . $detalle->iddetalleparte) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                                    <label style="color:red;">R. A CALIDAD</label> 
                                                    <?php }
                                                    else{
                                                          echo '<label>No found</label>'; 
                                                    }
                                                        ?>
                                                    </td>
                                                     <td>
                                                         
                                                         <a target="_blank" href="<?php echo base_url('parte/etiquetaCalidad/' . $detalle->iddetalleparte . '/'.$value->idpalletcajas. '/'.$value->cajas); ?>"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a>
                                                         
                                                     </td>
                                                      <td>
                                                         <?php
                                                         if($value->idestatus == 6){
                                                              echo '<label style="color:red;">'.$value->motivo.'</label>';
                                                         }
                                                         if($value->idestatus == 3){
                                                              echo '<label style="color:red;">'.$value->motivo.'</label>';
                                                         }
                                                         ?>
                                                     </td>
                                                </tr>
                                            <?php } } ?> 

                                        </tbody>
                                    </table>
                                    <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12" >
                                     <div class="form-group"  id="idmotivorechazo">
                                        <label>Seleccionar motivo de rechazo</label>
                                        <select  class="form-control" id="motivo" name="motivorechazo" required> 
                                           <option value="">Seleccionar</option>
                                            <?php
                                                foreach($motivosrechazo as $valuemotivo){
                                                    echo '<option value='.$valuemotivo->idmotivorechazo.'>'.$valuemotivo->motivo.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    </div>
                                    </div> 
                                     <input type="hidden" name="iddetalleparte" value="<?php echo $detalle->iddetalleparte ?>">
                                          
                                    <button type="button" id="btnenviar"   class="btn btn-success btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar a Almacen</button>
                                    <button type="button" id="btnhold"   class="btn btn-info btn-sm"><i class="fa fa-clock-o" aria-hidden="true"></i> Movel a Hold</button>
                                    <button type="button" id="btnrechazar" class="btn btn-danger btn-sm"> <i class="fa fa-ban" aria-hidden="true"></i> Rechazar a Packing</button>
                                </form>
                            </div>
                           
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12" align="right">

<!--                                <a target="_blank" href=" <?php //echo base_url('parte/etiquetaCalidad/' . $detalle->iddetalleparte . ''); ?>" class="btn btn-default"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generar etiqueta</a>-->
                                <a target="_blank" href=" <?php echo base_url('parte/generarPDFEnvio/' . $detalle->iddetalleparte . ''); ?>" class="btn btn-default"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generar envio</a>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
 
 
 
<script>
    $(document).ready(function () {
        $('#idmotivorechazo').hide();
        $('#inputrechazar').hide();
        $('#inputenviar').hide();
        $('#btnenviar').on('click', function () {
            //$('#frmdetalle').submit();
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {
                
                $('#idmotivorechazo').hide(); 
                 
                    
                     //$('#frmdetalle').submit();
                    
                      form = $("#frmdetalle").serialize(); 
                         $.ajax({
                           type: "POST",
                           url: "<?php  echo site_url('calidad/enviarBodegaNew'); ?>",
                           data: form,

                           success: function(data){
                               console.log(data);
                                location.reload(); 
                               //Unterminated String literal fixed
                           }

                         });
                         //event.preventDefault();
                         return false;  //stop the actual form post !important!
                    
                 
            } else {
                $('#errormsg').text("Seleccionar una casilla.");
            }
        });
          $('#btnrechazar').on('click', function () {
            //$('#frmdetalle').submit();
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {
                $('#idmotivorechazo').show(); 
                
                 var optId = $("#motivo").val();
                if(optId != ""){
                      form = $("#frmdetalle").serialize(); 
                         $.ajax({
                           type: "POST",
                           url: "<?php  echo site_url('calidad/rechazarAPackingNew'); ?>",
                           data: form,

                           success: function(data){
                               console.log(data);
                                location.reload(); 
                               //Unterminated String literal fixed
                           }

                         });
                         //event.preventDefault();
                         return false;  //stop the actual form post !important!
                    
                   //$('#frmdetalle').submit();
                }else{
                    $('#errormsg').text("Seleccionar una motivo.");
                }
                    
            } else {
                //alert("ss");
                //errormsg
                $('#errormsg').text("Seleccionar una casilla.");
            }
        });
        
        $('#btnhold').on('click', function () {
            //$('#frmdetalle').submit();
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {
                
                      form = $("#frmdetalle").serialize(); 
                         $.ajax({
                           type: "POST",
                           url: "<?php  echo site_url('calidad/ponerEnHold'); ?>",
                           data: form,

                           success: function(data){
                               console.log(data);
                                location.reload(); 
                               //Unterminated String literal fixed
                           }

                         });
                         //event.preventDefault();
                         return false;  //stop the actual form post !important!
                    
                   //$('#frmdetalle').submit();
                
                    
            } else {
                //alert("ss");
                //errormsg
                $('#errormsg').text("Seleccionar una casilla.");
            }
        });
    });
</script>
<!-- /. Modal para rechazar -->
<script src="<?php echo base_url(); ?>/assets/js/moduleQuality.js"></script>
<!--<?php var_dump($detalle); ?>-->