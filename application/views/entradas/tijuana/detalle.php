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
                        echo $fecha;
                        ?>
                      </strong></td>
                      <td><?php echo date("h:i:s a", strtotime($value->fecharegistro));?></td>
                      <td>
                        <i class="fa fa-sign-in" aria-hidden="true"></i>
                        <span class="label label-success"> <strong  >ENTRADA</strong></span></td>
                        <td><strong style="color:green;"><?php echo number_format($value->cantidad) ?></strong></td>
                        <td>
                          <a  href="javascript:void(0)"  class="edit_button btn btn-primary"
                          data-toggle="modal" data-target="#myModal"
                          data-idrevision="<?php echo $value->idrevision;?>"
                          data-idlitho="<?php echo $value->idlitho;?>"
                          data-cantidad="<?php echo $value->cantidad;?>"
                          data-numeroparte="<?php echo $value->numeroparte;?>"
                          data-comentarios="<?php echo $value->comentarios;?>"
                          data-transferencia="<?php echo $value->transferencia;?>">
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Modificar</a>
                        <a  href="javascript:void(0)"
                        data-idlitho="<?php echo $value->idlitho;?>"
                        data-idrevision="<?php echo $value->idrevision;?>"
                        class="delete_button btn btn-danger">
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
                      <a  href="javascript:void(0)"  class="edit_button_salida btn btn-primary"
                      data-toggle="modal" data-target="#myModalSalida"
                      data-idrevision="<?php echo $value->idrevision;?>"
                      data-idlithosalida="<?php echo $value->idlithosalida;?>"
                      data-cantidad="<?php echo $value->cantidad;?>"
                      data-numeroparte="<?php echo $value->numeroparte;?>"
                      data-comentarios="<?php echo $value->comentarios;?>"
                      data-transferencia="<?php echo $value->transferencia;?>">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    Modificar</a>
                    <a  href="javascript:void(0)"
                    data-idlithosalida="<?php echo $value->idlithosalida;?>"
                    data-idrevision="<?php echo $value->idrevision;?>"
                    class="delete_button_salida btn btn-danger">
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
                 <td>
                  <a  href="javascript:void(0)"  class="edit_button_devolucion btn btn-primary"
                  data-toggle="modal" data-target="#myModalDevolucion"
                  data-idrevision="<?php echo $value->idrevision;?>"
                  data-idlithodevolucion="<?php echo $value->idlithodevolucion;?>"
                  data-cantidad="<?php echo $value->cantidad;?>"
                  data-numeroparte="<?php echo $value->numeroparte;?>"
                  data-comentarios="<?php echo $value->comentarios;?>"
                  data-transferencia="<?php echo $value->transferencia;?>">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                Modificar</a>
                <a  href="javascript:void(0)"
                data-idlithodevolucion="<?php echo $value->idlithodevolucion;?>"
                data-idrevision="<?php echo $value->idrevision;?>"
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
<!--Modal entradas-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-info-nomodal">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title " id="myModalLabel">MODIFICAR A: <label id="entradanumeroparte"></label> </h3>
      </div>
      <form method="post" action="" id="frupdateinfo">
        <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display:none"></div>
          <div class="form-group">
            <input class="form-control idrevision" type="hidden" name="idrevision">
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
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-ban'></i>  Cerrar</button>
        <button type="button" id="btnupdate" class="btn btn-primary"><i class='fa fa-floppy-o'></i> Aceptar</button>
      </div>
    </form>
  </div>
</div>
</div>

<!--Modal salidas-->
<div class="modal fade" id="myModalSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-info-nomodal">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title " id="myModalLabel">MODIFICAR A: <label id="entradanumeroparte_salida"></label> </h3>
      </div>
      <form method="post" action="" id="frmupdateinfosalida">
        <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display:none"></div>
          <div class="form-group">
            <input class="form-control idrevisionsalida" type="hidden" name="idrevision">
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
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-ban'></i>  Cerrar</button>
        <button type="button" id="btnupdatesalida" class="btn btn-primary"><i class='fa fa-floppy-o'></i> Aceptar</button>
      </div>
    </form>
  </div>
</div>
</div>


