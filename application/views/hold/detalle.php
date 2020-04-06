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
                                        <label>Número de parte</label>
                                        <input type="text" class="form-control" name="numeroparte" value="<?php echo $informacion[0]->numeroparte;?>" disabled>
                                        <input type="hidden" name="idpalletcajas" value="<?php echo $informacion[0]->idpalletcajas; ?>">
                                        <input type="hidden" name="idtransferencia" value="<?php echo $informacion[0]->idtransferancia; ?>">
                                        <input type="hidden" name="pallet" value="<?php echo $informacion[0]->pallet; ?>">
                                        <input type="hidden" name="idcajas" value="<?php echo $informacion[0]->idcajas; ?>">
                                        <input type="hidden" name="cantidadcajas" value="<?php echo $informacion[0]->cantidad; ?>">
                                        <input type="hidden" name="idestatus" value="<?php echo $informacion[0]->idestatus; ?>">
                                         <input type="hidden" name="idrevision" value="<?php echo $informacion[0]->idrevision; ?>">

                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Revisión</label>
                                        <input type="text" class="form-control" name="descripcion" autcomplete="off" placeholder="Revision" value="<?php echo $informacion[0]->descripcion; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">

                                    <div class="form-group">
                                        <label>Cantidad de Cajas</label>
                                        <input type="text" class="form-control" id="cantidad" name="cantidad" autcomplete="off" placeholder="Revision" value="<?php echo $informacion[0]->cantidad; ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="idnuevacantidad"><font color="red">*</font> Nueva cantidad</label>
                                        <input type="text" name="ccajas" id="ccajas" class="form-control"  placeholder="Cantidad de Cajas"><br>
                                          <div class="alert alert-danger print-error-msg" style="display:none"></div>
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
                                Enviar todo a Calidad</button>
                                <button type="button" id="btnSendQuality" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                Enviar por parte a Calidad</button>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12" align="right">
                                <button type="button" id="btnSendTrash" class="btn btn-dark"><i class="fa fa-trash" aria-hidden="true"></i>
                                Enviar todo a Basura</button>
                                <a  class="btn btn-danger" href="<?php echo base_url('Hold/index'); ?>"><i class="fa fa-ban" aria-hidden="true"></i>
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

                myform = $('#editInformation');
            // Encuentra entradas deshabilitadas, y elimina el atributo "deshabilitado"
            disabled = myform.find(':input:disabled').removeAttr('disabled');
            // serializar el formulario
            serialized = myform.serialize();
            $.ajax({
             method: "POST",
             url: "<?php echo site_url('Hold/sendQuality'); ?>",
             data: serialized,
             beforeSend: function( xhr ) {
                //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            }
        }).done(function(data) {
            console.log(data);
             var msg = $.parseJSON(data);
                    console.log(msg.error);
                    if((typeof msg.error === "undefined")){
                    $(".print-error-msg").css('display','none');
                     window.location.href = "<?php echo site_url('hold/index'); ?>";
                    }else{
                    $(".print-error-msg").css('display','block');
                    $(".print-error-msg").html(msg.error);

                    }
         //  if (data == true) {
           // window.location.href = "<?php //echo site_url('hold/index'); ?>";
       // }
    });
                        // Volver a deshabilitar el conjunto de entradas que previamente habilitó
                        disabled.attr('disabled','disabled');

                });
        $("#btnSendAllQuality").click(function(){

            myform = $('#editInformation');

            disabled = myform.find(':input:disabled').removeAttr('disabled');

            serialized = myform.serialize();
            $.ajax({
                method: "POST",
                url: "<?php echo site_url('Hold/sendAllQuality'); ?>",
                data: serialized,
                beforeSend: function( xhr ) {
                //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            }
        }).done(function(data) {
            if (data == true) {
                window.location.href = "<?php echo site_url('Hold/index'); ?>";
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
                url: "<?php echo site_url('Hold/sendTrash'); ?>",
                data: serialized,
                beforeSend: function( xhr ) {
                //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            }
        }).done(function(data) {
            if (data == true) {
                window.location.href = "<?php echo site_url('Hold/index'); ?>";
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
                url: "<?php echo site_url('Hold/validQuantity'); ?>",
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
