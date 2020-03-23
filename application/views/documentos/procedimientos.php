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
                        <h3><strong>ADMINISTRAR PROCEDIMIENTOS</strong></h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                          <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <button type="button" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-primary "><i class='fa fa-plus'></i> SUBIR PROCEDIMIENTO</button>
                          </div>
                      </div>

                      <ul class="nav nav-tabs bar_tabs" role="tablist">
        <li role="presentation" class="active"><a href="#example4-tab1" aria-controls="example4-tab1" role="tab" data-toggle="tab"><strong>Archivo Procedimientos</strong></a></li>
        <li role="presentation"><a href="#example4-tab2" aria-controls="example4-tab2" role="tab" data-toggle="tab"><strong>Archivos Formatos</strong></a></li>
         <li role="presentation"><a href="#example4-tab3" aria-controls="example4-tab3" role="tab" data-toggle="tab"><strong>Archivos Instructivos</strong></a></li>
          <li role="presentation"><a href="#example4-tab4" aria-controls="example4-tab4" role="tab" data-toggle="tab"><strong>Otros Documentos</strong></a></li>
    </ul>


    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="example4-tab1">
            <table id="example4-tab1-dt" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                <thead   >
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Revisión</th>
                                    <th>Área</th>
                                    <th>Documento</th>
                                    <th>Opciones</th>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($data) && !empty($data)) {
                                        foreach ($data as $value) {
                                          if($value->idtipodocumento == 3){
                                          ?>
                                            <tr   class="table-default">
                                                <td><?php echo $value->nombredocumento ?></td>
                                                <td><?php echo $value->codigo ?></td>
                                                <td><?php echo $value->revision ?></td>
                                                <td><?php echo $value->nombrearea ?></td>

                                                <td style="white-space:nowrap;">
                                                        <a target="_blank" class="btn btn-icons btn-rounded btn-round  btn-xs btn-info" href="<?php echo base_url(); ?>specs_procedimientos/<?php echo utf8_encode($value->nombre);?>"><?php echo str_replace('_',' ', $value->nombre) ?></a>

                                                </td>
                                                <td>

                                                        <?php
                                                  if(isset($this->session->rol) && !empty($this->session->rol)) {
                                                    if($this->session->rol == "Administrador"){
                                                   ?>
                                                        <a href="javascript:void(0)" class="btn btn-icons btn-rounded btn-round  btn-sm btn-danger btn_delete"
                                                        data-toggle="modal" data-target="#myModalEliminar"
                                                        data-iddoc="<?php echo $value->idspecsprocedimiento;?>">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>

                                                          <?php
                                                         }
                                                       }
                                                       ?>

                                                </td>
                                            </tr>
                                            <?php
                                          }
                                        }
                                    }
                                    ?>
                                </tbody>
            </table>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="example4-tab2">
            <table id="example4-tab2-dt" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                 <thead   >
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Revisión</th>
                                    <th>Área</th>
                                    <th>Documento</th>
                                    <th>Opciones</th>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($data) && !empty($data)) {
                                        foreach ($data as $value) {
                                          if($value->idtipodocumento == 4){
                                          ?>
                                            <tr   class="table-default">
                                                <td><?php echo $value->nombredocumento ?></td>
                                                <td><?php echo $value->codigo ?></td>
                                                <td><?php echo $value->revision ?></td>
                                                <td><?php echo $value->nombrearea ?></td>

                                                <td style="white-space:nowrap;">
                                                        <a target="_blank" class="btn btn-icons btn-rounded btn-round  btn-xs btn-info" href="<?php echo base_url(); ?>specs_procedimientos/<?php echo utf8_encode($value->nombre);?>"><?php echo str_replace('_',' ', $value->nombre) ?></a>

                                                </td>
                                                <td>

                                                        <?php
                                                  if(isset($this->session->rol) && !empty($this->session->rol)) {
                                                    if($this->session->rol == "Administrador"){
                                                   ?>
                                                        <a href="javascript:void(0)" class="btn btn-icons btn-rounded btn-round  btn-sm btn-danger btn_delete"
                                                        data-toggle="modal" data-target="#myModalEliminar"
                                                        data-iddoc="<?php echo $value->idspecsprocedimiento;?>">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>

                                                          <?php
                                                         }
                                                       }
                                                       ?>

                                                </td>
                                            </tr>
                                            <?php
                                          }
                                        }
                                    }
                                    ?>
                                </tbody>
            </table>
        </div>
                <div role="tabpanel" class="tab-pane fade" id="example4-tab3">
            <table id="example4-tab3-dt" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                 <thead   >
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Revisión</th>
                                    <th>Área</th>
                                    <th>Documento</th>
                                    <th>Opciones</th>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($data) && !empty($data)) {
                                        foreach ($data as $value) {
                                          if($value->idtipodocumento == 5){
                                          ?>
                                            <tr   class="table-default">
                                                <td><?php echo $value->nombredocumento ?></td>
                                                <td><?php echo $value->codigo ?></td>
                                                <td><?php echo $value->revision ?></td>
                                                <td><?php echo $value->nombrearea ?></td>

                                                <td style="white-space:nowrap;">
                                                        <a target="_blank" class="btn btn-icons btn-rounded btn-round  btn-xs btn-info" href="<?php echo base_url(); ?>specs_procedimientos/<?php echo utf8_encode($value->nombre);?>"><?php echo str_replace('_',' ', $value->nombre) ?></a>

                                                </td>
                                                <td>
    <?php
                                                  if(isset($this->session->rol) && !empty($this->session->rol)) {
                                                    if($this->session->rol == "Administrador"){
                                                   ?>
                                                        <a href="javascript:void(0)" class="btn btn-icons btn-rounded btn-round  btn-sm btn-danger btn_delete"
                                                        data-toggle="modal" data-target="#myModalEliminar"
                                                        data-iddoc="<?php echo $value->idspecsprocedimiento;?>">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>

                                                          <?php
                                                         }
                                                       }
                                                       ?>

                                                </td>
                                            </tr>
                                            <?php
                                          }
                                        }
                                    }
                                    ?>
                                </tbody>
            </table>
        </div>

                <div role="tabpanel" class="tab-pane fade" id="example4-tab4">
            <table id="example4-tab4-dt" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                 <thead   >
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Revisión</th>
                                    <th>Área</th>
                                    <th>Documento</th>
                                    <th>Opciones</th>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($data) && !empty($data)) {
                                        foreach ($data as $value) {
                                          if($value->idtipodocumento == 2){
                                          ?>
                                            <tr   class="table-default">
                                                <td><?php echo $value->nombredocumento ?></td>
                                                <td><?php echo $value->codigo ?></td>
                                                <td><?php echo $value->revision ?></td>
                                                <td><?php echo $value->nombrearea ?></td>

                                                <td style="white-space:nowrap;">
                                                        <a target="_blank" class="btn btn-icons btn-rounded btn-round  btn-xs btn-info" href="<?php echo base_url(); ?>specs_procedimientos/<?php echo utf8_encode($value->nombre);?>"><?php echo str_replace('_',' ', $value->nombre) ?></a>

                                                </td>
                                                <td>
                                                   <?php
                                                  if(isset($this->session->rol) && !empty($this->session->rol)) {
                                                    if($this->session->rol == "Administrador"){
                                                   ?>
                                                        <a href="javascript:void(0)" class="btn btn-icons btn-rounded btn-round  btn-sm btn-danger btn_delete"
                                                        data-toggle="modal" data-target="#myModalEliminar"
                                                        data-iddoc="<?php echo $value->idspecsprocedimiento;?>">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>

                                                          <?php
                                                         }
                                                       }
                                                       ?>

                                                </td>
                                            </tr>
                                            <?php
                                          }
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
<!-- /page content -->







             <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-info-nomodal">
        <h3 class="modal-title w-100 font-weight-bold">SUBIR SPECS</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form id="frmsubir" enctype="multipart/form-data">
      <div class="modal-body mx-3">
    <div class="alert alert-danger print-error-msg" style="display:none"></div>

  <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 ">
            <div class="form-group">
          <label ><font color="red">*</font> Nombre Documento</label>
            <input type="text" class="form-control" name="titulodocumento" placeholder="Nombre Documento" id="titulodocumento" >
        </div>
         </div>
      </div>

  <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12 ">
            <div class="form-group">
          <label ><font color="red">*</font> Código</label>
            <input type="text" name="codigo" id="codigo" placeholder="Código" class="form-control">
        </div>
         </div>
          <div class="col-md-6 col-sm-12 col-xs-12 ">
            <div class="form-group">
          <label ><font color="red">*</font> Revisión</label>
          <input type="text" name="revision" id="revision" placeholder="Revisión" class="form-control">
         </div>
        </div>
      </div>



         <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12 ">
            <div class="form-group">
          <label ><font color="red">*</font> Tipo Documento</label>
            <select class="form-control" name="tipodocumento" id="tipodocumento" >
              <option value="">Seleccione</option>
              <?php
                  if (isset($tiposdocumento) && !empty($tiposdocumento)) {
                      foreach ($tiposdocumento as  $value) {
                        ?>
                        <option value="<?php echo $value->idtipodocumento; ?>"><?php echo $value->nombretipo; ?></option>
                        <?php

                      }
                  }
              ?>
          </select>
        </div>
         </div>
          <div class="col-md-6 col-sm-12 col-xs-12 ">
            <div class="form-group">
          <label ><font color="red">*</font> Area</label>
          <select class="form-control" name="area" id="area" >
              <option value="">Seleccione</option>
               <?php
                  if (isset($areas) && !empty($areas)) {
                      foreach ($areas as  $value) {
                        ?>
                        <option value="<?php echo $value->idarea; ?>"><?php echo $value->nombrearea; ?></option>
                        <?php

                      }
                  }
              ?>
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
          <button type="button" class="btn btn-danger" id="btncancelar" ><i class='fa fa-ban'></i> Cancelar</button>
       <button type="button" class="btn btn-primary" id="btnsubir" ><i class="fa fa-cloud-upload" aria-hidden="true"></i>  Subir</button>
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
</script>

<script>
    $("#btnsubir").click(function(){

        var codigo = $("#codigo").val();
        var revision = $("#revision").val();
        var tipodocumento = $("#tipodocumento").val();
        var area = $("#area").val();
        var titulodocumento = $("#titulodocumento").val();
        if(revision != "" && codigo != "" && tipodocumento != "" && area != "" && titulodocumento != ""){
        var form_data = new FormData();
        form_data.append('archivo', $('#archivo').prop('files')[0]);
        form_data.append('revision', revision);
        form_data.append('codigo', codigo);
        form_data.append('tipodocumento', tipodocumento);
        form_data.append('area', area);
        form_data.append('titulodocumento', titulodocumento);

        $.ajax({
            type: "POST",
            dataType : "json",
            url: "<?php echo site_url('documentos/subir_procedimientos');?>",
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


    $(document).on( "click", '.btn_delete',function(e) {
        var iddoc = $(this).data('iddoc');
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
              url: "<?php echo site_url('documentos/eliminar_documento_procedimiento');?>",
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
        $(document).ready(function(){
   $('#example4-tab1-dt, #example4-tab2-dt, #example4-tab3-dt, #example4-tab4-dt').DataTable({
      scrollX: true,
      fixedColumns: {
         leftColumns: 1
      },
        dom: 'Bfrtip',
        buttons: [],
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
   });

   $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust()
         .fixedColumns().relayout();
   });
});

 </script>
