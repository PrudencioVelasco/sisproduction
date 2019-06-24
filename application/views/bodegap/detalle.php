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
                                    <div class="col-md-12">
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
                                                                   <?php if ($value->idestatus == 4 or $value->idestatus == 8) { ?>
                                                            <div class="checkbox-group required">
                                                                <input type="checkbox" name="id[]" value="<?php echo $value->idpalletcajas; ?>">
                                                            </div>

                                                        <?php } ?>
                                                                </td>
                                                                <td scope="row"><?php echo $value->nombre; ?></td>
                                                                <td><?php echo $value->numeroparte; ?></td>
                                                                <td><?php echo $value->cantidad; ?></td>
                                                                <td><?php echo $value->descripcion; ?></td>
                                                                <td>
                                                                   <?php
                                                        if ($value->idestatus == 4) {
                                                            echo '<label style="color:green;">EN VALIDACIÓN</label>';
                                                        } else if ($value->idestatus == 3) {
                                                            echo '<label style="color:red;">R. A PACKING</label>';
                                                        }else if ($value->idestatus == 14) {
                                                            echo '<label style="color:blue;">EN PACKING</label>';
                                                        } else if ($value->idestatus == 6) {?> 
                                                            <label id="<?php echo $value->idpalletcajas; ?>" class="edit_data" style="color:red; font-weight: bolder" >R. A CALIDAD</label>

                                                        <?php } else if ($value->idestatus == 1) {
                                                            echo '<label style="color:green;">EN CALIDAD</label>';
                                                        } else if ($value->idestatus == 8) {
                                                            echo '<label style="color:green;">EN ALMACEN</label>';
                                                        }else if ($value->idestatus == 12) {
                                                            echo '<label style="color:blue;">EN HOLD</label>';
                                                        } else {
                                                            echo '<label>No found</label>';
                                                        }
                                                        ?>
                                                                </td>
                                                                <td align="center">
                                                                <?php
                                                        if ($value->posicion==NULL) {
                                                            echo '<p style="color:red;">No ubicado</p>';
                                                        }else{
                                                            echo '<p style="color:green;">';
                                                            echo $value->posicion;
                                                            echo '</p>';
                                                        }
                                                        ?>
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
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Motivo de rechazo</label>
                                                                            <textarea id="motivomsm" class="md-textarea form-control" rows="3" disabled=""></textarea>
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
                                        <label>Seleccionar motivo de rechazo</label>
                                        <select  class="form-control" id="motivo" name="motivorechazo" required> 
                                           <option value="">Seleccionar</option>
                                            <?php
                                                foreach($motivosrechazo as $valuemotivo){
                                                    echo '<option value='.$valuemotivo->idmotivorechazo.'>'.$valuemotivo->motivo.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6 col-sm-12 col-xs-12" >
                                     <div class="form-group"  id="idubicacion">
                                        <label>Seleccionar Ubicación</label>
                                        <select  class="form-control" id="ubicacion" name="ubicacion" required> 
                                           <option value="">Seleccionar</option>
                                            <?php foreach ($arrayposicionesbodega as $value2) { ?>
                                                              
                                            <option value="<?php echo $value2->idposicion ?>"> <?php echo $value2->nombreposicion; ?></option>
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
                                    </div>
                                    </div>

                                            <div class="row">
                                                <div class="col-sm-12" align="right">
<?php if (isset($datatransferencia) && !empty($datatransferencia)) { ?>
                                                       <button type="button" id="btnubicar" class="btn btn-success btn-sm"> <i class="fa fa-check-circle" aria-hidden="true"></i> Posicionar los Pallet</button>
                                    <button type="button" id="btnrechazar" class="btn btn-danger btn-sm"> <i class="fa fa-ban" aria-hidden="true"></i> Rechazar a Almacen</button>
                                                    <a target="_blank" href="<?php echo site_url('bodegap/generarPDFEnvio/' . $id) ?>" class="btn btn-default  btn-sm"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generar envio</a>
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
    $(document).ready(function () {
        $('#idmotivorechazo').hide();
        $('#idubicacion').hide();
        $('#btnrechazar').on('click', function () {
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {
                $('#idmotivorechazo').show();
                 $('#idubicacion').hide();
                var optId = $("#motivo").val();
                if(optId != ""){
                    form = $("#frmdetalle").serialize();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('bodega/rechazarACalidad'); ?>",
                        data: form,

                        success: function (data) {
                            //console.log(data);
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
                $('#errormsg').text("Seleccionar una casilla.");
            }

        });
             $('#btnubicar').on('click', function () {
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {
                $('#idubicacion').show();
                $('#idmotivorechazo').hide();
                var optId = $("#ubicacion").val();
                if(optId != ""){
                    form = $("#frmdetalle").serialize();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('bodega/agregarAUbicacion'); ?>",
                        data: form,

                        success: function (data) {
                            location.reload();
                            //Unterminated String literal fixed
                        }

                    });
                    //event.preventDefault();
                    return false;  //stop the actual form post !important!

                    //$('#frmdetalle').submit();
                } else {
                    $('#errormsg').text("Seleccionar una ubicación.");
                }
            } else {
                $('#errormsg').text("Seleccionar una casilla.");
            }

        });
        $('.selectposicion').on('change', function () {
            var dataselect = $(this).val();
            var iddetalleparte = $('#iddetalleparte').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('bodega/addPositionWereHouse'); ?>",
                data: "posicion=" + dataselect + "&iddetalleparte=" + iddetalleparte,
                dataType: "html",
                success: function (data) {
                    console.log(data);
                    location.reload();
                    //Unterminated String literal fixed
                }

            });

        });
        //Asignar posicion


              $(document).on('click', '.edit_data', function () {
            var idpalletcajas = $(this).attr("id");
            //$('#myModalMSG').modal('show');
            $.ajax({
                url: "<?php echo site_url('bodegap/rechazopallet'); ?>",
                method: "POST",
                data: {idpalletcajas: idpalletcajas},
                dataType: "json",
                success: function (data) {
                    $('#motivomsm').val(data.motivo); 
                    $('#myModalMSG').modal('show');
                }
            });
        });


    });



</script>


<!-- /page content -->
