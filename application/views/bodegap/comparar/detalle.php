<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                  <h3><strong>BUSQUEDA DE PALLET</strong></h3> 
                  <div class="clearfix"></div>
                </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">

                                <div class="row">
                                   <div class="col-md-12 col-sm-12 col-xs-12 ">
                                              <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#largeModal"><i class='fa fa-plus'></i> Número Parte</button>

                                              <br></br>
                                        <table class="table is-bordered is-hoverable" id="datatablebusqueda">
                                            <thead class="text-white bg-dark" >
                                            <th>N. Parte</th>
                                            <th>Modelo</th>
                                            <th>Revisión</th>
                                            <th>C. Cajas</th>
                                            <th>Ubicación</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($listapartes) && !empty($listapartes)) {
                                                    foreach ($listapartes as $value) {
                                                        $idbusqueda = $value->idbusqueda;
                                                        $idrevision = $value->idrevision;
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <a onclick="return confirm('Esta seguros de Quitar el Número de Parte?')" href="<?php echo site_url('Bodegap/deleteParte/'.$value->iddetallebusqueda.'/'.$value->idbusqueda);?>" title="Quitar elemento."><i class="fa fa-trash" style="color: red"></i></a>
                                                            <?php echo $value->numeroparte ?></td>
                                                            <td><?php echo $value->modelo ?></td>
                                                            <td><?php echo $value->revision ?></td>
                                                            <td><strong><?php echo number_format($value->cantidad) ?></strong></td>
                                                            <td>
                                                            <?php
                                                                if(isset($listacantidad) && !empty($listacantidad))
                                                                {
                                                                    $ubicaciones = "";
                                                                    foreach ($listacantidad as $row) {
                                                                        if($row->idrevision == $idrevision){
                                                                            $ubicaciones .= "<strong>( ".$row->nombreposicion." - ".number_format($row->total)." ) </strong>";
                                                                        }
                                                                    }
                                                                   if(!empty($ubicaciones)){
                                                                    echo $ubicaciones;
                                                                   }else{
                                                                      echo "<label><strong>Sin material.</strong></label>";
                                                                   }


                                                                }else{
                                                                echo "<label><strong>Sin material.</strong></label>";
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

 <div class="modal fade" id="largeModal" tabindex="1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">BUSCAR PALLET</h4>
                         </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <div class="alert alert-success print-success-msg" style="display:none"></div>
                              <div class="alert alert-danger print-error-msg" style="display:none"></div>
                             </div>
                          </div>
                            <div class="row">
                               <div class="col-md-12 col-sm-12 col-xs-12 ">
                                  <form class="fromagregar">
                                    <table id="datatablesearch" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>N. Parte</th>
                                            <th>Modelo</th>
                                            <th>Revision</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($partes) && !empty($partes)){
                                        foreach($partes as $value) {
                                        ?>

                                            <tr>
                                            <td><?php echo $value->numeroparte ?></td>
                                            <td><?php echo $value->modelo ?></td>
                                            <td><?php echo $value->revision ?></td>
                                            <td align="right">
                                                <form method="POST" action="<?php echo site_url('Bodegap/addParte');?>">
                                                    <input type="number" min="0" name="cantidad" class="form-control" required="">
                                                    <input type="hidden" name="idbusqueda" value="<?php echo $idbusqueda; ?>">
                                                    <input type="hidden" name="idrevision" value="<?php echo $value->idrevision; ?>">
                                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                                </form>
                                            </td>
                                            </tr>

                                        <?php
                                        }
                                    }
                                        ?>
                                </table>
                                </form>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class='fa fa-close'></i> CERRAR</button>
                        </div>
                    </div>
                </div>
            </div>
<!-- /page content -->
<script type="text/javascript">

     $(document).ready(function () {
        $('#datatablesearch').dataTable(
                {
                    "columnDefs": [ {
                    "targets": 3,
                    "orderable": false
                    } ],
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
                }
        );
         $('#datatablebusqueda').dataTable(
                {
                dom: "Bfrtip",
                buttons: [{
                        extend: "excel",
                        className: "btn-sm"
                    }, {
                        extend: "pdf",
                        className: "btn-sm"
                    }],

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
                    },
                responsive: !0
                }
        );
    });
    TableManageButtons.init();
</script>
