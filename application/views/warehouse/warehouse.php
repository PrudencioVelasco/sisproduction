 <div class="right_col" role="main">
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">  
                          <div class="col-md-11 col-sm-12 col-xs-12">
                            <h3>Administrar Almacen</h3>
                        </div>
                        <div class="col-md-1 col-sm-12 col-xs-12">
                            <a href="<?php echo base_url('warehouse/index')?>" class="btn btn-success"><i class="fa fa-home" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="app">
                        <div class="container">
                            <div class="bs-example">
                             <ul class="nav nav-tabs nav-pills">
                                <li class="active" style="">
                                    <a data-toggle="tab" href="#sectionA">Listado General</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#sectionB">Listado por Ubicación</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div id="sectionA" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_content">
                                                <div id="app">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table id="datatablewarehouse" class="table" width="100%" cellspacing="0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Cliente</th>
                                                                            <th scope="col">No. Parte</th>
                                                                            <th scope="col">Categoría</th>
                                                                            <th scope="col">Modelo</th>
                                                                            <th scope="col">Revisión</th>
                                                                            <th scope="col">Entradas</th> 
                                                                            <th scope="col">Salidas</th> 
                                                                            <th scope="col">Existencias</th> 

                                                                            <th class="text-center">Acción</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php if (isset($informacion) && !empty($informacion)):?>
                                                                        <?php foreach ($informacion as $value):?>
                                                                            <tr>
                                                                                <td><?php echo $value->nombre; ?></td>
                                                                                <td><?php echo $value->numeroparte; ?></td>
                                                                                <td><?php echo $value->nombrecategoria; ?></td>
                                                                                <td><?php echo $value->nombremodelo; ?></td>
                                                                                <td><?php echo $value->nombrerevision; ?></td>
                                                                                <td>
                                                                                    <label style="color:blue;"><?php echo $value->totalsalidaparciales + $value->totalsalidapallet + $value->total;?></label>
                                                                                </td>
                                                                                <td>
                                                                                    <label style="color:red;"><?php echo $value->totalsalidaparciales + $value->totalsalidapallet;?></label>
                                                                                </td>
                                                                                <td>
                                                                                    <label style="color:green;"><?php echo $value->total;?></label>                                                        
                                                                                </td>

                                                                                <td align="center">
                                                                                  <a class="btn btn-icons btn-rounded  btn-round btn-success btn-xs"  href="<?php echo site_url('warehouse/historial/'.$value->idrevision) ?>"><i class="fa fa-align-justify" aria-hidden="true"></i>
                                                                                    Historial</a>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach;?>
                                                                    <?php endif;?> 
                                                                          <?php
                                                                          
                                                                          if(isset($laminas) && !empty($laminas)){
                                                                              foreach ($laminas as $valuel){ 
                                                                                  if($valuel->totalexistencia > 0){
                                                                                  ?>
                                                                                         <tr>
                                                                                <td>--</td>
                                                                                <td><?php echo $valuel->numeroparte; ?></td>
                                                                                <td>LAMINAS</td>
                                                                                <td><?php echo $valuel->modelo; ?></td>
                                                                                <td><?php echo $valuel->revision; ?></td>
                                                                                <td>
                                                                                    <label style="color:blue;"><?php echo $valuel->totalentradas;?></label>
                                                                                </td>
                                                                                <td>
                                                                                    <label style="color:red;"><?php echo $valuel->totalsalidas;?></label>
                                                                                </td>
                                                                                <td>
                                                                                    <label style="color:green;"><?php echo $valuel->totalexistencia;?></label>                                                        
                                                                                </td>

                                                                                <td align="center">
                                                                                  <a class="btn btn-icons btn-rounded  btn-round btn-success btn-xs"  href="<?php echo site_url('laminas/detalle/'.$valuel->idparte) ?>"><i class="fa fa-align-justify" aria-hidden="true"></i>
                                                                                    Historial</a>
                                                                                </td>
                                                                            </tr>
                                                                              <?php }
                                                                              }
                                                                          }
                                                                          ?>
                                                                          <?php
                                                                          
                                                                          if(isset($lithos) && !empty($lithos)){
                                                                              foreach ($lithos as $valueli){
                                                                                  if($valueli->totalexistencia > 0){
                                                                                  ?>
                                                                                         <tr>
                                                                                <td>--</td>
                                                                                <td><?php echo $valueli->numeroparte; ?></td>
                                                                                <td>LITHO</td>
                                                                                <td><?php echo $valueli->modelo; ?></td>
                                                                                <td><?php echo $valueli->revision; ?></td>
                                                                                <td>
                                                                                    <label style="color:blue;"><?php echo $valueli->totalentradas;?></label>
                                                                                </td>
                                                                                <td>
                                                                                    <label style="color:red;"><?php echo $valueli->totalsalidas;?></label>
                                                                                </td>
                                                                                <td>
                                                                                    <label style="color:green;"><?php echo $valueli->totalexistencia;?></label>                                                        
                                                                                </td>

                                                                                <td align="center">
                                                                                  <a class="btn btn-icons btn-rounded  btn-round btn-success btn-xs"  href="<?php echo site_url('litho/detalle/'.$valueli->idrevision) ?>"><i class="fa fa-align-justify" aria-hidden="true"></i>
                                                                                    Historial</a>
                                                                                </td>
                                                                            </tr>
                                                                              <?php }
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
                        <div id="sectionB" class="tab-pane fade">
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <div id="app">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table id="datatablewarehouseposicion" class="table" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Ubicación</th>
                                                                    <th scope="col">Entradas</th> 
                                                                    <th scope="col">Salidas</th> 
                                                                    <th scope="col">Existencias</th> 

                                                                    <th class="text-center">Acción</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (isset($posiciones) && !empty($posiciones)):?>
                                                                <?php foreach ($posiciones as $value):?>
                                                                    <tr>
                                                                        <td><?php echo $value->nombreposicion; ?>
                                                                    </td>
                                                                    <td>
                                                                        <label style="color:blue;"><?php echo $value->totalsalidaparciales + $value->totalsalidapallet + $value->total;?></label>
                                                                    </td>
                                                                    <td>
                                                                        <label style="color:red;"><?php echo $value->totalsalidaparciales + $value->totalsalidapallet;?></label>
                                                                    </td>
                                                                    <td>
                                                                        <label style="color:green;"><?php echo $value->total;?></label>                                                        
                                                                    </td>

                                                                    <td align="center">
                                                                        <a class="btn btn-icons btn-rounded  btn-round btn-success btn-xs"  href="<?php echo site_url('warehouse/historialposicion/'.$value->idposicion) ?>"><i class="fa fa-align-justify" aria-hidden="true"></i>
                                                                        Historial</a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach;?>
                                                        <?php endif;?> 
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
    

</div>
</div>
<!-- /page content -->
<script type="text/javascript">
  $( document ).ready(function() {
    $('#datatablewarehouse').DataTable( {
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

    $('#datatablewarehouseposicion').DataTable( {
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