<!--Modal devoluciones-->
<div class="modal fade" id="myModalDevolucion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-info-nomodal">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title " id="myModalLabel">DEVOLUCIÓN A: <label id="entradanumeroparte_devolucion"></label> </h3>
      </div>
      <form method="post" action="" id="frmupdateinfodevolucion">
        <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display:none"></div>
          <div class="form-group">
            <input class="form-control idrevisiondevolucion" type="hidden" name="idrevision">
            <input class="form-control idlithodevolucion" type="hidden" name="idlithodevolucion">
          </div>
          <div class="form-group">
           <label ><font color="red">*</font> Cantidad</label><br>
           <input type="text" class="form-control cantidad_devolucion" name="cantidad">
         </div>
         <div class="form-group">
           <label >Comentarios</label><br>
           <textarea  class="form-control comentarios_devolucion" name="comentarios"></textarea>
         </div>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-ban'></i> Cerrar</button>
        <button type="button" id="btnupdatedevolucion" class="btn btn-primary"><i class='fa fa-floppy-o'></i> Aceptar</button>
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
    var idrevision = $(this).data('idrevision');

    $(".idlitho").val(idlitho);
    $(".comentarios").val(comentarios);
    $(".transferencia").val(transferencia);
    $(".cantidad").val(cantidad);
    $(".idrevision").val(idrevision);
    $("#entradanumeroparte").text(numeroparte);
  });

  $("#btnupdate").click(function(){

    $.ajax({
      type: "POST",
      url: "<?php echo site_url('litho/actualizar_entrada_tijuana');?>",
      data: $('#frupdateinfo').serialize(),
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
    var idrevision = $(this).data('idrevision');
    var idlitho = $(this).data('idlitho');


    var dataString = 'idrevision='+ idrevision + '&idlitho=' + idlitho;

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
    var idrevision = $(this).data('idrevision');
    var idlithosalida = $(this).data('idlithosalida');
    var comentarios = $(this).data('comentarios');
    var transferencia = $(this).data('transferencia');
    var cantidad = $(this).data('cantidad');
    var numeroparte = $(this).data('numeroparte');

    $(".idrevisionsalida").val(idrevision);
    $(".idlithosalida").val(idlithosalida);
    $(".comentarios_salida").val(comentarios);
    $(".transferencia_salida").val(transferencia);
    $(".cantidad_salida").val(cantidad);
    $("#entradanumeroparte_salida").text(numeroparte);
  });


  $("#btnupdatesalida").click(function(){

    $.ajax({
      type: "POST",
      url: "<?php echo site_url('litho/actualizar_salida_tijuana');?>",
      data: $('#frmupdateinfosalida').serialize(),
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

    var idrevision = $(this).data('idrevision');
    var idlithosalida = $(this).data('idlithosalida');


    var dataString = 'idrevision='+ idrevision + '&idlithosalida=' + idlithosalida;

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

    var idrevision = $(this).data('idrevision');
    var idlithodevolucion = $(this).data('idlithodevolucion');
    var comentarios = $(this).data('comentarios');
    var transferencia = $(this).data('transferencia');
    var cantidad = $(this).data('cantidad');
    var numeroparte = $(this).data('numeroparte');

    $(".idrevisiondevolucion").val(idrevision);
    $(".idlithodevolucion").val(idlithodevolucion);
    $(".comentarios_devolucion").val(comentarios);
    $(".transferencia_devolucion").val(transferencia);
    $(".cantidad_devolucion").val(cantidad);
    $("#entradanumeroparte_devolucion").text(numeroparte);
  });


  $("#btnupdatedevolucion").click(function(){

    $.ajax({
      type: "POST",
      url: "<?php echo site_url('litho/actualizar_devolucion_tijuana');?>",
      data: $('#frmupdateinfodevolucion').serialize(),
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
    var idrevision = $(this).data('idrevision');
    var idlithodevolucion = $(this).data('idlithodevolucion');

    var dataString = 'idrevision='+ idrevision + '&idlithodevolucion=' + idlithodevolucion;

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
          url: "<?php echo site_url('litho/eliminar_parte_devolucion');?>",
          data: dataString,
          success: function(data) {
            var msg = $.parseJSON(data);
            console.log(msg);
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
