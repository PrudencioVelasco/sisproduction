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
                        <form method="POST"  action="<?= base_url('Parte/enviarCalidadNew') ?>">
                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Modelo</label>
                                        <input type="text" class="form-control" name="modelo" autcomplete="off" placeholder="Modelo" value="<?php echo set_value('modelo'); ?>" required="">
                                        <label style="color:red;"><?php echo form_error('modelo'); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Revision</label>
                                        <input type="text" class="form-control" name="revision" autcomplete="off" placeholder="Revision" value="<?php echo set_value('revision'); ?>" required="">
                                        <label style="color:red;"><?php echo form_error('revision'); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><font color="red">*</font> Linea</label>
                                        <select class="form-control" name="linea" required="">
                                            <option value="">Seleccionar</option>
                                            <?php
                                            foreach ($lineas as $value) {
                                                echo '<option value=' . $value->idlinea . ' >' . $value->nombrelinea . '</option>';
                                            }
                                            ?>
                                        </select>

                                        <label style="color:red;"><?php echo form_error('linea'); ?></label>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <?php if (isset($error) && !empty($error)) { ?>
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Error!</strong> Es necesario agregar los pallet.
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="myFields"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <button id="add_button" class="addNew btn btn-default btn-sm">
                                        <span class="fa fa-plus"></span> Agregar pallet
                                    </button>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" align="right">
                                    <input type="hidden" name="idparte" value="<?php echo $idparte ?>">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                        Enviar a Calidad</button>
                                    <a  class="btn btn-danger" href="<?php echo site_url('Parte/'); ?>"><i class="fa fa-ban" aria-hidden="true"></i>
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
<script type="text/javascript">

    $(document)
            .ready(
                    function () {
                        var wrapper = $(".myFields");
                        $(add_button)
                                .click(
                                        function (e) {
                                            e.preventDefault();
                                            $(wrapper)
                                                    .append(
                                                            '<div class="form-group"><div class="col-md-4 col-sm-12 col-xs-12"><label class="label label-default" for="wish">Número de pallet</label><input type="number" name="pallet[]" class="form-control" value="1" readonly  required/></div><div class="col-md-4 col-sm-12 col-xs-12"><label class="label label-default" for="wish">Cantidad de cajas</label><input type="number" name="cajas[]" min="1" step="1" class="form-control" required/></div><br><a href="#"	class="btn btn-warning btn-sm delFld"><i class="fa fa-trash" aria-hidden="true"></i></a></div>'); //add fields
                                        });
                        $(wrapper).on("click", ".delFld", function (e) {
                            e.preventDefault();
                            $(this).parent('div').remove();
                        })
                    });
</script>
