<div class="right_col" role="main">
  <?php 
  $sumparcial = 0;
  $sumpallet = 0;
  $total =0;
  ?>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="row">  
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h3>Entradas</h3>
            </div> 
          </div>

          <div class="clearfix"></div>
        </div>

        <div class="x_content">  
         <div class="container">
          <div class="row">
            <div class="col-md-12">
              <table id="datatablerecord" class="table">
                <thead>
                  <tr> 
                    <th scope="col">Trans.</th> 
                     <th scope="col">Ubicación</th> 
                    <th scope="col">No. Parte</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Revisión</th>
                    <th scope="col">T. Cajas</th> 
                    <th scope="col">Fecha</th> 
                    <th></th>  
                  </tr>
                </thead>
                <tbody>
                  <!--Entradas-->
                  <?php if (isset($entradas) && !empty($entradas)):?>
                  <?php foreach ($entradas as $value):?>
                    <tr> 
                       <td><?php echo $value->folio; ?></td>
                      <td><?php echo $value->nombreposicion; ?></td>
                      <td><?php echo $value->numeroparte; ?></td>
                      <td><?php echo $value->nombremodelo; ?></td>
                      <td><?php echo $value->descripcion; ?></td>
                      <td><strong><?php echo number_format($value->cantidad); ?></strong></td>
                      
                      <td><?php echo date("d/m/Y", strtotime($value->fecharegistro));?></td>  
                      <td align="right">
                         <a  href="javascript:void(0)"  class="edit_button btn btn-primary btn-sm"
                      data-toggle="modal" data-target="#largeModalEdit"
                      data-idparteposicionbodega="<?php echo $value->idparteposicionbodega;?>"
                      data-nombreposicion="<?php echo $value->nombreposicion;?>" >
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    Modificar</a>
                      </td>
                    </tr>
                  <?php endforeach;?>
                <?php endif;?>  

          </tbody>
        </table> 

          <div class="modal fade" id="largeModalEdit" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">CAMBIAR UBICACIÓN:  <label id="nombreposicion"></label> </h4>
                         </div>
                         <form id="frmubicar" >
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <div class="alert alert-success print-success-msg" style="display:none"></div>
                               <div class="alert alert-danger print-error-msg" style="display:none"></div>
                             </div>
                          </div> 
                            <div class="row">
                               <div class="col-md-12 col-sm-12 col-xs-12 ">
                                  <div class="form-group">
                                      <label><font color="red">*</font> Ubicación</label>
                                         <select class="form-control" name="idposicion">
                                           <option value="">---Seleccionar---</option>
                                           <?php
                                            if (isset($ubicaciones) && !empty($ubicaciones)) {
                                                foreach ($ubicaciones as $value) { ?>
                                            <option value="<?php echo $value->idposicion; ?>"><?php echo $value->nombreposicion ?></option>
                                           <?php
                                                }
                                            }
                                           ?>
                                         </select>
                                    </div>
                                </div> 
                            </div>


                        </div>
                        <div class="modal-footer">
                          <input type="hidden" name="id" id="id">  

                            <button type="button" id="btnmodificar" class="btn btn-primary waves-effect"><i class='fa fa-edit'></i> MODIFICAR</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class='fa fa-close'></i> CERRAR</button>
                        </div>
                      </form>
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
<script type="text/javascript">
  $( document ).ready(function() {

       $(document).on( "click", '.edit_button',function(e) { 
        var id = $(this).data('idparteposicionbodega'); 
        var nombreposicion = $(this).data('nombreposicion'); 

        $("#id").val(id);  
        $("#nombreposicion").text(nombreposicion);     
      });
    
    $("#btnmodificar").click(function(){ 
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('Bodegap/updateUbicacion');?>",
      data: $('#frmubicar').serialize(),
      success: function(data) {
        var val = $.parseJSON(data); 
         if((val.success === "Ok")){ 
          $(".print-success-msg").css('display','block'); 
          $(".print-success-msg").html("Fue modificado la Ubicación con Exito. Espere...");
          setTimeout(function() {
            $('.print-error-msg').fadeOut('fast');
            location.reload(); 
          }, 3000);

          //$(".print-error-msg").css('display','none'); 
          //location.reload(); 
        }else{ 
          $(".print-error-msg").css('display','block'); 
          $(".print-error-msg").html(val.error);
          setTimeout(function() {$('.print-error-msg').fadeOut('fast');}, 6000);
        }
 
      }
    })
  });

    $('#datatablerecord').DataTable( {
      dom: 'Bfrtip',
      buttons: [
      'excelHtml5',
      'pdfHtml5'
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