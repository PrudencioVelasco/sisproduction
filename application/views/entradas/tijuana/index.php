<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3><strong>ADMINISTRAR TIJUANA</strong></h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">
                                <div class="row">
                                 <div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <table class="table is-bordered is-hoverable" id="datatablewarehouse">
                                        <thead class="text-white bg-dark" >
                                            <th>Num. Parte</th>
                                            <th>Modelo</th>
                                            <th>Revision</th>
                                            <th>Existencia</th>
                                            <th>Opción</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($data) && !empty($data)) {
                                              //  $total = 0;
                                                foreach ($data as $value) {
                                              //      $total=$total+$value->totalexistencia;?>
                                                    <tr   class="table-default">
                                                        <td><?php echo $value->numeroparte ?></td>
                                                        <td><?php echo $value->modelo ?></td>
                                                        <td><?php echo $value->revision ?></td>
                                                        <td><strong style="color:green;"><?php echo $value->totalexistencia ?></strong></td>
                                                        <td>
                                                          <?php
                                                          if(isset($this->session->idrol) && !empty($this->session->idrol)) {
                                                            if($this->session->idrol != 11){
                                                           ?>
                                                            <div class="btn-group">
                                                              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                                                Opción <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                              <li><a href="#" style="color:green;" class="edit_button"
                                                                data-toggle="modal" data-target="#myModal"
                                                                data-idrevision="<?php echo $value->idrevision;?>"
                                                                data-numeroparte="<?php echo $value->numeroparte;?>" ><i class="fa fa-sign-in" aria-hidden="true"></i> <strong>Entrada</strong></a></li>
                                                                <li><a href="#" style="color:blue;" class="edit_button_salida"
                                                                    data-toggle="modal" data-target="#myModalSalida"
                                                                    data-idrevision="<?php echo $value->idrevision;?>"
                                                                    data-numeroparte="<?php echo $value->numeroparte;?>"><i class="fa fa-sign-out" aria-hidden="true"></i> <strong>Salida</strong></a></li>
                                                                    <li><a href="#" style="color:red;" class="edit_button_devolucion"
                                                                        data-toggle="modal" data-target="#myModalDevolucion"
                                                                        data-idrevision="<?php echo $value->idrevision;?>"
                                                                        data-numeroparte="<?php echo $value->numeroparte;?>"
                                                                        ><i class="fa fa-undo" aria-hidden="true"></i> <strong>Devolución</strong></a></li>
                                                                        <li class="divider"></li>
                                                                        <li><a href="<?php echo site_url('Litho/detalle_tijuana/'.$value->idrevision) ?>"><i class="fa fa-exchange"></i> <strong>Movimientos</strong></a></li>
                                                                    </ul>
                                                                </div>
                                                                <?php
                                                                    }
                                                                  }
                                                                ?>
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
            <div class="modal-header modal-header-info-nomodal">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title " id="myModalLabel">ENTRADA A: <label class="titlenumeroparte"></label> </h3>
            </div>
            <form method="post" action="" id="frmentrada">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none"></div>
                    <div class="form-group">
                        <input class="form-control business_skill_id" type="hidden" name="idrevision">
                    </div>
                    <div class="form-group">
                       <label ><font color="red">*</font> Cantidad</label><br>
                       <input type="text" name="cantidad"  class="form-control">
                   </div>
                   <div class="form-group">
                       <label >Comentarios</label><br>
                       <textarea  class="form-control" name="comentarios"></textarea>
                   </div>
               </div>
               <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-ban'></i> Cerrar</button>
                <button type="button" id="btnentrada" class="btn btn-primary"><i class='fa fa-floppy-o'></i> Aceptar</button>
            </div>
        </form>
    </div>
</div>
</div>

<div class="modal fade" id="myModalSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-info-nomodal">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title " id="myModalLabel">SALIDA A: <label class="titlenumeroparte"></label> </h3>
            </div>
            <form method="post" action="" id="frmsalida">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none"></div>
                    <div class="form-group">
                        <input class="form-control business_skill_id" type="hidden" name="idrevision">
                    </div>
                    <div class="form-group">
                       <label ><font color="red">*</font> Cantidad</label><br>
                       <input type="text" name="cantidad"  class="form-control">
                   </div>
                   <div class="form-group">
                       <label >Comentarios</label><br>
                       <textarea  class="form-control" name="comentarios"></textarea>
                   </div>
               </div>
               <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-ban'></i> Cerrar</button>
                <button type="button" id="btnsalida" class="btn btn-primary"><i class='fa fa-floppy-o'></i> Aceptar</button>
            </div>
        </form>
    </div>
</div>
</div>


<div class="modal fade" id="myModalDevolucion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-info-nomodal">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title " id="myModalLabel">DEVOLUCIÓN A: <label class="titlenumeroparte"></label> </h3>
            </div>
            <form method="post" action="" id="frmdevolucion">
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none"></div>
                    <div class="form-group">
                        <input class="form-control business_skill_id" type="hidden" name="idrevision">
                    </div>
                    <div class="form-group">
                       <label ><font color="red">*</font> Cantidad</label><br>
                       <input type="text" name="cantidad"  class="form-control">
                   </div>
                   <div class="form-group">
                       <label >Comentarios</label><br>
                       <textarea  class="form-control" name="comentarios"></textarea>
                   </div>
               </div>
               <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-ban'></i> Cerrar</button>
                <button type="button" id="btndevolucion" class="btn btn-primary"><i class='fa fa-floppy-o'></i> Aceptar</button>
            </div>
        </form>
    </div>
</div>
</div>



<script>
    $(document).on( "click", '.edit_button',function(e) {
        var id = $(this).data('idrevision');
        var numeroparte = $(this).data('numeroparte');

        $(".business_skill_id").val(id);
        $(".titlenumeroparte").text(numeroparte);
    });
    $(document).on( "click", '.edit_button_salida',function(e) {
        var id = $(this).data('idrevision');
        var numeroparte = $(this).data('numeroparte');

        $(".business_skill_id").val(id);
        $(".titlenumeroparte").text(numeroparte);
    });
    $(document).on( "click", '.edit_button_devolucion',function(e) {
        var id = $(this).data('idrevision');
        var numeroparte = $(this).data('numeroparte');

        $(".business_skill_id").val(id);
        $(".titlenumeroparte").text(numeroparte);
    });
</script>

<script>
    $("#btnentrada").click(function(){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Litho/agregar_entrada_tijuana');?>",
            data: $('#frmentrada').serialize(),
            success: function(data) {
                var msg = $.parseJSON(data);
                console.log(msg);
                if((typeof msg.error === "undefined")){
                    $(".print-error-msg").css('display','none');
                    swal("Operación con Exito.", "Click en el boton!", "success").then(function(){
                        location.reload();
                      });
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
            url: "<?php echo site_url('Litho/agregar_salida_tijuana');?>",
            data: $('#frmsalida').serialize(),
            success: function(data) {
                var msg = $.parseJSON(data);
                //console.log(msg);
                console.log(msg.error);
                if((typeof msg.error === "undefined")){
                    $(".print-error-msg").css('display','none');
                    swal("Operación con Exito.", "Click en el boton!", "success").then(function(){
                        location.reload();
                      });
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
            url: "<?php echo site_url('Litho/devolucion_tijuana');?>",
            data: $('#frmdevolucion').serialize(),
            success: function(data) {
                var msg = $.parseJSON(data);
                console.log(msg.error);
                if((typeof msg.error === "undefined")){
                    $(".print-error-msg").css('display','none');
                    swal("Operación con Exito.", "Click en el boton!", "success").then(function(){
                        location.reload();
                      });
                }else{
                    $(".print-error-msg").css('display','block');
                    $(".print-error-msg").html(msg.error);
                    setTimeout(function() {$('.print-error-msg').fadeOut('fast');}, 3000);

                }
            }
        });
    });
</script>

<script type="text/javascript">
  $( document ).ready(function() {
    $('#datatablewarehouse').DataTable( {
        dom: 'Bfrtip',
       buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            }
        ],
        "order": [[0, "desc"]],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    } );

    $('#datatablewarehouseposicion').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            }
        ],
        "order": [[0, "desc"]],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    } );
});
</script>
