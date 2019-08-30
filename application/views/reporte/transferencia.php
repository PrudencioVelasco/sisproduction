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
                                <div class="form-group">
                                    <label><font color="red">*</font> Módulo</label>
                                    <select class="form-control" required name="modulo"> 
                                        <option value="">Seleccionar</option>
                                        <option value="1">PACKING</option>
                                        <option value="2">CALIDAD</option>
                                        <option value="3">ALMACEN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group"  >
                                    <button type="submit"  style="margin-top: 25px" class="btn btn-primary">Buscar</button>
                                </div>
                            </div>
                        </div> 
                    </form>
                    <hr/>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12"> 
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>T</th>
                                        <th>N. Parte</th>
                                        <th>Módelo</th>
                                        <th>Revisión</th>
                                        <th>Pallet</th>
                                        <th>C</th>  
                                        <th>Fecha</th> 
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <?php
                                    if (isset($result) && !empty($result)) {
                                        foreach ($result as $value):
                                            ?>
                                            <tr>
                                                <td><?php echo $value->folio ?></td>
                                                <td><?php echo $value->numeroparte ?></td>
                                                <td><?php echo $value->nombremodelo ?></td>
                                                <td><?php echo $value->nombrerevision ?></td>
                                                <td><?php echo "1" ?></td>
                                                <td><?php echo $value->cantidad ?></td>
                                                <td><?php echo date("d/m/Y", strtotime($value->fecha)); ?></td>  
                                                <td>
                                                    <?php
                                                    if ($modulo == "1") {
                                                        switch ($value->idestatus) {
                                                            case 1:
                                                                # code...
                                                                echo '<span class="label label-info">E. a Calidad</span>';
                                                                break;
                                                            case 8:
                                                                # code...
                                                                echo '<span class="label label-success">En Bodega</span>';
                                                                break;
                                                            case 3:
                                                                # code...
                                                                echo '<span class="label label-danger">Rechazado</span>';
                                                                break;

                                                            default:
                                                                # code...
                                                                break;
                                                        }
                                                    } elseif ($modulo == "2") {
                                                        # code...
                                                        switch ($value->idestatus) {
                                                            case 4:
                                                                # code...
                                                                echo '<span class="label label-info">E. a Almacen</span>';
                                                                break;
                                                            case 8:
                                                                # code...
                                                                echo '<span class="label label-success">En Bodega</span>';
                                                                break;
                                                            case 6:
                                                                # code...
                                                                echo '<span class="label label-danger">Rechazado</span>';
                                                                break;

                                                            default:
                                                                # code...
                                                                break;
                                                        }
                                                    } elseif ($modulo == "3") {
                                                        # code...
                                                        switch ($value->idestatus) {
                                                            case 4:
                                                                # code...
                                                                echo '<span class="label label-info">E. a Almacen</span>';
                                                                break;
                                                            case 8:
                                                                # code...
                                                                echo '<span class="label label-success">En Bodega</span>';
                                                                break;

                                                            default:
                                                                # code...
                                                                break;
                                                        }
                                                    } else {
                                                        
                                                    }
                                                    ?>

                                                </td>
                                            </tr> 
                                        <?php endforeach ?>
                                    <?php } ?>

                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




