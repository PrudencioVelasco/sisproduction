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


                     <div class="row">
                       <div class="col-md-6 col-sm-6 col-xs-6">
                       <div class="form-group">
                         <h4>Número de parte: <?php echo $detalle->numeroparte;?></h4>
                       </div>
                     </div>
                     <div class="col-md-6 col-sm-6 col-xs-6" align="right" >
                     <div class="form-group">
                       <p><h3 <?php
                       if($detalle->idestatus == 4)
                       {
                         echo 'style="color:green;"';
                       }
                       ?> >
                       <?php
                      if($detalle->idestatus == 4)
                      {
                        echo '<i class="fa fa-clock-o" aria-hidden="true"></i>';
                        echo '  EN ESPERA DE VALIDACIÓN';
                      } ?></h3></p>
                     </div>
                   </div>
                     </div>
<hr/>
                     <div class="row">
                       <div class="col-md-4 col-sm-12 col-xs-12">

                           <h3><small>Modelo: </small><?php echo $detalle->modelo ?></h3>

                       </div>
                       <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">

                                <h3><small>Revision: </small><?php echo $detalle->revision ?></h3>

                          </div>
                       </div>
                     <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                               <h3><small>Linea: </small><?php echo $detalle->linea ?></h3>
                          </div>
                       </div>
                     </div>
                      <div class="row">
                       <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <h3><small>Número de Pallet: </small><?php echo $detalle->pallet ?></h3>
                          </div>
                       </div>
                   <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                               <h3><small>Cantidad de cajas: </small><?php echo $detalle->cantidad ?></h3>
                          </div>
                       </div>
                       <div class="col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <h3><small>Cliente: </small><?php echo $detalle->nombre ?></h3>
                           </div>
                       </div>
                     </div>
                      <div class="row">
                       <div class="col-md-6 col-sm-12 col-xs-12">
                         <input type="hidden" name="iddetalleparte" value="<?php echo $detalle->iddetalleparte ?>">
                          <button type="button" data-toggle="modal" data-target="#myModalRechazar" class="btn btn-danger">Rechazar</button>

                       </div>
                     </div>
<hr/>
                     <div class="row">
                       <?php if (1 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>1</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>

                       <?php if (2 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>2</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (3 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>3</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (4 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>4</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                     </div>
                     <div class="row">
                       <?php if (5 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>5</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (6 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>6</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (7 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>7</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (8 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>8</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                     </div>
                     <div class="row">
                       <?php if (9 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>9</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (10 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>10</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (11 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>11</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (12 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>12</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                     </div>
                     <div class="row">
                       <?php if (13 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>13</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (14 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>14</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (15 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>15</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (16 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>16</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                     </div>
                     <div class="row">
                       <?php if (17 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>17</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (18 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>18</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (19 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>19</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                       <?php if (20 <= $detalle->pallet): ?>
                         <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                           <h3>20</h3>
                           <select class="form-control">
                              <option value="" >Localización</option>
                              <?php foreach ($posicionbodega as $value) {
                                // code...
                                echo '<option value="'.$value->idposicion.'" >'.$value->nombreposicion.'</option>';
                              }?>
                           </select>
                         </div>
                       <?php endif; ?>
                     </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>

     <div id="myModalRechazar" class="modal fade" role="dialog">
       <div class="modal-dialog">

         <!-- Modal content-->
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">Agregar motivo de rechazo</h4>
           </div>
<form method="post" id="frmrechazo" action="<?= base_url('bodega/rechazar') ?>">
           <div class="modal-body">

               <div class="row">
                 <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                       <label>* Motivos de cancelación</label>
                       <textarea class="form-control" rows="5" id="motivo" name="motivo" required>
                       </textarea>
                       <label id="msgerror" style="color:red;"></label>
                    </div>
                 </div>
               </div>
           </div>
           <div class="modal-footer">
             <input type="hidden" name="iddetalleparte" value="<?php echo $detalle->iddetalleparte; ?>">
             <input type="hidden" name="operador" value="<?php echo $detalle->idoperador; ?>">
             <button type="button" id="btnsubmit" class="btn btn-primary" >Aceptar</button>
             <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
           </div>
</form>
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
            } else if (estatus == '4') {
              $("#cantidad").attr("disabled", true);
              $("#pallet").attr("disabled", true);
              $("#modelo").attr("disabled", true);
              $("#revision").attr("disabled", true);
              $("#linea").attr("disabled", true);
                $("#usuariocalidad").attr("disabled", true);
            }else{

            }
        });


        $('#btnsubmit').on('click',function()
          {
            var cont = $.trim($("#motivo").val());
            if(cont != ""){
              $('#frmrechazo').submit();
            }else{
              $('#msgerror').text("Campo obligatorio.");
            }
          });



    </script>
