<!-- page content -->
 <style type="text/css">
@keyframes blink {  
  0% { color: blue; }
  100% { color: white; }
}
@-webkit-keyframes blink {
  0% { color: blue; }
  100% { color: white; }
}
.blink {
  -webkit-animation: blink 1s linear infinite;
  -moz-animation: blink 1s linear infinite;
  animation: blink 1s linear infinite;
}</style>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><strong>Administrar SPECS</strong></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                          <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12"> 
                                <button type="button" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-primary "><i class='fa fa-plus'></i> SUBIR SPECS</button> 
                          </div>
                      </div>
                      
                      <div class="container">  
                        <div class="row">
                         <div class="col-md-12 col-sm-12 col-xs-12 ">


                            <table class="table is-bordered is-hoverable" id="datatabledocumentos">
                                <thead class="text-white bg-dark" >
                                    <th>Num. Parte</th>
                                    <th>Modelo</th> 
                                    <th>Revisión</th>
                                    <th>Documento</th>   
                                    <th>Opciones</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (isset($data) && !empty($data)) {
                                        foreach ($data as $value) { ?>
                                            <tr   class="table-default"> 
                                                <td><?php echo $value->numeroparte ?></td>
                                                <td><?php echo $value->modelo ?></td>
                                                <td><?php echo $value->revision ?></td> 
                                                
                                                <td style="white-space:nowrap;"> 
                                                       <!--<a target="_blank" class="btn btn-icons btn-rounded btn-round  btn-xs btn-default" href="<?php //echo site_url('documentos/downloadDocument/' . $value->iddoc) ?>"><i class="fa fa-eye" aria-hidden="true"></i> Ver documento</a>-->

                                                        <a target="_blank" class="btn btn-icons btn-rounded btn-round  btn-xs btn-info" href="<?php echo base_url(); ?>specs/<?php echo $value->nombredocumento;?>"><?php echo str_replace('_',' ', $value->nombredocumento) ?></a>

                                                </td>
                                                <td>
                                                        <!--<a href="javascript:void(0)" class="btn btn-icons btn-rounded btn-round  btn-primary btn-xs btn_edit" 
                                                        data-toggle="modal" data-target="#myModalEditar"
                                                        data-iddoc="<?php //echo $value->iddoc;?>"
                                                        data-numeroparte="<?php //echo $value->numeroparte;?>">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>-->

                                                        <a href="javascript:void(0)" class="btn btn-icons btn-rounded btn-round  btn-sm btn-danger btn_delete" 
                                                        data-toggle="modal" data-target="#myModalEliminar"
                                                        data-iddoc="<?php echo $value->iddoc;?>">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
                                                    
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

 

<div class="modal fade" id="myModalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title " id="myModalLabel">Editar información</h3>
            </div>
            <form id="frmeditar" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                    <input class="form-control iddoc_edit" type="hidden" id="iddoc_edit" name="iddoc">
                    <input class="form-control numeroparte_edit" type="hidden" id="numeroparte_edit" name="numeroparte">
                </div>
                <div class="form-group">
                   <label><font color="red">*</font> Selecciona el archivo:</label><br>
                   <input class="form-control" type="file" id="archivo_edit" name="archivo" required="" >
               </div>
               <div id="load_edit" style="display: none; text-align: center;">
                <div>
                    <img src="<?php echo base_url('/assets/images/loading.gif'); ?>" width="80">
                    <p><strong>Actualizando por favor espere...</strong></p>
                </div>
            </div>  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" id="btnedit" class="btn btn-primary">Aceptar</button>
        </div>
    </form>
</div>
</div>
</div>




             <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title w-100 font-weight-bold">Subir SPECS</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form id="frmsubir" enctype="multipart/form-data">
      <div class="modal-body mx-3">




          <div class="alert alert-danger print-error-msg" style="display:none"></div> 
         <div class="md-form mb-4">
          <label ><font color="red">*</font>  Número de parte</label><br>
          <select class="js-example-basic-lamina " style="width: 100%" name="idlamina">
            <option value=""></option> 
            <?php
                foreach ($partes as  $value) {
                    # code...
                    echo '<option value="'.$value->idparte.'">'.$value->numeroparte.'</option>';
                }
            ?>
         
        </select>
        </div> 
 <br/>
  <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12 ">
            <div class="form-group">
          <label ><font color="red">*</font> Modelo</label>
            <select class="form-control" name="modelo" id="modelo" >
              <option value="">Seleccione Modelo</option>
          </select>
        </div>
         </div>
          <div class="col-md-6 col-sm-12 col-xs-12 ">
            <div class="form-group">
          <label ><font color="red">*</font> Revisión</label>
          <select class="form-control" name="revision" id="revision" >
              <option value="">Seleccione Revisión</option>
          </select>
         </div>
        </div>





      </div>

      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 ">
           <div class="form-group">
                       <label><font color="red">*</font> Selecciona el archivo:</label><br>
                       <input class="form-control" type="file" id="archivo" name="archivo" required="">
                   </div>




         <div id="load" style="display: none; text-align: center;">
                    <div>
                        <img src="<?php echo base_url('/assets/images/loading.gif'); ?>" width="80">
                        <p><strong>Subiendo por favor espere...</strong></p>
                    </div>
                </div>



               </div>

      </div>


       

      </div>
      <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-danger" id="btncancelar" >Cancelar</button>
       <button type="button" class="btn btn-primary" id="btnsubir" >Subir</button>
      </div>
  </form>
    </div>
  </div>
</div>



<script>
 $(document).on( "click", '#btncancelar',function(e) { 
   
   //alert("Cancelar");
   location.reload();
});
  $(document).on( "click", '.btn_subir',function(e) { 
    var numeroparte = $(this).data('numeroparte');
    var idrevision = $(this).data('idrevision');  

    $(".numeroparte").val(numeroparte);
    $(".idrevision").val(idrevision);    
});

  $(document).on( "click", '.btn_edit',function(e) { 
    var id = $(this).data('iddoc');
    var numeroparte = $(this).data('numeroparte');  

    $(".iddoc_edit").val(id);
    $(".numeroparte_edit").val(numeroparte);     
});
</script>

<script> 
    $("#btnsubir").click(function(){

        var numeroparte = $("#numeroparte").val();
        var idrevision = $("#revision").val();
        if(idrevision != ""){
        var form_data = new FormData();
        form_data.append('archivo', $('#archivo').prop('files')[0]);               
        form_data.append('revision', idrevision);
        form_data.append('numeroparte', numeroparte);

        $.ajax({
            type: "POST",
            dataType : "json",
            url: "<?php echo site_url('documentos/subir_documento');?>",
            cache:false,
            contentType:false,
            processData:false,
            data: form_data,
            beforeSend: function(){
                $("#load").show();
            },
            success: function(data) {
                //console.log(data);
                if (data.status == 'true') {
                    $("#load").hide();
                    $('#myModalSubir').modal('hide');
                    Swal.fire({
                        title: 'Exito',
                        text: "Archivo subido exitosamente.",
                        type: 'info',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                      if (result.value) {
                        location.reload();
                    }
                })
                }else if(data.status == 'incorrect'){
                    $("#load").hide();
                    Swal.fire({
                        title:'Archivo',
                        html:'Seleccione un <b>Archivo</b> en formato <b>PDF</b>',
                        type:'info',
                        confirmButtonText: 'Aceptar'
                    })
                }else if(data.status == 'vacio'){
                    $("#load").hide();
                    Swal.fire({
                        title:'Archivo',
                        html:'Seleccione un <b>Archivo</b>.',
                        type:'info',
                        confirmButtonText: 'Aceptar'
                    })  
                }else{
                    $("#load").hide();
                    $('#myModalSubir').modal('hide');
                    Swal.fire({
                        title: 'Archivo',
                        text: "Hubo un error al subir el archivo",
                        type: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                      if (result.value) {
                        location.reload();
                    }
                })
                }
            },
            complete:function(data){
            }
        });
    }else{
          $("#load").hide();
                    Swal.fire({
                        title:'Archivo',
                        html:'Todos los campos son  <b>Obligatorios</b>.',
                        type:'info',
                        confirmButtonText: 'Aceptar'
                    })
    }
    });

    $("#btnedit").click(function(){

        var id = $("#iddoc_edit").val();
        var numeroparte = $("#numeroparte_edit").val();
        
        var form_data = new FormData();
        form_data.append('archivo', $('#archivo_edit').prop('files')[0]);               
        form_data.append('iddoc', id);
        form_data.append('numeroparte', numeroparte);

        $.ajax({
            type: "POST",
            dataType : "json",
            url: "<?php echo site_url('documentos/actualizar_documento');?>",
            cache:false,
            contentType:false,
            processData:false,
            data: form_data,
            beforeSend: function(){
                $("#load_edit").show();
            },
            success: function(data) {
                //console.log(data);
                if (data.status == 'true') {
                   $("#load-edit").hide();
                   $('#myModalEditar').modal('hide');
                   Swal.fire({
                    title: 'Exito',
                    text: "Archivo subido exitosamente.",
                    type: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                  if (result.value) {
                    location.reload();
                }
            })
            }else if(data.status == 'incorrect'){
                $("#load-edit").hide();
                Swal.fire({
                    title:'Archivo',
                    html:'Seleccione un <b>Archivo</b> en formato <b>PDF</b>',
                    type:'info',
                    confirmButtonText: 'Aceptar'
                })
            }else if(data.status == 'vacio'){
               $("#load-edit").hide();
               Swal.fire({
                title:'Archivo',
                html:'Seleccione un <b>Archivo</b>.',
                type:'info',
                confirmButtonText: 'Aceptar'
            })  
           }else{
               $("#load-edit").hide();
               $('#myModalEditar').modal('hide');
               Swal.fire({
                title: 'Actualización',
                text: "Hubo un error al actualizar la información",
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.value) {
                location.reload();
            }
        })
        }                
    },
    complete:function(data){
        console.log(data);
    }
});
    });

    $(document).on( "click", '.btn_delete',function(e) {
        var iddoc = $(this).data('iddoc');
//console.log(iddoc);
        var dataString = 'iddoc='+ iddoc;

        Swal.fire({
          title: '¿Eliminar elemento?',
          text: "Realmente desea eliminar el elemento seleccionado",
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Eliminar',
          cancelButtonText: 'Cancelar'
      }).then((result) => {
          if (result.value) {
            $.ajax({
              type: "POST",
              dataType : "json",
              url: "<?php echo site_url('documentos/eliminar_documento');?>",
              data: dataString,
              success: function(data) {
                 if(data.status == 'true'){
                     Swal.fire({
                        title: 'Eliminación',
                        text: "Información eliminada exitosamente.",
                        type: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                      if (result.value) {
                        location.reload();
                    }
                })
                }else{
                  if(data.status == 'false'){
                     Swal.fire({
                        title: 'Error',
                        text: "Hubo un error al eliminar el archivo, intente más tarde.",
                        type: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                      if (result.value) {
                        location.reload();
                    }
                })
                }
            }
        }
    });
        }
    })

  });

</script>

<script type="text/javascript">
  $( document ).ready(function() {
    $('#datatabledocumentos').DataTable( {
        dom: 'Bfrtip',
        buttons: [],
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

<script >
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {

                   
              $("#modelo").prop("disabled", 'disabled');
            $("#revision").prop("disabled", 'disabled');
            //$("#revision").prop("disabled", false);
    
     $('.js-example-basic-lamina').select2({
    placeholder: "Seleccionar el Número de Parte",
    allowClear: true,
    dropdownParent: $("#modalLoginForm")
});

 $('.js-example-basic-lamina').on("select2:select", function(e) { 
   // what you would like to happen
   var idparte = $('.js-example-basic-lamina').val();
   //alert(idparte);

    $.ajax({
                type: "POST",
                url: "<?php echo site_url('documentos/allModelo');?>",
                data: "idparte=" + idparte,
                success: function(data) {
                    console.log(data);
                    $('option','#modelo').remove().end().append('<option value="">Seleccionar Modelo</option>');
                    $('option','#revision').remove().end().append('<option value="">Seleccionar Revisión</option>');
                    $('#modelo').append(data);
                    $("#modelo").prop("disabled", false);
                    $("#revision").prop("disabled", 'disabled');
                    //var msg = $.parseJSON(data);
                    //console.log(msg.error);
                     
                }
            })

});


        $("#modelo").change(function () {
            var idmodelo = $("#modelo").find("option:selected").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('documentos/allRevision') ?>",
                data: "idmodelo=" + idmodelo,
                dataType: "html",
                success: function (data) {
                    $('#revision').append(data);
                    $('#revision').prop("disabled", false);
                    //$(".select2_single_revision").prop("disabled", false);
                    //$("#listarevision").append(response);

                }
            });

        });


});

</script>
