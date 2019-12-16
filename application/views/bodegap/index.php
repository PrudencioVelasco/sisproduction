<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><strong>Administrar Bodega</strong></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table is-bordered is-hoverable" id="datatable2">
                                            <thead class="text-white bg-dark" >
                                            <th>Transferencia</th> 
                                            <th>Fecha</th> 
                                            <th>Estatus</th>
                                            <th>Retorno</th> 
                                            <th>Opción</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($datatransferencia) && !empty($datatransferencia)) {
                                                    foreach ($datatransferencia as $value) {
                                                        if(!empty($value->estatus)){
                                                        ?>
                                                        <tr   class="table-default"> 
                                                            <td><strong><?php echo $value->folio; ?></strong></td> 
                                                            <td><?php echo  date_format(date_create($value->fecharegistro),"d/m/Y h:i A") ?></td> 
                                                            <td>
                                                                <?php
                                                                if(!empty($value->estatus)){
                                                                    echo '<label>'.$value->estatus.'</label>';
                                                                } 
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if($value->devolucion == 1){
                                                                    echo '<label class="label label-success">SI</label>';
                                                                }else{
                                                                     echo '<label class="label label-danger">NO</label>';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td align="right"> 
                                                            <a class="btn btn-icons btn-rounded  btn-round btn-info btn-xs"  href="<?php echo site_url('bodegap/detalle/'.$value->idtransferancia.'/'.$value->folio) ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                    }
                                                }
                                                ?>
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

