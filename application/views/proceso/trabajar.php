
<style type="text/css">


</style>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/progressbar/bootstrap-progressbar-3.3.0.css">
  <script src="<?php echo base_url(); ?>/assets/js/jquery.min.js"></script>
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <h3><strong>ADMINISTRAR PROCESO</strong></h3>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12" align="right">
                           <h3><strong><?php echo $detallemaquina->nombremaquina; ?></strong></h3>
                        </div>
                      </div>


                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <div class="container">

<div id="exTab2" class="container">
<ul class="nav nav-tabs">
      <li class="active">
        <a  href="#1" data-toggle="tab"><strong><i class="fa fa-arrow-right" aria-hidden="true"></i>
 PROCESOS PENDIENTES</strong></a>
      </li>
      <li><a href="#2" data-toggle="tab"><strong><i class="fa fa-undo" aria-hidden="true"></i>
 PROCESOS TRABAJADOS</strong></a>
      </li>

    </ul>

      <div class="tab-content ">
        <div class="tab-pane active" id="1">
          <br>
                  <div class="container">


   <table   class="table table-striped table-bordered example" style="width:100%">
                                            <thead class="text-white bg-dark" >
                                            <th>No</th>
                                            <th>Lamina</th>
                                            <th>Num. Parte</th>
                                            <th>Enviada (S)</th>
                                            <th>Recibida (IN)</th>
                                            <th>Malas (NG)</th>
                                            <th>Salidas (FG)</th>
                                            <th>Opción</th>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if (isset($registros) && !empty($registros)) {
                                                    foreach ($registros as $value) {
                                                       //echo $value->tuturno ;
                                                        if($value->tuturno == $maquina && $value->finalizado == 0){
                                                        // echo $value->tuturno ;
                                                        ?>
                                                        <tr>
                                                         <td><strong><?php echo $value->identradaproceso; ?></strong></td>
                                                            <td><strong><?php echo $value->lamina; ?></strong></td>
                                                            <td><strong><?php echo $value->numeroparte;?></strong></td>
                                                            <td align="center">
                                                              <?php if($value->descrap == 0){ ?>
                                                              <strong style="color: green"><?php echo number_format($value->cantidadentrada); ?></strong>
                                                            <?php }else{?>
                                                               <strong style="color: green">Re-trabajar: <?php echo number_format($value->cantidadentrada); ?></strong>
                                                            <?php } ?>
                                                            </td>
                                                            <?php if($value->descrap == 0){ ?>
                                                                <td align="center"><strong style="color: black"><?php echo number_format($value->cantidadrecibida); ?></strong></td>
                                                            <?php } else {?>
                                                                <td align="center"><strong style="color: black">0</strong></td>
                                                            <?php } ?>

                                                            <td align="center"><strong style="color: red"><?php echo number_format($value->cantidadmal); ?></strong></td>
                                                            <td align="center"><strong style="color: blue"><?php echo number_format($value->cantidadsalida); ?></strong></td>
                                                            <td>
                                                              <a  title="Dar click para Ver el Proceso."  href="" class="btn btn-info btn-sm edit_button" data-toggle="modal" data-target="#myModal"
                                                              data-procesos="<?php echo $value->pasos;?>" >
                                                              <i class="fa fa-eye" aria-hidden="true"></i></a>
                                                               <a   title="Dar click para Enviar al siguiente Proceso."   href="" class="btn btn-primary btn-sm edit_button_enviar"
                                                                data-toggle="modal" data-target="#myModalEnviar"
                                                              data-id="<?php echo $value->id;?>"
                                                              data-identradaproceso="<?php echo $value->identradaproceso;?>"
                                                              data-cantidad="<?php echo $value->cantidadentrada;?>"
                                                               ><i class="fa fa-paper-plane" aria-hidden="true"></i>
</a>

                                                            </td>

                                                        </tr>
                                                        <?php

                                                          }
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>


                        </div>


        </div>
        <div class="tab-pane" id="2">

<br>
          <table   class="table table-striped table-bordered example" style="width:100%">
        <thead>
          <th>No</th>
               <th>Lamina</th>
                                            <th>Num. Parte</th>
                                            <th>Enviada (S)</th>
                                            <th>Recibida (IN)</th>
                                            <th>Malas (NG)</th>
                                            <th>Salidas (FG)</th>
                                            <th>Opción</th>

        </thead>
        <tbody>
           <?php
                                                if (isset($registros) && !empty($registros)) {

                                                    foreach ($registros as $value) {
                                                       //echo $value->pasoporaqui;
                                                        if($value->tuturno == $maquina){
                                                        // echo $value->tuturno ;
                                                        ?>
                                                        <tr >
                                                           <td><strong><?php echo $value->identradaproceso; ?></strong></td>
                                                            <td><strong><?php echo $value->lamina; ?></strong></td>
                                                            <td><strong><?php echo $value->numeroparte;?></strong></td>
                                                            </td>
                                                            <td align="center">

                                                               <?php if($value->descrap == 0){ ?>
                                                              <strong style="color: green"><?php echo number_format($value->cantidadentrada); ?></strong>
                                                            <?php }else{?>
                                                               <strong style="color: green">Re-trabajado: <?php echo number_format($value->cantidadentrada); ?></strong>
                                                            <?php } ?>

                                                            </td>
                                                              <td align="center"><strong style="color: black"><?php echo number_format($value->cantidadrecibida); ?></strong></td>
                                                            <td align="center"><strong style="color: red"><?php echo number_format($value->cantidadmal); ?></strong></td>
                                                            <td align="center"><strong style="color: blue"><?php echo number_format($value->cantidadsalida); ?></strong></td>
                                                            <td>
                                                              <a  title="Dar click para Ver el Proceso."   href="" class="btn btn-info btn-sm edit_button" data-toggle="modal" data-target="#myModal"
                                                              data-procesos="<?php echo $value->pasos;?>" >
                                                              <i class="fa fa-eye" aria-hidden="true"></i></a>
                                                               <a   title="Click para Enviar al siguiente Proceso"href="" class="btn btn-primary btn-sm edit_button_enviar"
                                                                data-toggle="modal" data-target="#myModalEnviar"
                                                              data-id="<?php echo $value->id;?>"
                                                              data-identradaproceso="<?php echo $value->identradaproceso;?>"
                                                              data-cantidad="<?php echo $value->cantidadentrada;?>"
                                                               ><i class="fa fa-paper-plane" aria-hidden="true"></i>
</a>

                                                            </td>

                                                        </tr>
                                                        <?php

                                                          }
                                                        }
                                                    }
                                                ?>
        </tbody>

    </table>


        </div>


      </div>
  </div>

<hr></hr>







                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-info-nomodal">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title " id="myModalLabel"><i class="fa fa-arrow-right" aria-hidden="true"></i> PROCESO A SEGUIR</h3>
            </div>
            <form method="post" action="" id="frmentrada">
                <div class="modal-body">
                    <div class="form-group">
                         <label style="font-weight: bolder; font-size: 13px;" id="idprocesos"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-ban'></i> Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalEnviar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-info-nomodal">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title " id="myModalLabel" >CANTIDAD ENVIADA: <label class="titlecantidad" style="text-decoration: underline  black;"></label> </h3>
            </div>
            <form method="post" action="" id="frmenviar">
                <div class="modal-body">
                  <div class="alert alert-danger print-error-msg" style="display:none"></div>
                    <div class="form-group">
                        <input  id="iddetalle" type="hidden" name="iddetalle">
                        <input  id="cantidad" type="hidden" name="cantidad">
                        <input  id="identradaproceso" type="hidden" name="identradaproceso">
                        <input   type="hidden" name="maquina" value="<?php echo $maquina ?>">
                     </div>
                     <div class="form-group">
                         <label style="color:black;"><font color="red">*</font> Cantidad Recibida (<span style="color:green;">IN</span>) </label><br>
                        <input type="text" name="cantidadrecibida"  class="form-control">
                    </div>
                     <div class="form-group">
                         <label style="color:black;"><font color="red">*</font> Cantidad Buenas (<span style="color:blue;">FG</span>) </label><br>
                        <input type="text" name="cantidadbien"  class="form-control">
                    </div>
                    <div class="form-group">
                         <label style="color:black;"><font color="red">*</font> Cantidad Malas (<span style="color:red;">NG</span>)</label><br>
                        <input type="text" name="cantidaderror"  class="form-control">
                    </div>
                    <?php if(isset($maquina) && $maquina == 7){ ?>
                    <small style="color:black;">Detalle de lo Malo</small>
                    <div class="row">
                          <div class="col-md-4 col-sm-12 col-xs-12">
                              <label style="color:black;"><font color="red">*</font> Por Proveedor</label><br>
                             <input type="text" name="porproveedor"  class="form-control">
                         </div>

                          <div class="col-md-4 col-sm-12 col-xs-12">
                              <label style="color:black;"><font color="red">*</font> Retrabajo </label><br>
                             <input type="text" name="retrabajo"  class="form-control">
                         </div>

                          <div class="col-md-4 col-sm-12 col-xs-12">
                              <label style="color:black;"><font color="red">*</font> Descuadre </label><br>
                             <input type="text" name="descuadre"  class="form-control">
                         </div>
                    </div>
                  <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-ban'></i>
                      Cerrar</button>
                    <button type="button" id="btnenviar"  class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i>
 Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>


  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/notify/pnotify.core.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/notify/pnotify.buttons.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/notify/pnotify.nonblock.js"></script>

<script>

    $(function() {
      var cnt = 10; //$("#custom_notifications ul.notifications li").length + 1;
      TabbedNotification = function(options) {
        var message = "<div id='ntf" + cnt + "' class='text alert-" + options.type + "' style='display:none'><h2><i class='fa fa-bell'></i> " + options.title +
          "</h2><div class='close'><a href='javascript:;' class='notification_close'><i class='fa fa-close'></i></a></div><p>" + options.text + "</p></div>";

        if (document.getElementById('custom_notifications') == null) {
          alert('doesnt exists');
        } else {
          $('#custom_notifications ul.notifications').append("<li><a id='ntlink" + cnt + "' class='alert-" + options.type + "' href='#ntf" + cnt + "'><i class='fa fa-bell animated shake'></i></a></li>");
          $('#custom_notifications #notif-group').append(message);
          cnt++;
          CustomTabs(options);
        }
      }

      CustomTabs = function(options) {
        $('.tabbed_notifications > div').hide();
        $('.tabbed_notifications > div:first-of-type').show();
        $('#custom_notifications').removeClass('dsp_none');
        $('.notifications a').click(function(e) {
          e.preventDefault();
          var $this = $(this),
            tabbed_notifications = '#' + $this.parents('.notifications').data('tabbed_notifications'),
            others = $this.closest('li').siblings().children('a'),
            target = $this.attr('href');
          others.removeClass('active');
          $this.addClass('active');
          $(tabbed_notifications).children('div').hide();
          $(target).show();
        });
      }

      CustomTabs();

      var tabid = idname = '';
      $(document).on('click', '.notification_close', function(e) {
        idname = $(this).parent().parent().attr("id");
        tabid = idname.substr(-2);
        $('#ntf' + tabid).remove();
        $('#ntlink' + tabid).parent().remove();
        $('.notifications a').first().addClass('active');
        $('#notif-group div').first().css('display', 'block');
      });
    })
  </script>

  <script type="text/javascript">

     $(function() {
        var arrayFromPHP = <?php echo json_encode($registros); ?>;
        var maquina = <?php echo $maquina; ?>;
$.each(arrayFromPHP, function (i, elem) {
    // do your stuff
//console.log(elem.tuturno)
if(elem.tuturno == maquina && elem.finalizado == 0){
new TabbedNotification({
                                title: 'NOTIFICACIONES',
                                text: 'Usted tiene registros pendientes por trabajar, Número de Parte: '+elem.numeroparte,
                                type: 'error',
                                sound: false
                            })
    }

});


    });
  </script>





<script>
$(document).on( "click", '.edit_button',function(e) {
    var procesos = $(this).data('procesos');

    $("#idprocesos").text(procesos);
});
$(document).on( "click", '.edit_button_enviar',function(e) {
    var id = $(this).data('id');
    var cantidad = $(this).data('cantidad');
    var identradaproceso = $(this).data('identradaproceso');

    $("#iddetalle").val(id);
    $("#cantidad").val(cantidad);
    $("#identradaproceso").val(identradaproceso);

    $(".titlecantidad").text(formatNumber( cantidad));
});
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

</script>


<script>


    $("#btnenviar").click(function(){
      Swal.fire({
  title: 'Esta seguro de Enviarlo?',
  text: "No se puede revertir esta acción.",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ENVIAR',
  cancelButtonText: 'CANCELAR'
}).then((result) => {
  if (result.value) {
    $.ajax({
             type: "POST",
             url: "<?php echo site_url('Proceso/siguiente_proceso');?>",
             data: $('#frmenviar').serialize(),
             success: function(data) {
                 var msg = $.parseJSON(data);
                 console.log(msg.success);
                 if((typeof msg.error === "undefined")){
                 $(".print-error-msg").css('display','none');
                 swal("Se envio con Exito.", "Click en el boton!", "success").then(function(){
                     location.reload();
                   });
                 }else{
                 $(".print-error-msg").css('display','block');
                 $(".print-error-msg").html(msg.error);
                 setTimeout(function() {$('.print-error-msg').fadeOut('fast');}, 4000);
                 }
             }
         });

  }
})


    });
</script>
