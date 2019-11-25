<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="row">
              <div class="col-md-12" align="left">
                <h2><strong>Detalle de Movimientos</strong></h2>
              </div>  
            </div>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <table class="table is-bordered is-hoverable" id="datatable2">
              <thead class="text-white bg-dark" >
                <th>Fecha</th>
                <th>Hora</th>
                <th>Tipo Operacion</th> 
                <th>Cantidad</th>   
                <th>Opción</th>
              </thead>
              <tbody>
                <?php 
                if (isset($entradas) && !empty($entradas)) {
                  foreach ($entradas as $value) { ?>
                    <tr class="table-default"> 
                      <td><strong>
                        <?php
                        setlocale(LC_ALL, 'es_ES');
                        $date = new Datetime($value->fecharegistro);
                        $fecha = strftime("%A %d de %B de %Y", $date->getTimestamp());
                        echo $fecha;
                        ?>
                      </strong></td>
                      <td><?php echo date("h:i:s a", strtotime($value->fecharegistro));?></td>
                      <td>
                        <i class="fa fa-sign-in" aria-hidden="true"></i>
                        <span class="label label-success"> <strong  >ENTRADA</strong></span></td>
                        <td><strong style="color:green;"><?php echo number_format($value->cantidad) ?></strong></td> 
                        <td> 
                          <a  href="javascript:void(0)"  class="edit_button btn btn-primary btn-xs"
                          data-toggle="modal" data-target="#myModal"
                          data-idparte="<?php echo $value->idparte;?>"
                          data-idlitho="<?php echo $value->idlitho;?>"
                          data-cantidad="<?php echo $value->cantidad;?>"
                          data-numeroparte="<?php echo $value->numeroparte;?>"
                          data-comentarios="<?php echo $value->comentarios;?>"
                          data-transferencia="<?php echo $value->transferencia;?>">
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Modificar</a>
                        <a  href="javascript:void(0)" 
                        data-idlitho="<?php echo $value->idlitho;?>"
                        data-idparte="<?php echo $value->idparte;?>"
                        class="delete_button btn btn-danger btn-xs">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      Eliminar</a>
                    </td>
                  </tr> 

                  <?php
                }
              } if (isset($salidas) && !empty($salidas)) {
                foreach ($salidas as $value) { 
                  ?>
                  <tr class="table-default"> 
                    <td><strong>
                      <?php
                      setlocale(LC_ALL, 'es_ES');
                      $date = new Datetime($value->fecharegistro);
                      $fecha = strftime("%A %d de %B de %Y", $date->getTimestamp());
                      echo $fecha;?>
                    </strong></td>
                    <td><?php echo date("h:i:s a", strtotime($value->fecharegistro));?></td>
                    <td><i class="fa fa-sign-out" aria-hidden="true"></i>
                     <span class="label label-info"><strong >SALIDAS</strong></span> </td>
                     <td><strong><?php echo number_format($value->cantidad) ?></strong></td> 
                     <td> 
                      <a  href="javascript:void(0)"  class="edit_button_salida btn btn-primary btn-xs"
                      data-toggle="modal" data-target="#myModalSalida"
                      data-idparte="<?php echo $value->idparte;?>"
                      data-idlithosalida="<?php echo $value->idlithosalida;?>"
                      data-cantidad="<?php echo $value->cantidad;?>"
                      data-numeroparte="<?php echo $value->numeroparte;?>"
                      data-comentarios="<?php echo $value->comentarios;?>"
                      data-transferencia="<?php echo $value->transferencia;?>">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    Modificar</a>
                    <a  href="javascript:void(0)" 
                    data-idlithosalida="<?php echo $value->idlithosalida;?>"
                    data-idparte="<?php echo $value->idparte;?>"
                    class="delete_button_salida btn btn-danger btn-xs">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  Eliminar</a>
                </td>
              </tr> 
              <?php
            }
          }
          if (isset($devoluciones) && !empty($devoluciones)) {
            foreach ($devoluciones as $value) { ?>
              <tr class="table-default"> 
                <td><strong>
                  <?php
                  setlocale(LC_ALL, 'es_ES');
                  $date = new Datetime($value->fecharegistro);
                  $fecha = strftime("%A %d de %B de %Y", $date->getTimestamp());
                  echo $fecha;?>
                </strong></td>
                <td><?php echo date("h:i:s a", strtotime($value->fecharegistro));?></td>
                <td><i class="fa fa-undo" aria-hidden="true"></i>
                 <span class="label label-danger">DEVOLUCIONES</span></td>
                 <td><strong style="color:red;"><?php echo number_format($value->cantidad) ?></strong></td> 
                 <td> </td>
               </tr> 
               <?php
             }
           } 
           ?>
         </tbody>
       </table>
     </div>
   </div>
 </div>
</div>
</div>
</div>
<!--Modal entradas-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title " id="myModalLabel">Modificar a: <label id="entradanumeroparte"></label> </h3>
      </div>
      <form method="post" action="" id="frupdateinfo">
        <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display:none"></div>
          <div class="form-group">
            <input class="form-control idparte" type="hidden" name="idparte">
            <input class="form-control idlitho" type="hidden" name="idlitho">
          </div>
          <div class="form-group">
           <label ><font color="red">*</font> Cantidad</label><br>
           <input type="text" name="cantidad"  class="form-control cantidad">
         </div>
         <div class="form-group">
           <label >Comentarios</label><br>
           <textarea  class="form-control comentarios" name="comentarios"></textarea>
         </div> 
         <div class="form-group">
           <label >Transferencia</label><br>
           <textarea  class="form-control transferencia" name="transferencia"></textarea>
         </div> 
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnupdate" class="btn btn-primary">Aceptar</button>
      </div>
    </form>
  </div>
