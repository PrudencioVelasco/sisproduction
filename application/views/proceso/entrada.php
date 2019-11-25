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
                    <a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Agregar entrada</a>
                    <hr>


<table class="table is-bordered is-hoverable" id="datatable2">
                                            <thead class="text-white bg-dark" >
                                            <th>Lamina</th>
                                            <th>Num. Parte</th>
                                            <th>Procesos</th>  
                                            <th>Preceso Actual</th>  
                                            <th>Entrada Inicial</th>
                                            <!--<th>Errones</th>
                                            <th>Salidas</th> -->
                                            <th>Fecha</th>
                                            <th>Opción</th>
                                            </thead>
                                            <tbody>
                                               
                                                <?php 
                                                if (isset($procesosiniciados) && !empty($procesosiniciados)) {

                                                    foreach ($procesosiniciados as $value) { 

                                                        ?>
                                                        <tr > 
                                                            <td><strong><?php echo $value->lamina; ?></strong></td>
                                                            <td><strong><?php echo $value->numeroparte;?></strong></td>
                                                            <td>
                                                              <a href="" class="edit_button"  data-toggle="modal" data-target="#myModal"
                                                              data-procesos="<?php echo $value->pasos;?>" 
                                                              ><strong>Ver procesos</strong></a>
                                                            </td>
                                                            <td><span style="font-size: 12px" class="label label-success "><strong><?php echo $value->procesoactual; ?></strong></span></td>
                                                            <td align="center"><strong style="color: green"><?php echo number_format($value->cantidadentrada); ?></strong></td>
                                                            <!--<td align="center"><strong style="color: red"><?php //echo number_format($value->cantidadmal); ?></strong></td>
                                                            <td align="center"><strong style="color: blue"><?php //echo number_format($value->cantidadsalida); ?></strong></td>-->
                                                            <td>
                                                              <?php echo date_format(date_create($value->fecharegistro),"d/m/Y h:i A") ?>
                                                            </td>
                                                            <td>
                                                              <a onclick="return confirm('Esta seguro de Eliminar la Entrada?')"  href="<?php echo site_url('/proceso/eliminar_entrada/'.$value->identradaproceso) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
        
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
        <h3 class="modal-title w-100 font-weight-bold">Agregar</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">




          <div class="alert alert-danger print-error-msg" style="display:none"></div>
        <form id="frmentrada">
         <div class="md-form mb-4">
          <label ><font color="red">*</font>  Lamina</label><br>
          <select class="js-example-basic-lamina " style="width: 100%" name="idlamina">
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
          <label ><font color="red">*</font> Numero de Parte (<small>resultado de la lamina</small>)</label><br>
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
         <div class="md-form mb-5">
          <label ><font color="red">*</font>Cantidad a ingresar</label>
           <input type="text" class="form-control" name="cantidad"  placeholder="Cantidad">
        </div>


       

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-primary" id="btningresar">Ingresar</button>
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
                <h3 class="modal-title " id="myModalLabel">Proceso a seguir</h3>
            </div>
            <form method="post" action="" id="frmentrada">
                <div class="modal-body"> 
                    <div class="form-group">
                         <label style="font-weight: bolder; font-size: 13px;" id="idprocesos"></label>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button> 
                </div>
            </form>
        </div>
    </div>
</div>

<script >
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2({
    placeholder: "Seleccionar el Numero de Parte",
    allowClear: true,
    dropdownParent: $("#modalLoginForm") 
})
     $('.js-example-basic-lamina').select2({
    placeholder: "Seleccionar la Lamina",
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
                    alert(msg.success) ? "" : location.reload(); 
                    }else{ 
                    $(".print-error-msg").css('display','block'); 
                    $(".print-error-msg").html(msg.error);

                    }
                }
            });
         
    }); 


});

</script>


<script>
$(document).on( "click", '.edit_button',function(e) { 
    var procesos = $(this).data('procesos');  
 
    $("#idprocesos").text(procesos);   
}); 
 
</script>
