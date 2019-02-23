<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Detalles de la parte</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <h4>Número de parte: <?php echo $detalle->numeroparte; ?></h4>
                                    <h4><small>Número de transferencia:</small> <?php echo $detalle->folio; ?></h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                <div class="form-group">
                                    <?php if ($detalle->idestatus == 1): ?>
                                        <p><h3 style="color: #228b22;"><i class="fa fa-clock-o" aria-hidden="true"></i> EN ESPERA DE VALIDACIÓN</h3></p>
                                    <?php elseif ($detalle->idestatus == 4): ?>
                                        <p><h3 style="color: #008000;"><i class="fa fa-paper-plane" aria-hidden="true"></i> ENVIADO </h3></p>
                                    <?php elseif ($detalle->idestatus == 6): ?>
                                        <p><h3 style="color: #ff0000;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> RECHAZADO</h3></p>
                                    <?php else: ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Modelo: <strong><?php echo $detalle->modelo; ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Revisión: <strong><?php echo $detalle->revision ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Linea: <strong><?php echo $detalle->linea ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Cliente: <strong><?php echo $detalle->nombre ?></strong></h4>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12" >
                                <form method="POST" id="frmdetalle" action="ps.php">
                                    <label id="errormsg" style="color:red;"></label>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>#</th>
                                                <th>Pallet</th>
                                                <th>Cajas</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($palletcajas as $value) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox-group required">
                                                            <input type="checkbox" name="id[]" value="<?php echo $value->idpalletcajas; ?>">
                                                        </div>
                                                    </td>
                                                    <td><strong><?php echo $i++; ?></strong></td>
                                                    <td><?php echo $value->pallet ?></td>
                                                    <td><?php echo $value->cajas ?></td>
                                                </tr>
                                            <?php } ?> 

                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <label>Anotaciones de rechazo</label>
                                        <textarea class="form-control" >
                                            
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Enviarlo a Bodega</label>
                                        <select class="form-control" name="usuariobodega" id="usuariobodega">
                                            <option value="">Seleccionar un usuario</option>
                                            <?php foreach ($usuariosbodega as $value): ?>
                                                <option value="<?php echo $value->idusuario; ?>"><?php echo $value->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" name="iddetalleparte" value="<?php echo $detalle->iddetalleparte ?>">
                                        <input type="hidden" name="estatus" value="<?php echo $detalle->idestatus ?>">
                                        <input type="hidden" name="idoperador" value="<?php echo $detalle->idoperador ?>">
                                        <label style="color:red;"><?php echo form_error('usuariobodega'); ?></label>
                                    </div>

                                    <button type="button" id="btnenviar" class="btn btn-success btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar a Almacen</button>
                                    <button type="button" class="btn btn-danger btn-sm"> <i class="fa fa-ban" aria-hidden="true"></i> Rechazar a Almacen</button>
                                </form>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12" >
                                <p class="text-center text-gray" style="font-size: 14px; font-weight: bold;">Anotaciones de Almacen</p>
                                <?php if ($detalle->idestatus == 6) { ?>

                                    <?php
                                    if (isset($dataerrores) && !empty($dataerrores)) {
                                        foreach ($dataerrores as $value) {
                                            echo "<label style='color:red;'>";
                                            echo "* " . $value->comentariosrechazo . " - " . $value->fecharegistro;
                                            echo "</label>";
                                            echo "<br>";
                                        }
                                    }
                                    ?>
                                <?php
                                } else {
                                    echo '<p class="text-center">Sin anotaciones</p>';
                                }
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12" align="right">

                                <a target="_blank" href=" <?php echo base_url('parte/etiquetaCalidad/' . $detalle->iddetalleparte . ''); ?>" class="btn btn-default"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generar etiqueta</a>
                                <a target="_blank" href=" <?php echo base_url('calidad/generarPDFEnvio/' . $detalle->iddetalleparte . ''); ?>" class="btn btn-default"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generar envio</a>
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
        $('#btnenviar').on('click', function () {
            //$('#frmdetalle').submit();
            if ($('div.checkbox-group.required :checkbox:checked').length > 0) {

            } else {
                //alert("ss");
                //errormsg
                $('#errormsg').text("Seleccionar una casilla.");
            }
        });
    });
</script>
<!-- /. Modal para rechazar -->
<script src="<?php echo base_url(); ?>/assets/js/moduleQuality.js"></script>
<!--<?php var_dump($detalle); ?>-->