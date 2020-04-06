<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3><strong>ADMINISTRAR TRANSFERENCIAS</strong></h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">
                                <div class="row">
                                   <div class="col-md-6 col-sm-12 col-xs-12 ">
                                        <a href="<?php echo site_url('Transferencia/agregar/')?>" class="btn btn-icons btn-rounded  btn-primary confirmation_transferencia" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear Transferencia</a>
                                    </div>
                                     <div class="col-md-6 col-sm-12 col-xs-12 " align="right">
                                       <a href="#" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"> <i class="fa fa-print"></i> Regenerar Etiqueta</a>
                                        <a href="<?php echo site_url('Devolucion/agregar')?>" class="btn btn-icons btn-rounded  btn-default confirmation_retorno" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear Retorno</a>
                                    </div>
                                </div>

                                <div class="modal fade bd-example-modal-lg" id="myModal"   role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header modal-header-info-nomodal">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h3 class="modal-title">REGENERAR ETIQUETA</h3>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form  method="POST" target="_blank" action="<?php echo site_url('Transferencia/regenerar_etiqueta'); ?>">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                             <span style="color: red" id="wd"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 ">

                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Número de Parte</label>
                                                                <input type="text" class="form-control" name="numeroparte"  id="numeroparte" autcomplete="off" autofocus="" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required="">
                                                            </div>
                                                            <span style="color: red; font-weight: bold;" id="msgerrornumero"></span>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Seleccionar Modelo</label>
                                                                <select class="select2_single_modelo form-control " name="modelo" id="listamodelo" required="">
                                                                    <option value="">Seleccionar</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Seleccionar Revisión</label>
                                                                <select class="select2_single_revision form-control " name="revision" id="listarevision" required="">
                                                                    <option value="">Seleccionar</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Seleccionar Linea</label>
                                                                <select class="select2_linea form-control " name="linea" required="">
                                                                    <option value="">Seleccionar</option>
                                                                    <?php foreach ($datalinea as $row) { ?>
                                                                        <option value="<?php echo $row->idlinea ?>"><?php echo $row->nombrelinea ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Tipo de Producción</label>
                                                                <select class="select2_linea form-control " name="tipoproduccion" required="">
                                                                    <option value="">Seleccionar</option>
                                                                    <option value="P">Producción</option>
                                                                    <option value="R">Retorno</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                            <div class="form-group">
                                                              <label><font color="red">*</font> Cantidad de Cajas</label>
                                                               <input type="number" class="form-control"  name="cajasxpallet"  onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" required="" autcomplete="off">
                                                          </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Fecha</label>
                                                                <input type="date" class="form-control" required="" value="<?php echo date('Y-m-d') ?>" name="fecha" autcomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                            <button type="submit" class="btn btn-primary" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando..."><i class='fa fa-floppy-o'></i> Generar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" onclick="javascript:window.location.reload()" ><i class='fa fa-ban'></i>  Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                   <div class="col-md-12 col-sm-12 col-xs-12 ">
                                        <table class="table  hover" id="datatable2">
                                            <thead class="text-white bg-dark" >
                                            <th>Transferencia</th>
                                            <th>Creado por:</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Retorno</th>
                                            <th align="right">Opción</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($datatransferencia) && !empty($datatransferencia)) {

                                                    foreach ($datatransferencia as $value) {

                                                        ?>
                                                        <tr   class="table-default">
                                                            <td><strong><?php echo $value->folio; ?></strong></td>
                                                            <td><?php echo $value->usuario ?></td>
                                                            <td><?php echo date_format(date_create($value->fecharegistro),"d/m/Y h:i A") ?></td>
                                                            <td>
                                                                <?php
                                                                if(!empty($value->estatus) && !is_null($value->estatus)){
                                                                    echo '<label>'.$value->estatus.'</label>';
                                                                }else if(!empty($value->estatusall)){
                                                                     echo '<label>'.$value->estatusall.'</label>';
                                                                }else{
                                                                    echo '<label>VACIO</label>';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if($value->devolucion == 1){
                                                                    echo '<label class="label label-success">SI</label>';
                                                                }else{
                                                                     echo '<label class="label label-danger">NO</label>';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td align="center">



                                                                 <?php if($value->devolucion == 1){?>
                                                                      <a class="btn btn-icons btn-danger btn-sm confirmation_delete"  href="<?php echo site_url('Transferencia/eliminar_devolucion/'.$value->idtransferancia) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a>
                                                                 <?php }else{ ?>
                                                                       <a class="btn btn-icons btn-danger btn-sm confirmation_delete" href="<?php echo site_url('Transferencia/eliminar/'.$value->idtransferancia) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a>
  <?php } ?>
                                                            <?php if($value->devolucion == 1){?>
                                                                  <a class="btn btn-icons btn-info btn-sm"  href="<?php echo site_url('Devolucion/detalle/'.$value->idtransferancia.'/'.$value->folio) ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</a>
                                                            <?php }else{ ?>
                                                                  <a class="btn btn-icons  btn-info btn-sm"  href="<?php echo site_url('Transferencia/detalle/'.$value->idtransferancia.'/'.$value->folio) ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</a>
                                                            <?php } ?>
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
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script type="text/javascript">

       function pasacampo(key_event) {
           var k;
           if (document.all) k = event.keyCode;
           else k = key_event.which;
           if (k == 13) document.getElementById('numeroetiqueta').focus();
       }

    </script>

<script type="text/javascript">
  $.fn.delayPasteKeyUp = function (fn, ms) {
      var timer = 0;
      $(this).on("propertychange input", function () {
          clearTimeout(timer);
          timer = setTimeout(fn, ms);
      });
  };

  $(document).ready(function () {
      $("#numeroparte").delayPasteKeyUp(function () {


          var parte = $("#numeroparte").val();
          if(parte != ""){
          $.ajax({
              type: "POST",
              url: "<?= base_url('Transferencia/validar') ?>",
              data: "numeroparte=" + parte,
              dataType: "html",
              beforeSend: function () {
                  //imagen de carga
                  //$("#resultado").html("<p align='center'><img src='ajax-loader.gif' /></p>");
              },
              error: function () {
                  alert("error petición ajax");
              },
              success: function (data) {
                if (data == 1) {
                      $('#msgerrornumero').text("Número de parte no existe.");
                     $('.select2_single_modelo').empty().append('<option value="">Seleccionar</option>');
                     $('.select2_single_revision').empty().append('<option value="">Seleccionar</option>');
                      $('.select2_single_modelo').prop('disabled', 'disabled');
                      $('.select2_single_revision').prop('disabled', 'disabled');

                  }else{
                      if(data == 2){

                           $('#msgerrornumero').text("El Número de parte no tiene registrado el modelo.");
                      $('.select2_single_modelo').prop('disabled', 'disabled');

              }else{
                  $('#msgerrornumero').text("");
                  console.log(data);
                 // $('.select2_single_modelo option').remove();
                  $('.select2_single_modelo').empty().append('<option value="">Seleccionar</option>');

                  $('.select2_single_revision').empty().append('<option value="">Seleccionar</option>');
                  $('.select2_single_revision').prop('disabled', 'disabled');

                  $(".select2_single_modelo").prop("disabled", false);
                  $("#listamodelo").append(data);

              }
              }

              }
          });
        }else{
                   $('#msgerrornumero').text("");
              }



      }, 200);
  });

</script>

<script type="text/javascript">

  $(document).ready(function () {



      $("#listamodelo").change(function () {
          var idmodelo = $("#listamodelo").find("option:selected").val();
          $.ajax({
              type: "POST",
              url: "<?= base_url('Transferencia/seleccionarModelo') ?>",
              data: "idmodelo=" + idmodelo,
              dataType: "html",
              success: function (response) {
                   if(response == 1){
                  $('#msgerrornumero').text("El Modelo no tiene registrado la revisión.");
                  }else{
                  $('#msgerrornumero').text("");
                  $('.select2_single_revision').empty().append('<option value="">Seleccionar</option>');
                  $(".select2_single_revision").prop("disabled", false);
                  $("#listarevision").append(response);
                  }
              }
          });

      });

  });
</script>
<script>
$(document).ready(function () {
  $('#myModal').on('shown.bs.modal', function () {
    $('#numeroparte').focus()
    });
     $('#myModalEscaner').on('shown.bs.modal', function () {
      $('#numerocaja').focus()
      });

      $('#btnagregar').on('click', function () {
              var form = $("#registrationForm").serialize();

                      $.ajax({
                      type: "POST",
                      url: "<?php echo site_url('Transferencia/regenerar_etiqueta'); ?>",
                      data: form,
                      success: function (data) {
                          console.log(data);
                          if(data==1){
                             $('#wd').text("Todos los campos son obligatorios.");
                          }else if(data==2){
                              $('#wd').text("Cantidad solo permite número.");
                          }else{
                               location.reload();
                          }
                      }
              });

      });

});
</script>

<script type="text/javascript">
$('.confirmation_transferencia').click(function(e) {
    e.preventDefault(); // Prevent the href from redirecting directly
    var linkURL = $(this).attr("href");
    warnBeforeRedirect(linkURL);
    });
$('.confirmation_retorno').click(function(e) {
        e.preventDefault(); // Prevent the href from redirecting directly
        var linkURL = $(this).attr("href");
        warnBeforeRedirectRetorno(linkURL);
        });
$('.confirmation_delete').click(function(e) {
                e.preventDefault(); // Prevent the href from redirecting directly
                var linkURL = $(this).attr("href");
                warnBeforeRedirectDelete(linkURL);
                });

function warnBeforeRedirect(linkURL) {
  Swal.fire({
      title: 'Esta seguro de Crear la Transferencia?',
      text: "No se puede revertir esta acción.",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'CREAR',
      cancelButtonText: 'CANCELAR'
      }).then((result) => {
      if (result.value) {
   // Redirect the user
   window.location.href = linkURL;
 }
});

}
function warnBeforeRedirectRetorno(linkURL) {
  Swal.fire({
      title: 'Esta seguro de Crear el Retorno?',
      text: "No se puede revertir esta acción.",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'CREAR',
      cancelButtonText: 'CANCELAR'
      }).then((result) => {
      if (result.value) {
   // Redirect the user
   window.location.href = linkURL;
 }
});

}

function warnBeforeRedirectDelete(linkURL) {
  Swal.fire({
      title: 'Esta seguro de Eliminar el Registro?',
      text: "No se puede revertir esta acción.",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ELIMINAR',
      cancelButtonText: 'CANCELAR'
      }).then((result) => {
      if (result.value) {
   // Redirect the user
   window.location.href = linkURL;
 }
});

}
</script>
