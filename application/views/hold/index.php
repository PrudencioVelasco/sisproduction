 <div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-6" align="left">
                                <h2><strong>Modulo Hold (en espera)</strong></h2>
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
                                                    <th scope="col">Cajas</th> 
                                                    <th>Estatus</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (isset($datatransferencia) && !empty($datatransferencia)):?>
                                                <?php foreach ($datatransferencia as $value):?>
                                                    <tr>
                                                        <td><?php echo $value->folio; ?></td>
                                                        <td><?php echo $value->nombre; ?></td>
                                                        <td><?php echo $value->numeroparte; ?></td>
                                                        <td><?php echo $value->descripcion; ?></td>
                                                        <td><?php echo $value->cantidad; ?></td>
                                                        <td><label style="color:green;"><?php echo $value->nombrestatus;?></label>
                                                        </td>
                                                        <td align="center">
                                                            <a class="btn btn-icons btn-rounded  btn-round btn-info btn-xs"  href="<?php echo site_url('hold/detalle/'.$value->idpalletcajas) ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Modificar</a>
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