</div>
</div>

<!--Modal salidas-->
<div class="modal fade" id="myModalSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title " id="myModalLabel">Modificar a: <label id="entradanumeroparte_salida"></label> </h3>
      </div>
      <form method="post" action="" id="frmupdateinfosalida">
        <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display:none"></div>
          <div class="form-group">
            <input class="form-control idparte" type="hidden" name="idparte">
            <input class="form-control idlithosalida" type="hidden" name="idlithosalida">
          </div>
          <div class="form-group">
           <label ><font color="red">*</font> Cantidad</label><br>
           <input type="text" name="cantidad"  class="form-control cantidad_salida">
         </div>
         <div class="form-group">
           <label >Comentarios</label><br>
           <textarea  class="form-control comentarios_salida" name="comentarios"></textarea>
         </div> 
         <div class="form-group">
           <label >Transferencia</label><br>
           <textarea  class="form-control transferencia_salida" name="transferencia"></textarea>
         </div> 
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnupdatesalida" class="btn btn-primary">Aceptar</button>
      </div>
    </form>
  </div>
</div>
</div>

<script>
  /*Funciones para ENTRADAS*/
  $(document).on( "click", '.edit_button',function(e) {  
    var idlitho = $(this).data('idlitho');
    var comentarios = $(this).data('comentarios');
    var transferencia = $(this).data('transferencia');
    var cantidad = $(this).data('cantidad');
    var numeroparte = $(this).data('numeroparte');
    
    $(".idlitho").val(idlitho);  
    $(".comentarios").val(comentarios);
    $(".transferencia").val(transferencia);   
    $(".cantidad").val(cantidad);
    $("#entradanumeroparte").text(numeroparte);    
  });

  $("#btnupdate").click(function(){

    $.ajax({
      type: "POST",
      url: "<?php echo site_url('litho/actualizar_entrada');?>",
      data: $('#frupdateinfo').serialize(),
      success: function(data) {
        var msg = $.parseJSON(data);
        console.log(msg);
        if((typeof msg.error === "undefined")){ 
          $(".print-error-msg").css('display','none'); 
          alert(msg.success) ? "" : location.reload(); 
        }else{ 
          $(".print-error-msg").css('display','block'); 
          $(".print-error-msg").html(msg.error);
          setTimeout(function() {$('.print-error-msg').fadeOut('fast');}, 3000);
        }
      }
    });
  });
  
  $(document).on( "click", '.delete_button',function(e) { 
    var idparte = $(this).data('idparte'); 
    var idlitho = $(this).data('idlitho');
    

    var dataString = 'idparte='+ idparte + '&idlitho=' + idlitho;
        //var dataString = 'idlitho=' + idlitho;
        
        Swal.fire({
          title: '¿Eliminar elemento?',
          text: "Realmente desea eliminar el elemento seleccionado",
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              type: "POST",
              url: "<?php echo site_url('litho/eliminar_parte');?>",
              data: dataString,
              success: function(data) {
                var msg = $.parseJSON(data);
                console.log(msg.response);
                if(msg.response == true){
                  alert('Elemento eliminado exitosamente.') ? "" : location.reload();
                }else if(msg.response == 'time'){
                  Swal.fire(
                    'Tiempo excedido',
                    'Ya no puede eliminar la entrada, ha excedido el numero de horas.',
                    'warning'
                    ) 
                }
              }
            });
          }
        })

      });


  /*Funciones para SALIDAS*/

  $(document).on( "click", '.edit_button_salida',function(e) { 
    var idparte = $(this).data('idparte'); 
    var idlithosalida = $(this).data('idlithosalida');
    var comentarios = $(this).data('comentarios');
    var transferencia = $(this).data('transferencia');
    var cantidad = $(this).data('cantidad');
    var numeroparte = $(this).data('numeroparte');

    $(".idparte").val(idparte);  
    $(".idlithosalida").val(idlithosalida);  
    $(".comentarios_salida").val(comentarios);
    $(".transferencia_salida").val(transferencia);   
    $(".cantidad_salida").val(cantidad);
    $("#entradanumeroparte_salida").text(numeroparte);    
  });


  $("#btnupdatesalida").click(function(){

    $.ajax({
      type: "POST",
      url: "<?php echo site_url('litho/actualizar_salida');?>",
      data: $('#frmupdateinfosalida').serialize(),
      success: function(data) {
        var msg = $.parseJSON(data);
        console.log(msg);
        if((typeof msg.error === "undefined")){ 
          $(".print-error-msg").css('display','none'); 
          alert(msg.success) ? "" : location.reload(); 
        }else{ 
          $(".print-error-msg").css('display','block'); 
          $(".print-error-msg").html(msg.error);
          setTimeout(function() {$('.print-error-msg').fadeOut('fast');}, 3000);
        }
      }
    });
  });

  $(document).on( "click", '.delete_button_salida',function(e) { 
        //var idparte = $(this).data('idparte'); 
        var idlithosalida = $(this).data('idlithosalida');
        //console.log(idparte);
        //console.log(idlitho);

        //var dataString = 'idparte='+ idparte + '&idlitho=' + idlitho;
        var dataString = 'idlithosalida=' + idlithosalida;
        
        Swal.fire({
          title: '¿Eliminar elemento?',
          text: "Realmente desea eliminar el elemento seleccionado",
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              type: "POST",
              url: "<?php echo site_url('litho/eliminar_parte_salida');?>",
              data: dataString,
              success: function(data) {
                var msg = $.parseJSON(data);
                console.log(msg);
                if(msg == true){
                  alert("Elemento eliminado exitosamente.") ? "" : location.reload();
                }
              }
            });
          }
        })

      });
    </script>