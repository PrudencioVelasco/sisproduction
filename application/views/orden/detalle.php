<!-- page content -->
<style type="text/css">
    .subrayado{
        font-weight: bold;
        text-decoration-line: underline;
    }
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Generar una orden de salida</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>N. de Control: <strong><?php echo $detallesalida->numerosalida; ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>N. Transferencia: <strong>#<?php echo $detallesalida->idsalida; ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 text-right">
                                <div class="form-group">
                                    <h4>Cliente: <strong><?php echo $detallesalida->nombre; ?></strong></h4>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>P.O.: <strong><?php echo $detallesalida->po; ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Notas: <strong><?php echo $detallesalida->notas; ?></strong></h4>
                                </div>
                            </div> 
                        </div>  
                        <br/>
                        <div class="row">
                            <div class="col-md-10 col-sm-10 col-xs-10 ">
                                <div class="form-group">
                                    <!--<input type="text" class="form-control"  autofocus="" id="codigo" placeholder="Codigo de Barra"  name="po">  -->
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2 ">
                                <div class="form-group" align="right">
                                    <input type="hidden" name="" id="idsalida" value="<?php echo $detallesalida->idsalida; ?>">
                                 </div>
                            </div>
                        </div>



                        <div class="modal" id="my_modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                                        <h4 class="modal-title"><strong>Escanear el código</strong></h4>
                                    </div>
                                    <div class="modal-body"> 
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                <label id="msgerror" style="color:red;"></label>
                                                <label id="msgcorrecto" style="color:green;"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                <div class="form-group">
                                                    <label><font color="red">*</font> Código de Barra</label>
                                                    <input type="text" class="form-control" onKeyPress="pasacampo(event)"   autofocus="" id="codigoescaneado" placeholder="Código de Barra"  name="codigoescaneado">  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                <div class="form-group">
                                                      <label><font color="red">*</font> Código de Cantidad</label>
                                                    <input type="text" class="form-control"  id="cantidadescaneado" placeholder="Código de Cantidad"  name="cantidadescaneado">  
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="bookId" id="bookId" value=""/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table class="table table-striped responsive-utilities jambo_table bulk_action" >
                                    <thead>
                                        <tr>
                                            <th><strong>Número de parte</strong></th>
                                            <th><strong>Tipo</strong></th>
                                            <th><strong>Pallet</strong></th>
                                            <th><strong>Caja x Pallet</strong></th>
                                            <th><strong>Modelo</strong></th>
                                            <th><strong>Revisión</strong></th>
                                            <th><strong>P. Ubicación</strong></th>
                                            <?php if ($detallesalida->finalizado == 0) { ?>
                                                <th></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <?php
                                    if (isset($detalleorden) && !empty($detalleorden)) {
                                        foreach ($detalleorden as $value) {
                                            echo "<tr>";
                                            ?> 
                                            <?php
                                            if ($value->salida == 1 && $value->tipo == 0) {
                                                echo "<td> <span class='glyphicon glyphicon-ok' style='color:green;'></span> " . $value->numeroparte . "</td>";
                                            } else {
                                                echo "<td>";
                                                ?> 
                                               <span class='glyphicon glyphicon-exclamation-sign' style=''></span>  <a href="#my_modal" class="subrayado" data-toggle="modal" data-book-id="<?php echo $value->idpalletcajas; ?>" ><?php echo $value->numeroparte; ?></a>

                                                <?php
                                                echo "</td>";
                                            }
                                            echo '<td>';
                                            echo '<label style="color:#8938f5;">Por pallet</label>';
                                            echo '</td>';
                                            echo "<td>1</td>";
                                            echo "<td>" .number_format($value->cajaspallet) . "</td>";
                                            echo "<td>" . $value->modelo . "</td>";
                                            echo "<td>" . $value->revision . "</td>";
                                            echo "<td>" . $value->nombreposicion . "</td>";
                                            echo "</tr>";
                                        }
                                    }

                                    if (isset($detalleordenparciales) && !empty($detalleordenparciales)) {
                                        foreach ($detalleordenparciales as $value) {
                                            echo "<tr>";
                                            echo "<td> <span class='glyphicon glyphicon-ok' style='color:green;'></span> " . $value->numeroparte . "</td>";
                                            echo '<td>';
                                            echo '<label style="color:#1abd53;">Parciales</label>';
                                            echo '</td>';
                                            echo "<td>1</td>";
                                            echo "<td>" .number_format($value->totalcajas) . "</td>";
                                            echo "<td>" . $value->modelo . "</td>";
                                            echo "<td>" . $value->revision . "</td>";
                                            echo "<td> --- </td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <?php
                        if (isset($detallepallet) && !empty($detallepallet)) {
                            ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 ">

                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style=" background-color: #d8d8d8">
                                                <h4 class="panel-title" >
                                                    <a data-toggle="collapse" href="#collapse1"><i class="fa fa-bars" aria-hidden="true"></i> Click para ver detalles de la Orden.</a>
                                                </h4>
                                            </div>
                                            <div id="collapse1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Número de parte</th>
                                                                <th>Modelo</th>
                                                                <th>Pallet</th>
                                                                <th>Cajas</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $totalpallet = 0;
                                                            $totalcajas = 0;
                                                            if (isset($detallepallet) && !empty($detallepallet)) {
                                                                foreach ($detallepallet as $value) {
                                                                    $totalpallet += $value->totalpallet;
                                                                    $totalcajas += $value->sumacajas;
                                                                    echo "<tr>";
                                                                    echo "<td><i class='fa fa-check'  style='color:#8938f5;' aria-hidden='true'></i> $value->numeroparte </td>";
                                                                    echo "<td>$value->modelo</td>";
                                                                    echo "<td>".number_format($value->totalpallet)."</td>";
                                                                    echo "<td>".number_format($value->sumacajas)."</td>";
                                                                    echo "</tr>";
                                                                }
                                                            }
                                                            if (isset($detalleparciales) && !empty($detalleparciales)) {
                                                                foreach ($detalleparciales as $value) {
                                                                    $totalpallet += 1;
                                                                    $totalcajas += $value->sumacajas;
                                                                    echo "<tr>";
                                                                    echo "<td><i class='fa fa-check'  style='color:#1abd53;' aria-hidden='true'></i> $value->numeroparte </td>";
                                                                    echo "<td>$value->modelo</td>";
                                                                    echo "<td>1</td>";
                                                                    echo "<td>".number_format($value->sumacajas)."</td>";
                                                                    echo "</tr>";
                                                                }
                                                            }

                                                            echo "<tr>";
                                                            echo "<td></td>";
                                                            echo "<td></td>";
                                                            echo "<td><strong>" . number_format($totalpallet) . "</strong></td>";
                                                            echo "<td><strong>" . number_format($totalcajas) . "</strong></td>";
                                                            echo "</tr>";
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php } ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript">
         function pasacampo(key_event) {
             var k;
             if (document.all) k = event.keyCode;
             else k = key_event.which;
             if (k == 13) document.getElementById('cantidadescaneado').focus();
         }
           
      </script>
<script type="text/javascript">

    $('#my_modal').on('shown.bs.modal', function () {
        $('#codigoescaneado').focus()
    });

    $('#my_modal').on('show.bs.modal', function (e) {
        var bookId = $(e.relatedTarget).data('book-id');
        $(e.currentTarget).find('input[name="bookId"]').val(bookId);
        $('#codigoescaneado').focus()
    });


</script>
<script type="text/javascript">
    $.fn.delayPasteKeyUp = function (fn, ms) {
        var timer = 0;
        $(this).on("propertychange input", function () {
            clearTimeout(timer);
            timer = setTimeout(fn, ms);
        });
    };
 
    $(document).ready(function () {
        $("#cantidadescaneado").delayPasteKeyUp(function () {

           var codigo = $("#codigoescaneado").val();
           var idsalida = $("#idsalida").val();
           var cantidad =$("#cantidadescaneado").val();
           var idpalletcajas =$("#bookId").val();
            console.log(codigo);
            $.ajax({
                type: "POST",
                url: "<?= base_url('orden/validar') ?>",
                data: "codigo=" + codigo + "&cantidad=" + cantidad + "&idsalida=" + idsalida+ "&idpalletcajas=" + idpalletcajas,
                dataType: "html",
                beforeSend: function () {
                    //imagen de carga
                    //$("#resultado").html("<p align='center'><img src='ajax-loader.gif' /></p>");
                },
                error: function () {
                    alert("error petición ajax");
                },
                success: function (data) {

                    //var getContact = JSON.parse(data);
                    //console.log(getContact.incorrecto); 
                    if (data == 1) {
                        $('#msgerror').hide();
                        $('#msgerror').text("");
                        $('#msgcorrecto').text("Exito... espere un momento");
                         location.reload();

                    } else {
                        $('#msgerror').text("Codigo no encontrado en la Orde.");
                    }
                },

            }, 200);
        
        
        });
    });


</script> 