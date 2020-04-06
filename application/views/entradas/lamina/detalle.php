<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="row">
              <div class="col-md-12" align="left">
                <h2><strong>DETALLE DE MOVIMIENTOS</strong></h2>
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
                        echo $fecha;?>
                      </strong></td>
                      <td><?php echo date("h:i:s a", strtotime($value->fecharegistro));?></td>
                      <td>

                        <i class="fa fa-sign-in" aria-hidden="true"></i>
                        <span class="label label-success"> <strong  >ENTRADA</strong></span></td>
                        <td><strong style="color:green;"><?php echo number_format($value->cantidad) ?></strong></td>
                        <td>
                          <a  href="javascript:void(0)"  class="edit_button btn btn-primary"
                          data-toggle="modal" data-target="#myModal"
                          data-idparte="<?php echo $value->idparte;?>"
                          data-idlamina="<?php echo $value->idlamina;?>"
                          data-cantidad="<?php echo $value->cantidad;?>"
                          data-numeroparte="<?php echo $value->numeroparte;?>"
                          data-comentarios="<?php echo $value->comentarios;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Modificar</a>
                        <a  href="javascript:void(0)"
                        data-idlamina="<?php echo $value->idlamina;?>"
                        data-idparte="<?php echo $value->idparte;?>"
                        class="delete_button btn btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      Eliminar</a>
                    </td>
                  </tr>

                  <?php
                }
              } if (isset($salidas) && !empty($salidas)) {
                foreach ($salidas as $value) { ?>
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
                       <a  href="javascript:void(0)"  class="edit_button_salida btn btn-primary"
                       data-toggle="modal" data-target="#myModalSalida"
                       data-idparte="<?php echo $value->idparte;?>"
                       data-idlaminasalida="<?php echo $value->idlaminasalida;?>"
                       data-idmaquina="<?php echo $value->idmaquina;?>"
                       data-cantidad="<?php echo $value->cantidad;?>"
                       data-numeroparte="<?php echo $value->numeroparte;?>"
                       data-comentarios="<?php echo $value->comentarios;?>">
                       <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                     Modificar</a>
                     <a  href="javascript:void(0)"
                     data-idlaminasalida="<?php echo $value->idlaminasalida;?>"
                     data-idparte="<?php echo $value->idparte;?>"
                     class="delete_button_salida btn btn-danger">
                     <i class="fa fa-trash" aria-hidden="true"></i>
                   Eliminar</a>
                 </td>
               </tr>

               <?php
             }
           }
           if (isset($devoluciones) && !empty($devoluciones)) {
            foreach ($devoluciones as $value) {
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
                <td><i class="fa fa-undo" aria-hidden="true"></i>
                 <span class="label label-danger">DEVOLUCIONES</span></td>
                 <td><strong style="color:red;"><?php echo number_format($value->cantidad) ?></strong></td>
                 <td>
                  <a  href="javascript:void(0)"  class="edit_button_devolucion btn btn-primary"
                   data-toggle="modal" data-target="#myModalDevolucion"
                   data-idparte="<?php echo $value->idparte;?>"
                   data-idlaminadevolucion="<?php echo $value->idlaminadevolucion;?>"
                   data-idcliente="<?php echo $value->idcliente;?>"
                   data-cantidad="<?php echo $value->cantidad;?>"
                   data-numeroparte="<?php echo $value->numeroparte;?>"
                   data-comentarios="<?php echo $value->comentarios;?>">
                   <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                 Modificar</a>
                 <a  href="javascript:void(0)"
                 data-idlaminadevolucion="<?php echo $value->idlaminadevolucion;?>"
                 data-idparte="<?php echo $value->idparte;?>"
                 class="delete_button_devolucion btn btn-danger">
                 <i class="fa fa-trash" aria-hidden="true"></i>
               Eliminar</a>
             </td>
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

<!--Modal Entradas-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-info-nomodal">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title " id="myModalLabel">MODIFICAR A: <label id="entradanumeroparte"></label> </h3>
      </div>
      <form method="post" action="" id="frmactualizarentrada">
        <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display:none"></div>
          <div class="form-group">
            <input class="form-control idparte" type="hidden" name="idparte">
            <input class="form-control idlamina" type="hidden" name="idlamina">
          </div>
          <div class="form-group">
           <label ><font color="red">*</font> Cantidad</label><br>
           <input type="text" name="cantidad"  class="form-control cantidad">
         </div>
         <div class="form-group">
           <label >Comentarios</label><br>
           <textarea  class="form-control comentarios" name="comentarios"></textarea>
         </div>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-ban'></i> Cerrar</button>
        <button type="button" id="btnupdate" class="btn btn-primary"><i class='fa fa-floppy-o'></i>  Aceptar</button>
      </div>
    </form>
  </div>
</div>
</div>

<!--Modal Salidas-->
<div class="modal fade" id="myModalSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-info-nomodal">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title " id="myModalLabel">MODIFICAR A: <label id="salidanumeroparte"></label> </h3>
      </div>
      <form method="post" action="" id="frmactualizarsalida">
        <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display:none"></div>
          <div class="form-group">
            <input class="form-control idpartesalida" type="hidden" name="idparte">
            <input class="form-control idlaminasalida" type="hidden" name="idlaminasalida">
          </div>
          <div class="form-group">
           <label ><font color="red">*</font> Maquina</label><br>
           <select class="form-control" name="idmaquina" id="maquina">
             <?php
             if(isset($maquinas) && !empty($maquinas)){?>
              <?php foreach($maquinas as $value){?>
                <option value="<?php echo $value->idmaquina ?>"><?php echo $value->nombremaquina ?></option>
              <?php }
            }
            ?>

          </select>
        </div>
        <div class="form-group">
         <label ><font color="red">*</font> Cantidad</label><br>
         <input type="text" name="cantidad"  class="form-control cantidadsalida">
       </div>
       <div class="form-group">
         <label >Comentarios</label><br>
         <textarea  class="form-control comentariossalida" name="comentarios"></textarea>
       </div>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-ban'></i> Cerrar</button>
      <button type="button" id="btnupdatesalida" class="btn btn-primary"><i class='fa fa-floppy-o'></i>  Aceptar</button>
    </div>
  </form>
</div>
</div>
</div>

<div class="modal fade" id="myModalDevolucion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-info-nomodal">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title " id="myModalLabel">DEVOLUCIÓN A: <label id="devolucionnumeroparte"></label> </h3>
            </div>
            <form method="post" action="" id="frmactualizardevolucion">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none"></div>
                    <div class="form-group">
                        <input class="form-control idpartedevolucion" type="hidden" name="idparte">
                        <input class="form-control idlaminadevolucion" type="hidden" name="idlaminadevolucion">
                    </div>
                    <div class="form-group">
                     <label ><font color="red">*</font> Proveedor</label><br>
                     <select class="form-control" name="idcliente" id="cliente">
                         <?php
                         if(isset($clientes) && !empty($clientes)){
                            foreach($clientes as $value){?>
                                <option value="<?php echo $value->idcliente ?>"><?php echo $value->nombre ?></option>
                            <?php }
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group">
                 <label ><font color="red">*</font> Cantidad</label><br>
                 <input type="text" class="form-control cantidaddevolucion" name="cantidad">
             </div>
             <div class="form-group">
                 <label >Comentarios</label><br>
                 <textarea  class="form-control comentariosdevolucion" name="comentarios"></textarea>
             </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-ban'></i> Cerrar</button>
            <button type="button" id="btnupdatedevolucion" class="btn btn-primary"><i class='fa fa-floppy-o'></i>  Aceptar</button>
        </div>
    </form>
</div>
</div>
</div>

<script>
    //Funciones para Entradas
    $(document).on( "click", '.edit_button',function(e) {
      var idparte = $(this).data('idparte');
      var idlamina = $(this).data('idlamina');
      var comentarios = $(this).data('comentarios');
      var cantidad = $(this).data('cantidad');
      var numeroparte = $(this).data('numeroparte');

      $(".idparte").val(idparte);
      $(".idlamina").val(idlamina);
      $(".comentarios").val(comentarios);
      $(".cantidad").val(cantidad);
      $("#entradanumeroparte").text(numeroparte);
    });

    $("#btnupdate").click(function(){
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Laminas/actualizar_entrada');?>",
        data: $('#frmactualizarentrada').serialize(),
        success: function(data) {
          var msg = $.parseJSON(data);
          console.log(msg);
          if((typeof msg.error === "undefined")){
            $(".print-error-msg").css('display','none');
            swal("Operación con Exito.", "Click en el boton!", "success").then(function(){
                location.reload();
              });
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
      var idlamina = $(this).data('idlamina');


      var dataString = 'idparte='+ idparte + '&idlamina=' + idlamina;
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
              url: "<?php echo site_url('Laminas/eliminar_parte_entrada');?>",
              data: dataString,
              success: function(data) {
                var msg = $.parseJSON(data);
                console.log(msg.response);
                if(msg.response == true){
                  swal("Operación con Exito.", "Click en el boton!", "success").then(function(){
                      location.reload();
                    });
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
      var idlaminasalida = $(this).data('idlaminasalida');
      var idmaquinasalida = $(this).data('idmaquina');
      var comentarios = $(this).data('comentarios');
      var cantidad = $(this).data('cantidad');
      var numeroparte = $(this).data('numeroparte');

      $(".idpartesalida").val(idparte);
      $(".idlaminasalida").val(idlaminasalida);
      //$(".idmaquinasalida").val(idmaquinasalida);

      $("#maquina").val(idmaquinasalida);
      $(".comentariossalida").val(comentarios);
      $(".cantidadsalida").val(cantidad);
      $("#salidanumeroparte").text(numeroparte);
    });

    $("#btnupdatesalida").click(function(){
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Laminas/actualizar_salida');?>",
        data: $('#frmactualizarsalida').serialize(),
        success: function(data) {
          var msg = $.parseJSON(data);
          console.log(msg);
          if((typeof msg.error === "undefined")){
            $(".print-error-msg").css('display','none');
            swal("Operación con Exito.", "Click en el boton!", "success").then(function(){
                location.reload();
              });
          }else{
            $(".print-error-msg").css('display','block');
            $(".print-error-msg").html(msg.error);
            setTimeout(function() {$('.print-error-msg').fadeOut('fast');}, 3000);
          }
        }
      });
    });

    $(document).on( "click", '.delete_button_salida',function(e) {
      var idparte = $(this).data('idparte');
      var idlaminasalida = $(this).data('idlaminasalida');


      var dataString = 'idparte='+ idparte + '&idlaminasalida=' + idlaminasalida;


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
            url: "<?php echo site_url('Laminas/eliminar_parte_salida');?>",
            data: dataString,
            success: function(data) {
              var msg = $.parseJSON(data);
              console.log(msg.response);
              if(msg.response == true){
                swal("Operación con Exito.", "Click en el boton!", "success").then(function(){
                    location.reload();
                  });
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

    /*Funciones para DEVOLUCIONES*/
    $(document).on( "click", '.edit_button_devolucion',function(e) {

      var idparte = $(this).data('idparte');
      var idlaminadevolucion = $(this).data('idlaminadevolucion');
      var idcliente = $(this).data('idcliente');
      var cantidad = $(this).data('cantidad');
      var numeroparte = $(this).data('numeroparte');
      var comentarios = $(this).data('comentarios');

      $(".idpartedevolucion").val(idparte);
      $(".idlaminadevolucion").val(idlaminadevolucion);
      //$(".idmaquinasalida").val(idmaquinasalida);

      $("#cliente").val(idcliente);
      $(".comentariosdevolucion").val(comentarios);
      $(".cantidaddevolucion").val(cantidad);
      $("#devolucionnumeroparte").text(numeroparte);
    });

    $("#btnupdatedevolucion").click(function(){
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Laminas/actualizar_devolucion');?>",
        data: $('#frmactualizardevolucion').serialize(),
        success: function(data) {
          var msg = $.parseJSON(data);
          console.log(msg);
          if((typeof msg.error === "undefined")){
            $(".print-error-msg").css('display','none');
            swal("Operación con Exito.", "Click en el boton!", "success").then(function(){
                location.reload();
              });
          }else{
            $(".print-error-msg").css('display','block');
            $(".print-error-msg").html(msg.error);
            setTimeout(function() {$('.print-error-msg').fadeOut('fast');}, 3000);
          }
        }
      });
    });

    $(document).on( "click", '.delete_button_devolucion',function(e) {
      var idparte = $(this).data('idparte');
      var idlaminadevolucion = $(this).data('idlaminadevolucion');


      var dataString = 'idparte='+ idparte + '&idlaminadevolucion=' + idlaminadevolucion;


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
            url: "<?php echo site_url('Laminas/eliminar_parte_devolucion');?>",
            data: dataString,
            success: function(data) {
              var msg = $.parseJSON(data);
              console.log(msg.response);
              if(msg.response == true){
                swal("Operación con Exito.", "Click en el boton!", "success").then(function(){
                    location.reload();
                  });
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
  </script>
