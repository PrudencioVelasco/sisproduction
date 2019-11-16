<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Subir Inventario</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"  method="POST" action="<?php echo base_url('Catalogo/comparar'); ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Número identificador</label>
                                        <input type="text"    name="identificador"   class="form-control" value="<?php echo set_value('identificador'); ?>">
                                        <div class="text-danger"  > <?php echo form_error('identificador'); ?>  </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Archivo</label>
                                        <input type="file" id="first-name"   name="mi_archivo" required="" accept=".xls,.xlsx" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('mi_archivo'); ?>"> 
                                        <div class="text-danger" > <?php echo form_error('mi_archivo'); ?>  </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group"> 
                                        <button type="submit" style="margin-top: 25px" class="btn btn-success">Subir documento</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="row">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Número identificador</th>
                                        <th>Usuario</th>
                                        <th>Fecha</th>
                                        <th>Estatus</th>
                                        <th  align="right">Operación</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php if(isset($datos) && !empty($datos)){ 
                                        foreach ($datos as $value) { ?>
                                        <tr>
                                            <td><?= $value->identificador ?></td>
                                            <td><?= $value->name ?></td>
                                            <td><?= $value->fecha ?></td>
                                            <td ><?php 
                                            if($value->nosubido > 0){echo '<span class="label label-danger">Pendientes</span>';}else{echo'<span class="label label-success">Subidos</span>';}
                                            ?></td>
                                            <td align="right">
                                                 <a href="<?php echo site_url('catalogo/detalle/'.$value->identificador) ?>"  onclick="return confirm('Esta seguro de Eliminar?')" class="btn btn-danger btn-sm">Eliminar</a>
                                           
                                                <a href="<?php echo site_url('catalogo/detalle/'.$value->identificador) ?>" class="btn btn-primary btn-sm">Detalle</a> 
                                             </td>
                                        </tr>
                                    <?php } } ?>
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