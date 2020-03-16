<!-- page content -->
 <style type="text/css">
@keyframes blink {
  0% { color: blue; }
  100% { color: white; }
}
@-webkit-keyframes blink {
  0% { color: blue; }
  100% { color: white; }
}
.blink {
  -webkit-animation: blink 1s linear infinite;
  -moz-animation: blink 1s linear infinite;
  animation: blink 1s linear infinite;
}

 </style>
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h4><strong>Administrar Entradas</strong></h4>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    <a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm"><i class="fa fa-plus" aria-hidden="true"></i>
 Agregar Entrada</a>
                    <hr>


<table class="table is-bordered is-hoverable" id="datatable2">
                                            <thead class="text-white bg-dark" >
                                              <th>No</th>
                                            <th>Lamina</th>
                                            <th>Num. Parte</th>
                                            <th>Procesos</th>
                                            <th>E. Inicial</th>
                                            <th>Meta</th>
                                            <th>Fecha</th>
                                            <th>Opción</th>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if (isset($procesosiniciados) && !empty($procesosiniciados)) {

                                                    foreach ($procesosiniciados as $value) {

                                                        ?>
                                                        <tr >
                                                          <td><strong><?php echo $value->identradaproceso; ?></strong></td>
                                                            <td><strong><?php echo $value->lamina; ?></strong></td>
                                                            <td><strong><?php echo $value->numeroparte;?></strong></td>
                                                            <td>
                                                              <a href="" class="edit_button"  data-toggle="modal" data-target="#myModal"
                                                              data-procesos="<?php echo $value->pasos;?>"
                                                              ><strong>Ver proceso</strong></a>
                                                            </td>
                                                            <td align="center"><strong style="color: green"><?php echo number_format($value->cantidadentrada); ?></strong></td>
                                                            <td align="center"><strong><?php echo number_format($value->metaproduccion); ?></strong></td>
                                                            <td>
                                                              <?php echo date_format(date_create($value->fecharegistro),"d/m/Y h:i A") ?>
                                                            </td>
                                                            <td>
                                                              <a data-toggle="tooltip" data-placement="top" title="Dar click para Eliminar la Entrada."   href="<?php echo site_url('/proceso/eliminar_entrada/'.$value->identradaproceso) ?>" class="btn btn-danger btn-sm confirmation"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                                            </td>

                                                        </tr>
                                                        <?php

                                                          }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>



                    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title w-100 font-weight-bold">Agregar Entrada</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">




          <div class="alert alert-danger print-error-msg" style="display:none"></div>
        <form id="frmentrada">
         <div class="md-form mb-4">
          <label ><font color="red">*</font>  Lámina</label><br>
          <select class="js-example-basic-lamina " style="width: 100%" name="idlamina">
            <option value=""></option>
            <?php
                foreach ($laminas as  $value) {
                    # code...
                    echo ' <option   value="'.$value->idparte.'">'.$value->numeroparte.'</option> ';
                }
            ?>

        </select>
        </div>
        <div class="md-form mb-5">
          <label ><font color="red">*</font> Número de Parte (<small>resultado de la lamina</small>)</label><br>
          <select class="js-example-basic-single " id="numeroparte" style="width: 100%" name="idparte">
            <option value=""></option>
            <?php
                foreach ($partes as  $value) {
                    # code...
                    echo ' <option   value="'.$value->idparte.'">'.$value->numeroparte.'</option> ';
                }
            ?>

        </select>
        </div>
        <div class="md-form mb-5">
          <label ><font color="red">*</font> Proceso a correr</label>
          <select class="form-control" id="idproceso"   name="idproceso">
            <option value="">Seleccionar proceso</option>
            <?php
            if(isset($procesos) && !empty($procesos)){
                foreach ($procesos as  $value) {
                    # code...
                    echo ' <option   value="'.$value->idproceso.'">'.$value->nombreproceso.' '.$value->pasos.'</option> ';
                }
            }
            ?>

        </select>

        </div>
        <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12 ">
            <div class="form-group">
          <label ><font color="red">*</font>Cantidad a ingresar</label>
           <input type="text" class="form-control" name="cantidad"  placeholder="Cantidad">
        </div>
         </div>
          <div class="col-md-6 col-sm-12 col-xs-12 ">
            <div class="form-group">
          <label ><font color="red">*</font>Meta de producción</label>
           <input type="text" class="form-control" name="metaproduccion"  placeholder="Meta de producción">
        </div>
        </div>
      </div>




      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="button" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-ban" aria-hidden="true"></i>
 Cancelar</button>
        <button type="button" class="btn btn-primary" id="btningresar"><i class="fa fa-floppy-o" aria-hidden="true"></i>
 Agregar</button>
      </div>
  </form>
    </div>
  </div>
</div>



                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script >
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2({
    placeholder: "Seleccionar el Número de Parte",
    allowClear: true,
    dropdownParent: $("#modalLoginForm")
})
     $('.js-example-basic-lamina').select2({
    placeholder: "Seleccionar la Lámina",
    allowClear: true,
    dropdownParent: $("#modalLoginForm")
});
 $('.js-example-basic-single').on("select2:select", function(e) {
   // what you would like to happen
   var idparte = $('.js-example-basic-single').val();
  // alert(idparte)
});
 $('.js-example-basic-lamina').on("select2:select", function(e) {
   // what you would like to happen
   var idparte = $('.js-example-basic-lamina').val();
   //alert(idparte)
});

   $("#btningresar").click(function(){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('proceso/agregar_entrada');?>",
                data: $('#frmentrada').serialize(),
                success: function(data) {
                    var msg = $.parseJSON(data);
                    console.log(msg.error);
                    if((typeof msg.error === "undefined")){
                    $(".print-error-msg").css('display','none');
                    swal("Se agrego la Entrada con Exito!", "Click en el boton!", "success").then(function(){
                          location.reload();
                      });
                    }else{
                    $(".print-error-msg").css('display','block');
                    $(".print-error-msg").html(msg.error);

                    }
                }
            });

    });


});

</script>
<script type="text/javascript">
$('.confirmation').click(function(e) {
    e.preventDefault(); // Prevent the href from redirecting directly
    var linkURL = $(this).attr("href");
    warnBeforeRedirect(linkURL);
    });

function warnBeforeRedirect(linkURL) {
  Swal.fire({
      title: 'Esta seguro de Eliminar la Entrada?',
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

<script>
$(document).on( "click", '.edit_button',function(e) {
    var procesos = $(this).data('procesos');

    $("#idprocesos").text(procesos);
});

</script>
