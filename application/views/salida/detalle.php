<!-- page content -->

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>GENERAR ORDEN DE SALIDA</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>N. de Control: <strong><?php echo $detallesalida->numerosalida; ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>N. Transferencia: <strong>#<?php echo $detallesalida->idsalida; ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 text-right">
                                <div class="form-group">
                                    <h4>Cliente: <strong><?php echo $detallesalida->nombre; ?></strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>P.O.: <strong><?php echo $detallesalida->po; ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Notas: <strong><?php echo $detallesalida->notas; ?></strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php if ($detallesalida->finalizado == 0) { ?>
                                    <button type="button" class="btn  btn-round btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-search" aria-hidden="true"></i> Buscar parte</button>
                                <?php } ?>
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header modal-header-info-nomodal">
                                                <h3 class="modal-title" id="exampleModalCenterTitle">Agregar número de parte</h3>

                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>Trans.</th>
                <th>N. Parte</th>
                <th>Pallet</th>
                <th>CxP</th>
                <th><strong style="color: green">C. Disponibles</strong></th>
                <th>N.M.</th>
                <th>Revisión</th>
                <th>Fecha</th>
                <th>Ubicación</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datosparte as $value) {?>
            <tr>
                <td><a href="<?php echo site_url('salida/agregarParteOrdenDetallado/'.$value["idtransferancia"].'/'.$value["idcajas"].'/'.$idsalida ) ?>"> <?php echo $value["folio"]; ?></a></td>
                 <td><strong><?php echo $value["numeroparte"]; ?></strong></td>
                <td><?php echo $value["totalpallet"]; ?></td>
                 <td><?php echo number_format($value["cajasporpallet"]); ?></td>
                  <td><strong style="color: green"><?php echo number_format($value["cajasdisponibles"]); ?></strong></td>
                   <td><?php echo $value["modelo"]; ?></td>
                    <td><?php echo $value["revision"]; ?></td>
                     <td><?php echo $value["fecha"]; ?></td>
                     <td><?php echo $value["ubicaciondisponibles"]; ?></td>
            </tr>
            <?php }
            ?>
    </table>
                                                    </div>
                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-ban'></i> Cerrar</button>

                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <?php if (isset($detalleparte) && !empty($detalleparte)) { ?>
                                <form method="post" id="frmagregar" action="">
                                    <div class="col-md-3 col-sm-12 col-xs-12 ">
                                        <div class="form-group">
                                            <label><font color="red">*</font> Parte</label>
                                            <input type="text" name="numeroparte" class="form-control" value="<?php echo $detalleparte->numeroparte ?>" disabled="">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12 ">
                                        <div class="form-group">
                                            <label><font color="red">*</font> Tipo</label>
                                            <p style="padding-top:5px;">

                                <input name="tipo" type="radio" id="radio_32" checked="" class="with-gap radio-col-green" value="pallet" required/>
                                <label for="radio_32">PALLET</label>

                                <input name="tipo" type="radio" id="radio_31" class="with-gap radio-col-red"    value="parciales"  />
                                <label for="radio_31">PARCIAL</label>



                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 " id="pallet">
                                        <div class="form-group">
                                            <label><font color="red">*</font> C. Pallet</label>
        <input type="text" name="pallet" id="ppallet" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"  class="form-control" placeholder="C. Pallet">
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-12 col-xs-12" id="cajas">
                                        <div class="form-group">
                                            <label><font color="red">*</font> Total Cajas</label>
                                            <input type="text" name="cajas" id="pcajas" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"  class="form-control" placeholder="Total Cajas" >
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12" id="cajas">
                                        <div class="form-group">
                                            <label>P.O.</label>
                                            <input type="text" name="po" class="form-control" placeholder="P.O." >
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 ">
                                        <div class="form-group">
                                            <input type="hidden" name="idtransferecia" value="<?php echo $detalleparte->idtransferencia; ?>"/>
                                            <input type="hidden" name="idsalida" value="<?php echo $idsalida; ?>"/>
                                            <input type="hidden" name="idcajas" value="<?php echo $idcajas; ?>"/>
                                            <input type="hidden" name="cajasporpallet" value="<?php echo $cajasporpallet ?>"/>
                                            <button type="button" id="btnagregar" style="margin-top:22px;" class="btn btn-default"><i class='fa fa-plus'></i> Agregar</button>
                                        </div>
                                    </div>
                                </form>
                            <?php }
                            ?>

                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <label id="msgerror" style="color:red;"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table class="table table-striped responsive-utilities jambo_table bulk_action" >
                                    <thead>
                                        <tr>
                                            <th><strong>Número de parte</strong></th>
                                            <th><strong>Tipo</strong></th>
                                            <th><strong>C. Pallet</strong></th>
                                            <th><strong>C. Caja por Pallet</strong></th>
                                            <th><strong>Modelo</strong></th>
                                            <th><strong>Revisión</strong></th>
                                            <th><strong>Ubicación</strong></th>
                                            <?php if ($detallesalida->finalizado == 0) { ?>
                                                <th></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <?php
                                    if (isset($detalleorden) && !empty($detalleorden)) {
                                        $totalpallet = 0;
                                        $totalcajas = 0;
                                        foreach ($detalleorden as $value) {




                                            // code...
                                            echo "<tr>";
                                            echo "<td><strong>" . $value->numeroparte . "</strong></td>";
                                            echo '<td>';
                                            if ($value->tipo == 0) {
                                                echo '<label style="color:#8938f5;">Por pallet</label>';
                                            } else {
                                                echo '<label style="color:#1abd53;">Parciales</label>';
                                            }
                                            echo '</td>';
                                            echo "<td>1</td>";
                                            ?>
                                            <td>
                                                <strong>
                                                <?php
                                                if ($value->tipo == 0) {
                                                    echo number_format($value->cajaspallet);
                                                } else {
                                                    echo number_format($value->caja);
                                                }
                                                ?>
                                            </strong>
                                            </td>
                                            <?php
                                            echo "<td>" . $value->modelo . "</td>";
                                            echo "<td>" . $value->revision . "</td>";
                                             echo "<td>";
                                              if ($value->tipo == 0) {
                                                echo '<label>'.$value->nombreposicion.'</label>';
                                            } else {
                                                echo '<label>---</label>';
                                            }
                                             echo "</td>" ;
                                            ?>
                                            <?php if ($detallesalida->finalizado == 0) { ?>
                                                <td align="right">
                                                    <input type="hidden" id="idordensalida" name="idordensalida" value="<?php echo $value->idordensalida; ?>"/>

                                                    <a onclick="return confirm('Estas seguro de quitar?')" href="<?php echo site_url('salida/eliminarParteOrden/' . $value->idordensalida . '/' . $value->idsalida . '/' . $value->idpalletcajas) ?>"><i style="color:red;padding-right: 10px;"  class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
                                                </td>
                                            <?php } ?>
                                            <?php
                                            echo "</tr>";
                                        }


                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <?php
                          if (isset($detallepallet) && !empty($detallepallet)) {
                        ?>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">

                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style=" background-color: #d8d8d8">
                                            <h4 class="panel-title" >
                                                <a data-toggle="collapse" href="#collapse1"><i class="fa fa-bars" aria-hidden="true"></i> Click para ver detalles de la Orden.</a>
                                            </h4>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Número de parte</th>
                                                            <th>Modelo</th>
                                                            <th>Pallet</th>
                                                            <th>Cajas</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                          $totalpallet = 0;
                                                        $totalcajas = 0;
                                                        if (isset($detallepallet) && !empty($detallepallet)) {
                                                            foreach ($detallepallet as $value) {
                                                                $totalpallet += $value->totalpallet;
                                                                $totalcajas += $value->sumacajas;
                                                                echo "<tr>";
                                                                echo "<td><i class='fa fa-check'  style='color:#8938f5;' aria-hidden='true'></i> $value->numeroparte </td>";
                                                                echo "<td>$value->modelo</td>";
                                                                echo "<td>".number_format($value->totalpallet)."</td>";
                                                                echo "<td>".number_format($value->sumacajas)."</td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                        if (isset($detalleparciales) && !empty($detalleparciales)) {
                                                            foreach ($detalleparciales as $value) {
                                                                $totalpallet += 1;
                                                                $totalcajas += $value->sumacajas;
                                                                echo "<tr>";
                                                                echo "<td><i class='fa fa-check'  style='color:#1abd53;' aria-hidden='true'></i> $value->numeroparte </td>";
                                                                echo "<td>$value->modelo</td>";
                                                                echo "<td>1</td>";
                                                                echo "<td>".number_format($value->sumacajas)."</td>";
                                                                echo "</tr>";
                                                            }
                                                        }

                                                        echo "<tr>";
                                                        echo "<td></td>";
                                                        echo "<td></td>";
                                                        echo "<td><strong>" . number_format($totalpallet) . "</strong></td>";
                                                        echo "<td><strong>" . number_format($totalcajas) . "</strong></td>";
                                                        echo "</tr>";
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php } ?>
                        <?php if ($detallesalida->finalizado == 0) { ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" align="right">
                                    <form method="POST" action="<?= base_url('salida/terminarOrdenSalida') ?>">
                                        <input type="hidden" name="idsalida" value="<?php echo $idsalida; ?>"/>
                                        <button type="submit" onclick="return confirm('Esta seguro de Terminar la Orden de Salida?')" id="btnterminarorden" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>
                                            Terminar Orden</button>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($detallesalida->finalizado == 1) { ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" align="right">
                                 <a href="<?= base_url('salida/reactivar/'.$idsalida) ?>" onclick="return confirm('Esta seguro de Reactivar la Orden de Salida?')"  class="btn btn-warning"><i class="fa fa-history"></i> Reactivar</a>
                                    <a target=”_blank” href="<?php echo site_url('salida/generarPDFOrden/' . $idsalida) ?>"  class="btn btn-default"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                        Descargar Orden</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#pallet').show();
        $('#cajas').hide();
        $('#radio_32').on('click', function () {
            $('#pallet').show();
            $('#ppallet').val("");
            $('#cajas').hide();
            $('#pcajas').val("");

        });
        $('#radio_31').on('click', function () {
            $('#pallet').hide();
            $('#ppallet').val("");
            $('#cajas').show();
            $('#pcajas').val("");
        });
        $('#btnagregar').on('click', function () {

            form = $("#frmagregar").serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('salida/agregarNumeroParteOrder'); ?>",
                data: form,

                success: function (data) {

                    console.log(data);
                    if (data == 10) {
                        $("#msgerror").text("Campo requerido.");
                    } else if (data == 11) {
                        $("#msgerror").text("Solo debe de ser númerico.");
                    } else if (data == 12) {
                        $("#msgerror").text("Debe de ser mayor a 0.");
                    } else if (data == 13) {
                        $("#msgerror").text("No existe Stock suficiente.");
                    }else if (data == 14) {
                        $("#msgerror").text("Lo debe de agregar como Parciales.");
                    } else {
                        //location.reload();
                        window.location.href="<?php echo base_url(); ?>/salida/detalleSalida/<?php echo $idsalida ?>";
                    }
                    // location.reload();
                    //$("#msgerror").text(data);
//                               if(data == 0){
//                                  $("#msgerror").text("No existe suficiente en Existencia.");
//                               setTimeout(function(){
//                                   location.reload();
//                               },5000);
//                               }else{
//                                setTimeout(function(){
//                                   location.reload();
//                               },1000);
//                               }
                }

            });
            //event.preventDefault();
            return false;  //stop the actual form post !important!


        });
    });
</script>
