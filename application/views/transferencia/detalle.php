<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6 " align="left">
                                <h2><strong>Agregar Número de Parte</strong></h2>
                            </div>
                           <div class="col-md-6 col-sm-6 col-xs-6 " style="display: flex; justify-content: flex-end">
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
                                                                <input type="text" class="form-control" name="numeroparte"  id="numeroparte" autcomplete="off" autofocus="" required=""> 
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
                                                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Seleccionar Linea</label> 
                                                                <select class="select2_linea form-control " name="linea" required="">
                                                                    <?php foreach ($datalinea as $row) { ?>
                                                                        <option value="<?php echo $row->idlinea ?>"><?php echo $row->nombrelinea ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Cantidad de cajas por pallet</label> 
                                                                 <input type="text" class="form-control"  name="cajasxpallet" required="" autcomplete="off">
                                                            </div>  
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                            <div class="form-group">
                                                                <label><font color="red">*</font> Cantidad de Pallet</label> 
                                                                <input type="text" class="form-control" required="" name="cantidad" autcomplete="off">
                                                            </div>  
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                            <input type="hidden" name="idtransferencia" value="<?php echo $id; ?>">
                                                            <button type="button" id="btnagregar" class="btn btn-primary">Guardar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
                                                        <th></th>
                                                        <th scope="col">Cliente</th>
                                                        <th scope="col">No. P.</th>
                                                        <th scope="col">Cajas.</th>
                                                        <th scope="col">Rev.</th> 
                                                        <th>Estatus</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($datatransferencia) && !empty($datatransferencia)) {
                                                        foreach ($datatransferencia as $value) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php if ($value->idestatus == 3 || $value->idestatus == 14) { ?>
                                                                        <div class="checkbox-group required">
                                                                            <input type="checkbox" name="id[]" value="<?php echo $value->idpalletcajas; ?>">
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <td scope="row"><?php echo $value->nombre; ?></td>
                                                                <td><?php echo $value->numeroparte; ?></td>
                                                                <td><?php echo number_format($value->cantidad); ?></td>
                                                                <td><?php echo $value->descripcion; ?></td>
                                                                <td>
                                                                    <?php
                                                                            if ($value->idestatus == 14) {
                                                                                echo '<label style="color:green;">EN ESPERA</label>';
                                                                            } else if ($value->idestatus == 1) {
                                                                                echo '<label style="color:green;">E. A CALIDAD</label>';
                                                                            } else if ($value->idestatus == 12) {
                                                                                echo '<label style="color:blue;">EN HOLD</label>';
                                                                            }  else if ($value->idestatus == 6) {
                                                                                echo '<label style="color:red;">R. A. CALIDAD</label>';
                                                                            } else if($value->idestatus == 3 ){ ?>
                                                                    <label id="<?php echo $value->idpalletcajas; ?>" class="edit_data" style="color:red; font-weight: bolder" >RECHAZADO</label>
                                                                            <?php } 
                                                                            else {
                                                                                echo '<label style="color:green;">EN ALMACEN</label>';
                                                                            }
                                                                            ?>
                                                                </td>
                                                                <td align="center">
                                                                    <a style="padding-right: 20px" target="_blank" href="<?php echo site_url('transferencia/etiquetaPacking/' . $value->idpalletcajas) ?>"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a>
                                                                    <input type="hidden" class="idpalletcajas" value="<?php echo $value->idpalletcajas; ?>"/>
                                                                    <a href=""> <i class="fa fa-print fa-2x btnimprimirpdf"  aria-hidden="true"></i></a>
                                                                    <a style="padding-left: 20px" target="_blank" href="<?php echo site_url('transferencia/nuevaetiqueta/' . $value->idpalletcajas) ?>"><i style="color:green;" class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a> 
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?> 
                                                 <div id="myModalMSG" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Error</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="errormsgescaneoa" style="color: red"></div>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                                        <div class="form-group">
                                                                            <label>Motivo de rechazo</label>
                                                                            <input type="" class="form-control" id="motivo" name="" disabled="">
                                                                            <textarea id="motivonotas" class="md-textarea form-control" rows="5" disabled=""></textarea>
                                                                        </div> 
                                                                    </div> 

                                                                </div>
                                                               

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div id="myModalEscaner" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Escanear código</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div id="errormsgescaneoap" style="color: red; font-weight: bold; font-size: 14px;"></div>
                                                                <div id="correctomsgescaneoap" style="color: green; font-weight: bold; font-size: 14px;"></div>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                                        <div class="form-group">
                                                                            <label><font color="red">*</font> Caja</label>
                                                                            <input type="text" class="form-control"  id="numerocaja" name="numerocaja" onKeyPress="pasacampo(event)"> 
                                                                        </div> 
                                                                    </div> 

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                                        <div class="form-group">
                                                                            <label><font color="red">*</font> Etiqueta</label> 
                                                                            <input type="text" class="form-control"  id="numeroetiqueta" name="numeroetiqueta" > 
                                                                        </div>  
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div> 
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12" align="right">
                                            <?php   if (isset($datatransferencia) && !empty($datatransferencia)) { ?>
                                            <button type="button" id="btnenviar" name="enviar" class="btn btn-success  btn-sm"><i class="fa fa-send" aria-hidden="true"></i> Enviar</button>
                                            <button type="button" id="btneliminar" name="btneliminar" class="btn btn-danger  btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                            <a target="_blank" href="<?php echo site_url('transferencia/generarPDFEnvio/'.$id) ?>" class="btn btn-default  btn-sm"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generar envio</a>
                                            <?php } ?>  
                                            </div>
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
            $.ajax({
                type: "POST",
                url: "<?= base_url('transferencia/validar') ?>",
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

                    }else{
                    //console.log(data);
                    $(".select2_single_modelo").prop("disabled", false);
                    $("#listamodelo").append(data);
                }


                }
            });




        }, 200);
    });

