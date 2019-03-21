<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Detalles del envio</h3>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12"> 
                                <h4>Número de parte: <?php echo $detalle->numeroparte; ?></h4>
                                <h4><small>Número de transferencia:</small> <?php echo $detalle->folio; ?></h4>

                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12" align="right"> 
                                <h4>Cliente: <?php echo $detalle->nombre; ?></h4>
                            </div>
                        </div>
                        <hr/>

                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12">

                                <h3><small>Modelo: </small><?php echo $detalle->modelo ?></h3>

                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">

                                    <h3><small>Revision: </small><?php echo $detalle->revision ?></h3>

                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h3><small>Linea: </small><?php echo $detalle->linea ?></h3>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h4>Colocar los Pallet</h4>
                                <form method="post" id="frmdetalle" action="mk.php">
                                    <label id="errormsg" style="color:red;"></label>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Pallet</th>
                                                <th>Cajas</th>
                                                <th>Estatus</th> 
                                                <th>Ubicación</th>
                                                <th></th>   
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $i = 1;
                                            foreach ($palletcajas as $value) {
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php if ($value->idestatus == 4) { ?>
                                                            <div class="checkbox-group required">
                                                                <input type="checkbox" name="id[]" value="<?php echo $value->idpalletcajas; ?>">
                                                            </div>

                                                        <?php } ?>
                                                    </td>
                                                    <td><strong><?php echo $i++; ?></strong></td>
                                                    <td><?php echo $value->cajas ?></td>
                                                    <td>
                                                        <?php
                                                        if ($value->idestatus == 4) {
                                                            echo '<label style="color:green;">EN VALIDACIÓN</label>';
                                                        } else if ($value->idestatus == 3) {
                                                            echo '<label style="color:red;">R. A PACKING</label>';
                                                        } else if ($value->idestatus == 6) {
                                                            echo '<label style="color:red;">R. A CALIDAD</label>';
                                                        } else if ($value->idestatus == 1) {
                                                            echo '<label style="color:green;">EN CALIDAD</label>';
                                                        } else if ($value->idestatus == 8) {
                                                            echo '<label style="color:green;">EN ALMACEN</label>';
                                                        } else {
                                                            echo '<label>No found</label>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
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
                                                    <td align="right">
                                                        <?php if ($value->idestatus == 4 or $value->idestatus == 8) { ?>
                                                         
                                                            <select class="form-control selectposicion"name="posicion">
                                                                  <option>Seleccionar</option>
                                                                <?php foreach ($posicionbodega as $value2) { ?>
                                                              
                                                                    <option value="<?php echo $value->idpalletcajas . "-" . $value2->idposicion ?>"> <?php echo $value2->nombreposicion; ?></option>
                                                                        <?php } ?>
                                                            </select>


                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                            <?php } ?> 


                                        </tbody>
                                    </table>
                                    <input type="hidden" id="iddetalleparte" name="iddetalleparte" value="<?php echo $detalle->iddetalleparte ?>"/>
                                    <input type="hidden" name="operador" value="<?php echo $detalle->idoperador ?>"/>
                                    <div class="form-group" id="idmotivorechazo">
                                        <label><font color="red">*</font> Anotaciones de rechazo</label>
                                        <textarea class="form-control" name="motivorechazo" id="inputmotivorechazo" ></textarea>
                                    </div>
                                    <button type="button" id="btnrechazar" class="btn btn-danger btn-sm"> <i class="fa fa-ban" aria-hidden="true"></i> Rechazar a Almacen</button>
                                </form>
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
        $('#btnrechazar').on('click', function () {
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {
                $('#idmotivorechazo').show();
                if ($.trim($("#inputmotivorechazo").val())) {
                    form = $("#frmdetalle").serialize();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('bodega/rechazarACalidad'); ?>",
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
                    $('#errormsg').text("Escribir motivo de rechazo.");
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

    });



</script>
