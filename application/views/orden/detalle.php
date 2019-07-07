<!-- page content -->

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Generar una orden de salida</h3>
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
                        <br/>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="form-group">
                                    <input type="text" class="form-control" autofocus="" placeholder="Codigo de Barra"  name="po">  
                                </div>
                            </div>
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
                                            <th><strong>Pallet</strong></th>
                                            <th><strong>Caja x Pallet</strong></th>
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
                                            echo "<td>" . $value->numeroparte . "</td>";
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
                                                <?php
                                                if ($value->tipo == 0) {
                                                    echo $value->cajaspallet;
                                                } else {
                                                    echo $value->caja;
                                                }
                                                ?>
                                            </td>
                                            <?php
                                            echo "<td>" . $value->modelo . "</td>";
                                            echo "<td>" . $value->revision . "</td>";
                                             if ($value->tipo == 0) {
                                            echo "<td>" . $value->nombreposicion . "</td>";
                                            }else{
                                               echo "<td> --- </td>"; 
                                            }
                                            ?>
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
                                                                echo "<td>$value->totalpallet</td>";
                                                                echo "<td>$value->sumacajas</td>";
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
                                                                echo "<td>$value->sumacajas</td>";
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 