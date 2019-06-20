



<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-6" align="left">
                                <h2><strong>Agregar Número de Parte</strong></h2>
                            </div>
                            <div class="col-md-6" style="display: flex; justify-content: flex-end">
                                <h2><strong>Transferencia: # <?php echo $id; ?></strong></h2>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

                                        <div class="modal fade bd-example-modal-lg"   role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header"> 
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        Modal body..
                                                        <form>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Número de Parte</label>
                                                                        <input type="text" class="form-control"  id="numeroparte" autcomplete="off" autofocus=""> 
                                                                    </div> 
                                                                </div> 

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Seleccionar cliente</label> 
                                                                        <select  class="select2_single_cliente form-control " id="listclient">
                                                                            <option value="">Seleccionar</option>
                                                                           
                                                                        </select>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Seleccionar Modelo</label> 
                                                                        <select class="select2_single_modelo form-control " id="listamodelo">
                                                                            <option value="">Seleccionar</option>
                                                                           
                                                                        </select>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Seleccionar Revisión</label> 
                                                                        <select class="select2_single_revision form-control " id="listarevision">
                                                                            <option value="">Seleccionar</option>
                                                                       
                                                                        </select>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Seleccionar Linea</label> 
                                                                        <select class="select2_linea form-control ">
                                                                            <?php foreach ($datalinea as $row) { ?>
                                                                                <option value="<?php echo $row->idlinea ?>"><?php echo $row->nombrelinea ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Seleccionar Cajas por Pallet</label> 
                                                                        <select class="select2_single_cantidad form-control " id="listacantidad">
                                                                            <option value="">Seleccionar</option>

                                                                        </select>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Cantidad de Pallet</label> 
                                                                        <input type="text" class="form-control"  autcomplete="off">
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Cliente</th>
                                                <th scope="col">No. P.</th>
                                                <th scope="col">P.</th>
                                                <th scope="col">Cajas</th> 

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
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

      <script type="text/javascript">
         $.fn.delayPasteKeyUp = function(fn, ms) {
              var timer = 0;
              $(this).on("propertychange input", function() {
                  clearTimeout(timer);
                  timer = setTimeout(fn, ms);
              });
          };
          
          $(document).ready(function() {
              $("#numeroparte").delayPasteKeyUp(function() {
          
                 
                 var parte = $("#numeroparte").val();
                  $.ajax({
                      type: "POST",
                      url: "<?= base_url('transferencia/validar') ?>",
                      data: "numeroparte=" + parte,
                      dataType: "html",
                      beforeSend: function() {
                          //imagen de carga
                          //$("#resultado").html("<p align='center'><img src='ajax-loader.gif' /></p>");
                      },
                      error: function() {
                          alert("error petición ajax");
                      },
                      success: function(data) {
                        console.log(data);
                           $(".select2_single_cliente").prop("disabled", false); 
                            $("#listclient").append(data); 
                      
          
                      }
                  });

                   


              }, 200);
          });
          
      </script> 

      <script type="text/javascript">

$(document).ready(function () {

    $("#listclient").change(function () {
        var idparte = $("#listclient").find("option:selected").val();

        $.ajax({
            type: "POST",
             url: "<?= base_url('transferencia/seleccionarCliente') ?>",
            data: "idparte=" + idparte,
            dataType: "html",
            beforeSend: function () {
                //  $('#mensajeslo').show();
                //$('#mensajeslo').val("sss");
            },
            complete: function () {
                // $('#mensajeslo').hide();
            },
            success: function (response) {
                console.log(response); 
                //$('#listamunicipio').removeAttr('disabled');
                //$(".select2_municipio").empty();   
                //$(".select2_colonia").empty();   
                 $(".select2_single_modelo").prop("disabled", false); 
                $("#listamodelo").append(response); 
                //$('#listacolonia').attr('disabled', 'disabled');
            }
        });


    });
 
    $("#listamodelo").change(function () {
        var idmodelo = $("#listamodelo").find("option:selected").val();
        $.ajax({
            type: "POST",
           url: "<?= base_url('transferencia/seleccionarModelo') ?>",
            data: "idmodelo=" + idmodelo,
            dataType: "html",
            success: function (response) { 
                  $(".select2_single_revision").prop("disabled", false); 
                $("#listarevision").append(response); 

            }
        });

    });
      $("#listarevision").change(function () {
        var idrevision = $("#listarevision").find("option:selected").val();
        $.ajax({
            type: "POST",
           url: "<?= base_url('transferencia/seleccionarRevision') ?>",
            data: "idrevision=" + idrevision,
            dataType: "html",
            success: function (response) { 
                $(".select2_single_cantidad").prop("disabled", false); 
                $("#listacantidad").append(response); 

            }
        });

    });
 
});
      </script>
<!-- /page content -->
