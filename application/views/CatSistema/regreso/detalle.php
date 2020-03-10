<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12 " align="left">
                                <h2><strong>Agregar Número de Parte</strong></h2>
                            </div>
                             <div class="col-md-4 col-sm-6 col-xs-12 " align="left">
                                <h2><strong style="color: red">AJUSTE DE ENTRADA</strong></h2>
                            </div>
                           <div class="col-md-4 col-sm-6 col-xs-12 " style="display: flex; justify-content: flex-end">
                                <h2><strong>Transferencia: # <?php echo $folio; ?></strong></h2>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar parte</button>
                                    </div>
                                </div><br>
                                <div class="modal fade bd-example-modal-lg" id="myModal"   role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header"> 
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form  id="registrationForm"  >
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                             <span style="color: red" id="wd"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                           
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Número de Parte</label>
                                                                <input type="text" class="form-control" name="numeroparte" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  id="numeroparte" autcomplete="off" autofocus="" required=""> 
                                                            </div> 
                                                            <span style="color: red;" id="msgerrornumero"></span>
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
                                                        <div class="col-md-3 col-sm-12 col-xs-12 ">
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Linea de Producción</label> 
                                                                <select class="select2_linea form-control " name="linea" required=""> 
                                                                    <?php foreach ($datalinea as $row) { ?>
                                                                        <option value="<?php echo $row->idlinea ?>"><?php echo $row->nombrelinea ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>  
                                                        </div>
                                                    
                                                        <div class="col-md-3 col-sm-12 col-xs-12 ">
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Cantidad de cajas por pallet</label> 
                                                                 <input type="text" class="form-control"  name="cajasxpallet" required="" autcomplete="off">
                                                            </div>  
                                                        </div>
                                                    
                                                        <div class="col-md-3 col-sm-12 col-xs-12 ">
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Cantidad de Pallet</label> 
                                                                <input type="text" class="form-control" required="" name="cantidad" autcomplete="off">
                                                            </div>  
                                                        </div>

                                                          <div class="col-md-3 col-sm-12 col-xs-12 ">
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Ubicación en el Almacen</label> 
                                                                <select class="select2_linea form-control " name="idposicion" required=""> 
                                                                    <?php foreach ($posiciones as $row) { ?>
                                                                        <option value="<?php echo $row->idposicion ?>"><?php echo $row->nombreposicion ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>  
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                            <input type="hidden" name="idtransferencia" value="<?php echo $id; ?>">
                                                            <button type="button" id="btnagregar" class="btn btn-primary"><i class='fa fa-floppy-o'></i> Agregar</button>
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

                                <div class="row">
                                   <div class="col-md-12 col-sm-12 col-xs-12 ">
                                        <label id="errormsg" style="color:red;"></label>
                                        <form method="post" id="frmenviar"  action="#">
                                            <table id="datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Cliente</th>
                                                        <th scope="col">Número de Parte</th>
                                                        <th scope="col">Cajas</th>
                                                        <th scope="col">Revisión</th> 
                                                        <th>Estatus</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                     $totalcajas = 0;
                                                    if (isset($datatransferencia) && !empty($datatransferencia)) {
                                                       
                                                        foreach ($datatransferencia as $value) {
                                                            $totalcajas += $value->cantidad;
                                                            ?>
                                                            <tr>
                                                                <td scope="row"><?php echo $value->nombre; ?></td>
                                                                <td><?php echo $value->numeroparte; ?></td>
                                                                <td><?php echo number_format($value->cantidad); ?></td>
                                                                <td><?php echo $value->descripcion; ?></td>
                                                                <td>
                                                                    <?php
                                                                                echo '<label style="color:green;">EN ALMACEN</label>';
                                                                            
                                                                            ?>
                                                                </td>
                                                                <td align="center">
                                                                    <a style="padding-right: 20px"  onclick="return confirm('Esta seguro de eliminar el Registro?')" href="<?php echo site_url('/regresar/eliminar/' . $value->idpalletcajas.'/'.$id.'/'.$folio) ?>"><i class="fa fa-trash fa-2x" style="color: red;" aria-hidden="true"></i></a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?> 
                                               
                                                </tbody>
                                            </table>
                                            <div><strong><h4>Total de caja: <?php echo number_format($totalcajas); ?></strong></h4></div>
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


</div>
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
                url: "<?= base_url('regresar/validar') ?>",
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
                console.log(data);
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
                url: "<?= base_url('regresar/seleccionarModelo') ?>",
                data: "idmodelo=" + idmodelo,
                dataType: "html",
                success: function (response) {
                    $(".select2_single_revision").prop("disabled", false);
                    $("#listarevision").append(response);

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
                        url: "<?php echo site_url('regresar/registrar'); ?>",
                        data: form,
                        success: function (data) {
                            // $('#msgerror').text("Seleccionar una casilla.");
                            console.log(data);
                            if(data==1){ 
                               $('#wd').text("Todos los campos son obligatorios.");
                            }else if(data==2){
                                $('#wd').text("Cantidad solo permite número.");
                            }else{
                                 location.reload();
                            }
                            //location.reload();
                            //Unterminated String literal fixed
                        }
                });      
           
        });

 });
</script>

