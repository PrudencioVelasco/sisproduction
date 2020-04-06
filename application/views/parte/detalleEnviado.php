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
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <h4>Número de parte: <strong><?php echo $detalle->numeroparte; ?></strong></h4>
                                    <h4><small>Número de transferencia: </small><strong><?php echo $detalle->folio; ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12" align="center">
                                <div class="form-group">
                                    <h4>Cliente: <strong><?php echo $detalle->nombre; ?></strong></h4>
                                </div>
                            </div>

                        </div>
                        <form method="post" id="frmmodificar"  action="<?= base_url('Parte/modificarTransferencia') ?>">
                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Modelo</label>
                                        <input type="text" class="form-control" name="modelo" autcomplete="off" placeholder="Modelo" value="<?php echo $detalle->modelo ?>">
                                        <label style="color:red;"><?php echo form_error('modelo'); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Revision</label>
                                        <input type="text" class="form-control" name="revision" autcomplete="off" placeholder="Revision" value="<?php echo $detalle->revision ?>">
                                        <label style="color:red;"><?php echo form_error('revision'); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Linea</label>
                                        <select class="form-control" name="linea" required="">
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($lineas as $value) { ?>
                                                <option <?php
                                            if ($value->idlinea == $detalle->idlinea) {
                                                echo "selected";
                                            }
                                                ?>
                                                    value="<?php echo $value->idlinea ?>" ><?php echo $value->nombrelinea ?></option>
                                                <?php } ?>
                                        </select>
                                        <label style="color:red;"><?php echo form_error('linea'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-info btn-sm" id="btnagregarpallet" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        Agregar</button>
                                    <br/>
                                    <label id="errormsg" style="color:red;"></label>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <!--<th>#</th>-->
                                                <th></th>
                                                <th>Pallet</th>
                                                <th>Cajas</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($palletcajas) && !empty($palletcajas)) {
                                                $i = 1;
                                                foreach ($palletcajas as $value) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php if ($value->idestatus == 3) { ?>
                                                                <div class="checkbox-group required">
                                                                    <input type="checkbox" name="id[]" value="<?php echo $value->idpalletcajas; ?>">
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td><?php echo $i++ ?></td>
                                                        <td><?php echo $value->cajas ?></td>
                                                        <td>
                                                            <?php if ($value->idestatus == 3) { ?>
                                                                <a style="color:red;" class="btnquitar" href="<?php echo site_url('Parte/quitarPalletCajas/' . $value->idpalletcajas . '/' . $detalle->iddetalleparte) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a> <label style="color:red;">Rechazado</label>
                                                                <?php
                                                            } else if ($value->idestatus == 1) {
                                                                echo '<label style="color:green;">E. A CALIDAD</label>';
                                                            } else if ($value->idestatus == 12) {
                                                                echo '<label style="color:blue;">EN HOLD</label>';
                                                            } else {
                                                                echo '<label style="color:green;">EN ALMACEN</label>';
                                                            }
                                                            ?> </td>
                                                        <td>
                                                            <a target="_blank" href="<?php echo site_url('Parte/etiquetaPacking/' . $detalle->iddetalleparte) . '/' . $value->idpalletcajas ?>"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a>
                                                            <input type="hidden" class="idpalletcajas" value="<?php echo $value->idpalletcajas; ?>"/>
                                                            <input type="hidden" class="iddetalleparte" value="<?php echo $detalle->iddetalleparte; ?>"/>
                                                             <i class="fa fa-print fa-2x btnimprimirpdf"  aria-hidden="true"></i>

                                                        </td>
                                                        <td>
                                                                <?php
                                                                if ($value->idestatus == 3) {
                                                                    echo '<label style="color:red;">' . $value->motivo . '</label>';
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>
                                                        <?php }
                                                    } ?>
                                        </tbody>
                                    </table>




                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12" align="right">
                                    <input type="hidden" name="iddetalleparte" value="<?php echo $detalle->iddetalleparte ?>">

                                    <button type="button" id="btnmodificar" name="reenviar" class="btn btn-success  btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i> Reenviar</button>
                                    <button type="submit"  name="modificar" class="btn btn-primary  btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</button>
                                        <a  class="btn btn-default  btn-sm" target="_blank" href="<?php echo site_url('Parte/generarPDFEnvio/' . $detalle->iddetalleparte) ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                        Generar envio</a>

                                </div>
                            </div>
                        </form>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel"><strong>Agregar Pallet</strong></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="<?= base_url('Parte/agregarPalletCajas') ?>">
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <label><font color="red">*</font> Número de pallet</label>
                                                    <input type="text" class="form-control" name="numeropallet"  autcomplete="off" value="1" readonly required>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <label><font color="red">*</font> Número de cajas</label>
                                                    <input type="number" class="form-control" name="numerocajas"  min="1" step="1" autcomplete="off" required>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <input type="hidden" name="iddetalleparte" value="<?php echo $detalle->iddetalleparte; ?>"/>
                                            <button type="submit" class="btn btn-primary">Agregar</button>
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
<script>
    $(document).ready(function () {
        $('#btnmodificar').on('click', function () {
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {
                form = $("#frmmodificar").serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Parte/reenviarCalidad'); ?>",
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
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $('.btnimprimirpdf').on('click', function () {
            var parametros = {
                "iddetalleparte" : $('.iddetalleparte').val(),
                "idpalletcajas" : $('.idpalletcajas').val()
        };
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Parte/imprimirEtiquetaPacking'); ?>",
                data: parametros,

                success: function (data) {


                    var uriWS = "ws://localhost:8080/websocketwoori/imprimir";
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
