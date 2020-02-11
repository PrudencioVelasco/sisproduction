<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3><strong>Administrar Transferencias de Ajustes</strong></h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="<?php echo site_url('Regresar/agregar_regresar/')?>" class="btn btn-icons   btn-primary"  onclick="return confirm('Desea agregar Transferencia de Ajuste?')"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Transferencia</a>  
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
                                            <th>Opción</th>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if (isset($datatransferencia) && !empty($datatransferencia)) {

                                                    foreach ($datatransferencia as $value) { 
                                                        if($value->ajustecaja == 1){

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
                                                            <td align="right"> 
                                                                 <a class="btn btn-icons btn-danger" onclick="return confirm('Confirmar?')" href="<?php echo site_url('transferencia/eliminar/'.$value->idtransferancia) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a>
                                                            <a class="btn btn-info"  href="<?php echo site_url('regresar/detalle/'.$value->idtransferancia.'/'.$value->folio) ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</a>
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