</script> 

<script type="text/javascript">

    $(document).ready(function () {

         

        $("#listamodelo").change(function () {
            var idmodelo = $("#listamodelo").find("option:selected").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('transferencia/seleccionarModelo') ?>",
                data: "idmodelo=" + idmodelo,
                dataType: "html",
                success: function (response) {
                    $(".select2_single_revision").prop("disabled", false);
                    $("#listarevision").append(response);

                }
            });

        });

        $('#btnenviar').on('click', function () {
            if ($('div.checkbox-group.required :checkbox:checked').length === 1) {
                $("#myModalEscaner").modal("show");
               
                
                $("#numeroetiqueta").delayPasteKeyUp(function () {                    
                    var etiqueta = $("#numeroetiqueta").val();
                    var caja = $("#numerocaja").val();
                var      form = $("#frmenviar").serialize();
                    if(caja !== "" && etiqueta !== ""){
                        $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('transferencia/enviaracalidad'); ?>",
                        data: form,
                        success: function (data) {
                            console.log(data);
                            if(data==1){
                                $("#numeroetiqueta").val("");
                                $("#numerocaja").val("");
                                $('#errormsgescaneoap').text("");
                                 $('#correctomsgescaneoap').text("Exito... Espere");
                                location.reload();
                            }else{
                                $("#numeroetiqueta").val("");
                                $("#numerocaja").val("");
                                  $('#errormsgescaneoap').text("No coinciden.");
                            }
                            //location.reload();
                            //Unterminated String literal fixed
                        }
                }); 
                return false;  
                   }else{
                         $('#errormsgescaneoap').text("Campos obligatorios.");
                   }
                }, 200); 
            } else {
                $('#errormsg').text("Seleccionar una casilla.");
            }
        });
        
            $('#btneliminar').on('click', function () {
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {
               
              var   form = $("#frmenviar").serialize();
                     $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('transferencia/eliminarpallet'); ?>",
                        data: form,
                        success: function (data) {
                            if(data == 0){
                                 $('#errormsg').text("No fueron emilinados todo por el Estatus.");
                               
                            }else{
                                 location.reload(true);
                            }
                           
                           
                            //location.reload();
                            //Unterminated String literal fixed
                        }
                }); 
            } else {
                $('#errormsg').text("Seleccionar una casilla.");
            }
        });
        
        $(document).on('click', '.edit_data', function () {
            var idpalletcajas = $(this).attr("id");
            //$('#myModalMSG').modal('show');
            $.ajax({
                url: "<?php echo site_url('transferencia/rechazopallet'); ?>",
                method: "POST",
                data: {idpalletcajas: idpalletcajas},
                dataType: "json",
                success: function (data) {
                    $('#motivo').val(data.motivo); 
                    $('#motivonotas').val(data.notas); 
                    $('#myModalMSG').modal('show');
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
                        url: "<?php echo site_url('transferencia/registrar'); ?>",
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
<script type="text/javascript">
    $(document).ready(function () {
    
        $('.btnimprimirpdf').on('click', function () {
            var parametros = {
                "idpalletcajas" : $('.idpalletcajas').val()
        };
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('transferencia/imprimirEtiquetaPacking'); ?>",
                data: parametros,

                success: function (data) {

                    
                    var uriWS = "ws://desktop-r1af0qb:8080/wswoori5569430796882482717/printpacking";
                    var miWebsocket = new WebSocket(uriWS);
                 
                miWebsocket.onopen = function (evento) {
                    
                    miWebsocket.send(data);
                }
                miWebsocket.onmessage = function (evento) {
                    console.log(evento.data);
                }
         
                }

            }); 
            return false;  


        });
    });
</script>
<!-- /page content -->
