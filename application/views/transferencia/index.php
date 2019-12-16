<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><strong>Administrar Transferencias</strong></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">
                                <div class="row">
                                   <div class="col-md-6 col-sm-12 col-xs-12 ">
                                        <a href="<?php echo site_url('transferencia/agregar/')?>" class="btn btn-icons btn-rounded  btn-primary"  onclick="return confirm('Esta seguros de crear una Transferencia.?')"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear Transferencia</a>  
                                    </div>
                                     <div class="col-md-6 col-sm-12 col-xs-12 " align="right">
                                        <a href="<?php echo site_url('devolucion/agregar_transferencia/')?>" class="btn btn-icons btn-rounded  btn-default"  onclick="return confirm('Esta seguro de crear una Retorno?')"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear Retorno</a>  
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                   <div class="col-md-12 col-sm-12 col-xs-12 ">
                                        <table class="table is-bordered is-hoverable" id="datatable2">
                                            <thead class="text-white bg-dark" >
                                            <th>Transferencia</th>
                                            <th>Usuario</th>
                                            <th>Fecha</th> 
                                            <th>Estatus</th>
                                            <th>Retorno</th> 
                                            <th align="right">Opción</th>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if (isset($datatransferencia) && !empty($datatransferencia)) {

                                                    foreach ($datatransferencia as $value) { 

                                                        ?>
                                                        <tr   class="table-default"> 
                                                            <td><strong><?php echo $value->folio; ?></strong></td>
                                                            <td><?php echo $value->nombre ?></td>
                                                            <td><?php echo date_format(date_create($value->fecharegistro),"d/m/Y h:i A") ?></td> 
                                                            <td>
                                                                <?php
                                                                if(!empty($value->estatus) && !is_null($value->estatus)){
                                                                    echo '<label>'.$value->estatus.'</label>';
                                                                }else if(!empty($value->estatusall)){
                                                                     echo '<label>'.$value->estatusall.'</label>';
                                                                }else{
                                                                    echo '<label>VACIO</label>';
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

                                                                 <a class="btn btn-icons btn-rounded  btn-round btn-danger btn-xs" onclick="return confirm('Confirmar?')" href="<?php echo site_url('transferencia/eliminar/'.$value->idtransferancia) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a>

                                                          

                                                            <?php if($value->devolucion == 1){?>
                                                                  <a class="btn btn-icons btn-rounded  btn-round btn-info btn-xs"  href="<?php echo site_url('devolucion/detalle/'.$value->idtransferancia.'/'.$value->folio) ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</a>
                                                            <?php }else{ ?>
                                                                  <a class="btn btn-icons btn-rounded  btn-round btn-info btn-xs"  href="<?php echo site_url('transferencia/detalle/'.$value->idtransferancia.'/'.$value->folio) ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</a>
                                                            <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <?php

                                                    
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

