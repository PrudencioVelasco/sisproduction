<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Reporte de Transferencias</h3>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <form method="POST" action="<?= base_url('reporte/buscar') ?>"> 
                        <div class="row">  

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> De</label>
                                    <input type="date" name="fechainicio" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> a</label>
                                    <input type="date" name="fechafin" class="form-control" required/>
                                </div>
                            </div>
 <div class="col-md-3 col-sm-12 col-xs-12">
     <div class="form-group"  >
         <button type="submit"  style="margin-top: 25px" class="btn btn-primary">Buscar</button>
                                </div>
                            </div>
                        </div> 
                    </form>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php if (isset($resultall) && !empty($resultall)) { ?>
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Transferencia</th>
                                            <th>N. Parte</th>
                                            <th>Modelo</th>
                                            <th>Revision</th>
                                            <th>Pallet</th>
                                            <th>C. por pallet</th>
                                            <th>Cantidad</th>
                                            <th>Linea</th>
                                            <th>Fecha</th>
                                            <th>Usuario</th>
                                            <th>Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($resultall as $row) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row->folio; ?></td>
                                                <td><?php echo $row->numeroparte; ?></td>
                                                <td><?php echo $row->modelo; ?></td>
                                                <td><?php echo $row->revision; ?></td>
                                                <td><?php echo $row->sumapallet; ?></td> 
                                                <td><?php echo $row->cajasporpallet; ?></td> 
                                                <td><?php echo $row->sumacajas; ?></td>
                                                <td><?php echo $row->nombrelinea; ?></td>
                                                <td><?php echo $row->fecharegistro; ?></td>
                                                <td><?php echo $row->nombreusuario; ?></td>
                                                <td><strong><?php echo $row->nombrestatus; ?></strong></td>
                                            </tr>
    <?php } ?>
                                    </tbody>
                                </table>
                            <?php } ?>
<?php if (isset($resultusers) && !empty($resultusers)) { ?>
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Transferencia</th>
                                            <th>N. Parte</th>
                                            <th>Modelo</th>
                                            <th>Revision</th>
                                            <th>Pallet</th>
                                            <th>Cantidad</th>
                                            <th>Linea</th>
                                            <th>Fecha</th>
                                            <th>Usuario</th>
                                            <th>Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($resultusers as $row) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row->folio; ?></td>
                                                <td><?php echo $row->numeroparte; ?></td>
                                                <td><?php echo $row->modelo; ?></td>
                                                <td><?php echo $row->revision; ?></td>
                                                <td><?php echo $row->pallet; ?></td> 
                                                <td><?php echo $row->cantidad; ?></td>
                                                <td><?php echo $row->linea; ?></td>
                                                <td><?php echo $row->fecharegistro; ?></td>
                                                <td><?php echo $row->nombreusuario; ?></td>
                                                <td><strong><?php echo $row->nombrestatus; ?></strong></td>
                                            </tr>
                                <?php } ?>
                                    </tbody>
                                </table>
<?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




