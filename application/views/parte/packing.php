<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Agregar número de parte a packing</h3>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <h5>Número de parte: <strong><?php echo $detalleparte->numeroparte ?></strong></h5>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12" align="right">
                                <h5>Nombre del Cliente: <strong><?php echo $detalleparte->nombre ?></strong></h5>
                            </div>
                        </div>
                        <form method="POST"  action="<?= base_url('parte/enviarCalidadNew') ?>">
                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Modelo</label>
                                        <input type="text" class="form-control" name="modelo" autcomplete="off" placeholder="Modelo" value="<?php echo set_value('modelo'); ?>" required="">
                                        <label style="color:red;"><?php echo form_error('modelo'); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Revision</label>
                                        <input type="text" class="form-control" name="revision" autcomplete="off" placeholder="Revision" value="<?php echo set_value('revision'); ?>" required="">
                                        <label style="color:red;"><?php echo form_error('revision'); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Linea</label>
                                        <input type="text" class="form-control" name="linea" autcomplete="off" placeholder="Linea" value="<?php echo set_value('linea'); ?>" required="">
                                        <label style="color:red;"><?php echo form_error('linea'); ?></label>
                                    </div>
                                </div> 
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Enviarlo a calidad</label>
                                        <select class="form-control" name="usuariocalidad" required="">
                                            <option value="">Seleccionar</option>
                                            <?php
                                            foreach ($usuarioscalidad as $value) {
                                                echo '<option value=' . $value->idusuario . ' >' . $value->name . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <label style="color:red;"><?php echo form_error('usuariocalidad'); ?></label>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Total de pallet</label>
                                        <input type="number" class="form-control" name="pallet" placeholder="Pallet" required />
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Cajas por pallet</label>
                                        <input type="number" class="form-control" placeholder="Cajas" name="cajas" required/>
                                    </div>
                                </div>
                            </div>
                          
                             <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" align="right">
                                    <input type="hidden" name="idparte" value="<?php echo $idparte ?>">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                        Enviar a Calidad</button>
                                    <a  class="btn btn-danger" href="<?php echo site_url('parte/'); ?>"><i class="fa fa-ban" aria-hidden="true"></i>
                                        Cancelar</a>

                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
