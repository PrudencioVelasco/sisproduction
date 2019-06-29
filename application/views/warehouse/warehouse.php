 <div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-6" align="left">
                                <h2><strong>Listado de Almacen</strong></h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="datatable" class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No. Transferencia</th>
                                                    <th scope="col">Cliente</th>
                                                    <th scope="col">No. Parte</th>
                                                    <th scope="col">Revision</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Posicion</th> 
                                                    <th>Estatus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (isset($informacion) && !empty($informacion)):?>
                                                <?php foreach ($informacion as $value):?>
                                                    <tr>
                                                        <td><?php echo $value->idtransferancia; ?></td>
                                                        <td><?php echo $value->nombre; ?></td>
                                                        <td><?php echo $value->numeroparte; ?></td>
                                                        <td><?php echo $value->descripcion; ?></td>
                                                        <td><?php echo $value->cantidad; ?></td>
                                                        <td><?php echo $value->nombreposicion; ?></td>
                                                        <td><label style="color:green;"><?php echo $value->nombrestatus;?></label>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;?>
                                            <?php endif;?> 
                                        </tbody>
                                    </table>
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
<!-- /page content -->