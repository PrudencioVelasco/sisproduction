<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Modificar información</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <h5>Cliente: <strong><?php echo $informacion[0]->nombre;?></strong></h5>
                            </div>
                        </div>
                        <form id="editInformation">
                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Numero de parte</label>
                                        <input type="text" class="form-control" name="numeroparte" value="<?php echo $informacion[0]->numeroparte;?>" disabled>
                                        <input type="hidden" name="idpalletcajas" value="<?php echo $informacion[0]->idpalletcajas; ?>">
                                        <input type="hidden" name="idtransferencia" value="<?php echo $informacion[0]->idtransferancia; ?>">
                                        <input type="hidden" name="pallet" value="<?php echo $informacion[0]->pallet; ?>">
                                        <input type="hidden" name="idcajas" value="<?php echo $informacion[0]->idcajas; ?>">
                                        <input type="hidden" name="idestatus" value="<?php echo $informacion[0]->idestatus; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Revision</label>
                                        <input type="text" class="form-control" name="descripcion" autcomplete="off" placeholder="Revision" value="<?php echo $informacion[0]->descripcion; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Cantidad</label>
                                        <input type="text" class="form-control" id="cantidad" name="cantidad" autcomplete="off" placeholder="Revision" value="<?php echo $informacion[0]->cantidad; ?>" disabled>
                                    </div>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="idnuevacantidad"><font color="red">*</font> Nueva cantidad</label>
                                        <select class="form-control" id="idnuevacantidad" name="idnuevacantidad">
                                            <option value="">Seleccione una cantidad</option>
                                            <?php if(!empty($cantidades)):?>
                                                <?php foreach($cantidades as $data):?>
                                                    <option value="<?php echo $data->idcantidad;?>"><?php echo $data->cantidad; ?></option>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="x_title">
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12" align="left">
                                <button type="button" id="btnSendAllQuality" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                Enviar todo</button>
                                <button type="button" id="btnSendQuality" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                Enviar por parte</button>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12" align="right">
                                <button type="button" id="btnSendTrash" class="btn btn-dark"><i class="fa fa-trash" aria-hidden="true"></i>
                                Enviar a Basura</button>
                                <a  class="btn btn-danger" href="<?php echo base_url('hold/index'); ?>"><i class="fa fa-ban" aria-hidden="true"></i>
                                Cancelar</a>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        var myform;
        var disabled;
        var serialized;

        $("#btnSendQuality").click(function(){

            if ($("#idnuevacantidad").val() === '') {
                alert("Seleccione una cantidad");
            }else{
                myform = $('#editInformation');
            // Encuentra entradas deshabilitadas, y elimina el atributo "deshabilitado"
            disabled = myform.find(':input:disabled').removeAttr('disabled');
            // serializar el formulario
            serialized = myform.serialize();
            $.ajax({
             method: "POST",
             url: "<?php echo site_url('hold/sendQuality'); ?>",
             data: serialized,
             beforeSend: function( xhr ) {
                //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            }
        }).done(function(data) {
           if (data == true) {
            window.location.href = "<?php echo site_url('hold/index'); ?>";
        }
    });
                        // Volver a deshabilitar el conjunto de entradas que previamente habilitó
                        disabled.attr('disabled','disabled');
                    }
                });
        $("#btnSendAllQuality").click(function(){

            myform = $('#editInformation');

            disabled = myform.find(':input:disabled').removeAttr('disabled');

            serialized = myform.serialize();
            $.ajax({
                method: "POST",
                url: "<?php echo site_url('hold/sendAllQuality'); ?>",
                data: serialized,
                beforeSend: function( xhr ) {
                //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            }
        }).done(function(data) {
            if (data == true) {
                window.location.href = "<?php echo site_url('hold/index'); ?>";
            }
        });
                        // Volver a deshabilitar el conjunto de entradas que previamente habilitó
                        disabled.attr('disabled','disabled');
                    });

        $("#btnSendTrash").click(function(){
            myform = $('#editInformation');

            disabled = myform.find(':input:disabled').removeAttr('disabled');

            serialized = myform.serialize();
            $.ajax({
                method: "POST",
                url: "<?php echo site_url('hold/sendTrash'); ?>",
                data: serialized,
                beforeSend: function( xhr ) {
                //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            }
        }).done(function(data) {
            if (data == true) {
                window.location.href = "<?php echo site_url('hold/index'); ?>";
            }
        });
                        // Volver a deshabilitar el conjunto de entradas que previamente habilitó
                        disabled.attr('disabled','disabled');
                    });

        $('#idnuevacantidad').on('change', function(){
            var id = this.value;
            var cantidad = $('#cantidad').val();
            $.ajax({
                method: "POST",
                url: "<?php echo site_url('hold/validQuantity'); ?>",
                data: {id:id},
                beforeSend: function( xhr ) {
                //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            }
        }).done(function(data) {
            if (Number(data) >= Number(cantidad)) {
                Swal.fire(
                    'Cantidad',
                    'Seleccione una cantidad menor a la ya existente.',
                    'info'
                    )
            }
        });
    });
    });
</script>