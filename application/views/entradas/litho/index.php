<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><strong>Administrar Litho</strong></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">  
                                <div class="row">
                                 <div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <table class="table is-bordered is-hoverable" id="datatable2">
                                        <thead class="text-white bg-dark" >
                                            <th>Cliente/Proveedor</th>
                                            <th>Num. Parte</th>
                                            <th>Modelo</th> 
                                            <th>Revision</th>  
                                            <th>Existencia</th> 
                                            <th>Opción</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if (isset($data) && !empty($data)) {
                                                foreach ($data as $value) { ?>
                                                    <tr   class="table-default"> 
                                                        <td><strong><?php echo $value->nombre; ?></strong></td>
                                                        <td><?php echo $value->numeroparte ?></td>
                                                        <td><?php echo $value->modelo ?></td>
                                                        <td><?php echo $value->revision ?></td> 
                                                        <td><strong style="color:green;"><?php echo number_format ($value->totalexistencia) ?></strong></td>
                                                        <td>
                                                            <!-- Small button group -->
                                                            <div class="btn-group">
                                                              <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                                                Opción <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                              <li><a href="#" style="color:green;" class="edit_button" 
                                                                data-toggle="modal" data-target="#myModal"
                                                                data-idparte="<?php echo $value->idparte;?>"
                                                                data-numeroparte="<?php echo $value->numeroparte;?>" ><i class="fa fa-sign-in" aria-hidden="true"></i> <strong>Entrada</strong></a></li>
                                                                <li><a href="#" style="color:blue;" class="edit_button_salida" 
                                                                    data-toggle="modal" data-target="#myModalSalida"
                                                                    data-idparte="<?php echo $value->idparte;?>"
                                                                    data-numeroparte="<?php echo $value->numeroparte;?>"><i class="fa fa-sign-out" aria-hidden="true"></i> <strong>Salida</strong></a></li>
                                                                    <li><a href="#" style="color:red;" class="edit_button_devolucion" 
                                                                        data-toggle="modal" data-target="#myModalDevolucion"
                                                                        data-idparte="<?php echo $value->idparte;?>"
                                                                        data-numeroparte="<?php echo $value->numeroparte;?>"
                                                                        ><i class="fa fa-undo" aria-hidden="true"></i> <strong>Devolución</strong></a></li>
                                                                        <li class="divider"></li>
                                                                        <li><a href="<?php echo site_url('litho/detalle/'.$value->idparte) ?>"><i class="fa fa-exchange"></i> <strong>Movimientos</strong></a></li>
                                                                    </ul>
                                                                </div>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title " id="myModalLabel">Entrada a: <label class="titlenumeroparte"></label> </h3>
            </div>
            <form method="post" action="" id="frmentrada">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none"></div>
                    <div class="form-group">
                        <input class="form-control business_skill_id" type="hidden" name="idparte">
                    </div>
                    <div class="form-group">
                       <label ><font color="red">*</font> Cantidad</label><br>
                       <input type="text" name="cantidad"  class="form-control">
                   </div>
                   <div class="form-group">
                       <label >Comentarios</label><br>
                       <textarea  class="form-control" name="comentarios"></textarea>
                   </div>
                   <div class="form-group">
                       <label >Transferencia</label><br>
                       <textarea  class="form-control" name="transferencia"></textarea>
                   </div> 
               </div>
               <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnentrada" class="btn btn-primary">Aceptar</button>
            </div>
        </form>
    </div>
</div>
</div>

<div class="modal fade" id="myModalSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title " id="myModalLabel">Salida a: <label class="titlenumeroparte"></label> </h3>
            </div>
            <form method="post" action="" id="frmsalida">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none"></div>
                    <div class="form-group">
                        <input class="form-control business_skill_id" type="hidden" name="idparte">
                    </div>
                    <div class="form-group">
                       <label ><font color="red">*</font> Cantidad</label><br>
                       <input type="text" name="cantidad"  class="form-control">
                   </div>
                   <div class="form-group">
                       <label >Comentarios</label><br>
                       <textarea  class="form-control" name="comentarios"></textarea>
                   </div>
                   <div class="form-group">
                       <label >Transferencia</label><br>
                       <textarea  class="form-control" name="transferencia"></textarea>
                   </div>  
               </div>
               <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnsalida" class="btn btn-primary">Aceptar</button>
            </div>
        </form>
    </div>
</div>
</div>


<div class="modal fade" id="myModalDevolucion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title " id="myModalLabel">Devolución a: <label class="titlenumeroparte"></label> </h3>
            </div>
            <form method="post" action="" id="frmdevolucion">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none"></div>
                    <div class="form-group">
                        <input class="form-control business_skill_id" type="hidden" name="idparte">
                    </div>
                    <div class="form-group">
                       <label ><font color="red">*</font> Cantidad</label><br>
                       <input type="text" name="cantidad"  class="form-control">
                   </div>
                   <div class="form-group">
                       <label >Comentarios</label><br>
                       <textarea  class="form-control" name="comentarios"></textarea>
                   </div> 
                   <div class="form-group">
                       <label >Transferencia</label><br>
                       <textarea  class="form-control" name="transferencia"></textarea>
                   </div>  
               </div>
               <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btndevolucion" class="btn btn-primary">Aceptar</button>
            </div>
        </form>
    </div>
</div>
</div>



<script>
    $(document).on( "click", '.edit_button',function(e) { 
        var id = $(this).data('idparte'); 
        var numeroparte = $(this).data('numeroparte'); 

        $(".business_skill_id").val(id);  
        $(".titlenumeroparte").text(numeroparte);   
    });
    $(document).on( "click", '.edit_button_salida',function(e) { 
        var id = $(this).data('idparte'); 
        var numeroparte = $(this).data('numeroparte'); 

        $(".business_skill_id").val(id);  
        $(".titlenumeroparte").text(numeroparte);   
    });
    $(document).on( "click", '.edit_button_devolucion',function(e) { 
        var id = $(this).data('idparte'); 
        var numeroparte = $(this).data('numeroparte'); 

        $(".business_skill_id").val(id);  
        $(".titlenumeroparte").text(numeroparte);   
    });
</script>

<script> 
    $("#btnentrada").click(function(){ 
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('litho/agregar_entrada');?>",
            data: $('#frmentrada').serialize(),
            success: function(data) {
                var msg = $.parseJSON(data);
                console.log(msg);
                if((typeof msg.error === "undefined")){ 
                    $(".print-error-msg").css('display','none'); 
                    alert(msg.success) ? "" : location.reload(); 
                }else{ 
                    $(".print-error-msg").css('display','block'); 
                    $(".print-error-msg").html(msg.error);
                    setTimeout(function() {$('.print-error-msg').fadeOut('fast');}, 3000);
                }
                
            }
        });



    });

    $("#btnsalida").click(function(){ 
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('litho/agregar_salida');?>",
            data: $('#frmsalida').serialize(),
            success: function(data) {
                var msg = $.parseJSON(data);
                //console.log(msg);
                console.log(msg.error);
                if((typeof msg.error === "undefined")){ 
                    $(".print-error-msg").css('display','none'); 
                    alert(msg.success) ? "" : location.reload(); 
                }else{ 
                    $(".print-error-msg").css('display','block'); 
                    $(".print-error-msg").html(msg.error);
                    setTimeout(function() {$('.print-error-msg').fadeOut('fast');}, 3000);
                }
            }
        });

    }); 

    $("#btndevolucion").click(function(){ 
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('litho/devolucion');?>",
            data: $('#frmdevolucion').serialize(),
            success: function(data) {
                var msg = $.parseJSON(data);
                console.log(msg.error);
                if((typeof msg.error === "undefined")){ 
                    $(".print-error-msg").css('display','none'); 
                    alert(msg.success) ? "" : location.reload(); 
                }else{ 
                    $(".print-error-msg").css('display','block'); 
                    $(".print-error-msg").html(msg.error);
                    setTimeout(function() {$('.print-error-msg').fadeOut('fast');}, 3000);

                }
            }
        });
    }); 
</script>
