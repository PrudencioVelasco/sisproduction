 <div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-6" align="left">
                                <h2><strong>Detalle de Transfrencia</strong></h2>
                            </div>
                            <div class="col-md-6" style="display: flex; justify-content: flex-end">
                                <h2><strong>Transferencia: # <?php echo $folio; ?></strong></h2>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                        <label id="errormsg" style="color:red;"></label>
                                        <form method="post" id="frmdetalle"  action="#">
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
                                                                    <?php if ($value->idestatus == 1 || $value->idestatus == 6) { ?>
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
                                                                    if ($value->idestatus == 1) {
                                                                        echo '<label style="color:green;">EN VALIDACIÓN</label>';
                                                                    } else if ($value->idestatus == 3) { ?> 
                                                                         <label id="<?php echo $value->idpalletcajas; ?>" class="edit_data" style="color:red; font-weight: bolder" >R. A PACKING</label>

                                                                    <?php } else if ($value->idestatus == 4) {
                                                                        echo '<label style="color:green;">E. A ALMACEN</label>';
                                                                    } else if ($value->idestatus == 8) {
                                                                        echo '<label style="color:green;">EN ALMACEN</label>';
                                                                    } else if ($value->idestatus == 12) {
                                                                        echo '<label style="color:blue;">EN HOLD</label>';
                                                                    } else if ($value->idestatus == 13) {
                                                                        echo '<label style="color:red;">EN SCRAP</label>';
                                                                    } else if ($value->idestatus == 6) {
                                                                        ?>
                                                                         
                                                                        <label id2="<?php echo $value->idpalletcajas; ?>" class="edit_data2" style="color:red; font-weight: bolder" >R. A CALIDAD</label>
                                                                    <?php
                                                                    } else if ($value->idestatus == 14) {
                                                                        echo '<label style="color:black;">EN PACKING</label>';
                                                                    } else {
                                                                        echo '<label>No found</label>';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td align="center">
                                                                    <?php if ($value->idestatus != 14) { ?>
                                                                    <a style="padding-right: 20px" target="_blank" href="<?php echo site_url('calidadp/etiquetaCalidad/' . $value->idpalletcajas) ?>"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a>
                                                                    <input type="hidden" class="idpalletcajas" value="<?php echo $value->idpalletcajas; ?>"/>
                                                                    <a href=""> <i class="fa fa-print fa-2x btnimprimirpdf"  aria-hidden="true"></i></a>
                                                                <?php } ?>
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
                                                                            <input type="text" class="form-control" name="" id="motivomsm" disabled="">
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


                                                    <div id="myModalMSGaCalidad" class="modal fade" role="dialog">
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
                                                                            <input type="" name="" id="motivomsmcalidad" disabled="" class="form-control">
                                                                            <textarea id="motivonotascalidad" class="md-textarea form-control" rows="5" disabled=""></textarea>
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
                                                <div class="col-md-6 col-sm-12 col-xs-12" >
                                                    <div class="form-group"  id="idmotivorechazo">
                                                        <label><font color="red">*</font> Seleccionar motivo de rechazo</label>
                                                        <select  class="form-control" id="motivo" name="motivorechazo" required> 
                                                            <option value="">Seleccionar</option>
<?php
foreach ($motivosrechazo as $valuemotivo) {
    echo '<option value=' . $valuemotivo->idmotivorechazo . '>' . $valuemotivo->motivo . '</option>';
}
?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12" >
                                                    <div class="form-group"  id="notasmotivorechazo">
                                                        <label>Notas</label> 

  <textarea class="form-control" rows="5" id="notasrechazo" name="notasrechazo"></textarea>
                                                    </div>
                                                </div>
                                            </div> 

                                            <div class="row">
                                                <div class="col-md-6 col-sm-12 col-xs-12" >
                                                    <div class="form-group"  id="idmotivoopcion">
                                                        <label><font color="red">*</font> Seleccionar Opción</label>
                                                        <select  class="form-control" id="motivoopcion" name="opcionhold" required> 
                                                            <option value="">Seleccionar</option>
                                                            <option value="12">EN HOLD</option> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="col-sm-12" align="right">
<?php if (isset($datatransferencia) && !empty($datatransferencia)) { ?>
                                                        <button type="button" id="btnenviar" name="enviar" class="btn btn-success  btn-sm"><i class="fa fa-send" aria-hidden="true"></i> Enviar</button>
                                                         <button type="button" id="btnhold"   class="btn btn-info btn-sm"><i class="fa fa-clock-o" aria-hidden="true"></i> Hold</button>
                                                        <button type="button" id="btnrechazar" class="btn btn-danger btn-sm"> <i class="fa fa-ban" aria-hidden="true"></i> Rechazar a Packing</button>
                                                    <a target="_blank" href="<?php echo site_url('calidadp/generarPDFEnvio/' . $id) ?>" class="btn btn-default  btn-sm"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generar envio</a>
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


<script>
    $(document).ready(function () {
        $('#idmotivorechazo').hide();
        $('#notasmotivorechazo').hide();
        $('#idmotivoopcion').hide();
        $('#inputrechazar').hide();
        $('#inputenviar').hide();
        $('#btnenviar').on('click', function () {
            //$('#frmdetalle').submit();
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {

                $('#idmotivorechazo').hide();

                $('#notasmotivorechazo').hide();


                //$('#frmdetalle').submit();

                form = $("#frmdetalle").serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('calidad/enviarBodegaNew'); ?>",
                    data: form,

                    success: function (data) {
                        console.log(data);
                        location.reload();
                        //Unterminated String literal fixed
                    }

                });
                //event.preventDefault();
                return false;  //stop the actual form post !important!


            } else {
                $('#errormsg').text("Seleccionar una casilla.");
            }
        });
        $('#btnrechazar').on('click', function () {
            //$('#frmdetalle').submit();
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {
                $('#idmotivorechazo').show();
                $('#notasmotivorechazo').show();
                $('#idmotivoopcion').hide();
                var optId = $("#motivo").val();
                if (optId != "") {
                    form = $("#frmdetalle").serialize();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('calidad/rechazarAPackingNew'); ?>",
                        data: form,

                        success: function (data) {
                            console.log(data);
                            location.reload();
                            //Unterminated String literal fixed
                        }

                    });
                    //event.preventDefault();
                    return false;  //stop the actual form post !important!

                    //$('#frmdetalle').submit();
                } else {
                    $('#errormsg').text("Seleccionar una motivo.");
                }

            } else {
                //alert("ss");
                //errormsg
                $('#errormsg').text("Seleccionar una casilla.");
            }
        });

        $('#btnhold').on('click', function () {
            //$('#frmdetalle').submit();
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {
                $('#idmotivorechazo').hide();
                $('#notasmotivorechazo').hide();
                $('#idmotivoopcion').show();
                var optId = $("#motivoopcion").val();
                if (optId !== "") {

                    form = $("#frmdetalle").serialize();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('calidad/ponerEnHold'); ?>",
                        data: form,

                        success: function (data) {
                            console.log(data);
                            location.reload();
                            //Unterminated String literal fixed
                        }

                    });
                    //event.preventDefault();
                    return false;  //stop the actual form post !important!
                } else {
                    $('#errormsg').text("Seleccionar una opción.");
                }
                //$('#frmdetalle').submit();


            } else {
                //alert("ss");
                //errormsg
                $('#errormsg').text("Seleccionar una casilla.");
            }
        });


         $(document).on('click', '.edit_data', function () {
            var idpalletcajas = $(this).attr("id");
            //$('#myModalMSG').modal('show');
            $.ajax({
                url: "<?php echo site_url('calidadp/rechazopallet'); ?>",
                method: "POST",
                data: {idpalletcajas: idpalletcajas},
                dataType: "json",
                success: function (data) {
                    $('#motivomsm').val(data.motivo); 
                    $('#motivonotas').val(data.notas); 
                    $('#myModalMSG').modal('show');
                }
            });
        });

          $(document).on('click', '.edit_data2', function () {
            var idpalletcajas = $(this).attr("id2");
            //$('#myModalMSG').modal('show');
            $.ajax({
                url: "<?php echo site_url('calidadp/rechazopalletacalidad'); ?>",
                method: "POST",
                data: {idpalletcajas: idpalletcajas},
                dataType: "json",
                success: function (data) {
                    $('#motivomsmcalidad').val(data.motivo); 
                    $('#motivonotascalidad').val(data.notas); 
                    $('#myModalMSGaCalidad').modal('show');
                }
            });
        });


    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('.btnimprimirpdf').on('click', function () {
            var parametros = { 
                "idpalletcajas": $('.idpalletcajas').val()
            };
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('calidadp/imprimirEtiquetaCalidad'); ?>",
                data: parametros,

                success: function (data) {


                    var uriWS = "ws://desktop-r1af0qb:8080/wswoori5569430796882482717/printcalidad";
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
