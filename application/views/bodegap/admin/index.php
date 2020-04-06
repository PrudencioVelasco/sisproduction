 <div class="right_col" role="main">
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3><strong>ADMINISTRAR ALMACEN</strong></h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                           <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                         <strong><h4><i class="fa fa-home"></i>  LISTADO GENERAL</h4></strong>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <strong><h4><i class="fa fa-list"></i>  LISTADO POR UBICACIÓN</h4></strong>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                                    <br>
                                     <table id="datatablewarehouse" class="table" width="100%" cellspacing="0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Cliente</th>
                                                                            <th scope="col">Categoría</th>
                                                                            <th scope="col">No. Parte</th>
                                                                            <th scope="col">Modelo</th>
                                                                            <th scope="col">Revisión</th>
                                                                            <th scope="col">Existencias</th>
                                                                            <th class="text-center">Acción</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php if (isset($informacion) && !empty($informacion)):

                                                                        ?>
                                                                        <?php foreach ($informacion as $value):
                                                                            $total_existencia = $value->totalentrada  -  ($value->totalsalidaparciales + $value->totalsalidapallet);
                                                                            if($total_existencia > 0){

                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo $value->nombre; ?></td>
                                                                                 <td><?php echo $value->nombrecategoria; ?></td>
                                                                                <td><?php echo $value->numeroparte; ?></td>

                                                                                <td><?php
                                                                                echo $value->nombremodelo;
                                                                                ?></td>
                                                                                <td><?php echo strtoupper($value->nombrerevision); ?></td>

                                                                                <td>
                                                                                    <label style="color:green;">
                                                                                        <?php
                    echo $value->totalentrada  -  ($value->totalsalidaparciales + $value->totalsalidapallet);
                                                                                    ?></label>
                                                                                </td>

                                                                                <td align="center">
                                                                                  <a class="btn btn-icons btn-rounded  btn-round btn-info btn-sm"  href="<?php echo site_url('Bodegap/historial/'.$value->idrevision) ?>">
                                                                                    Detalles</a>
                                                                                </td>
                                                                            </tr>
                                                                        <?php } endforeach;?>
                                                                    <?php endif;?>


                                                                </tbody>
                                                            </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                                    <br>
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
                                                                        <label style="color:blue;"><?php //echo $value->totalsalidaparciales + $value->totalsalidapallet + $value->total;
                                                                            echo $value->totalentrada;
                                                                        ?></label>
                                                                    </td>
                                                                    <td>
                                                                        <label style="color:red;"><?php echo $value->totalsalidaparciales + $value->totalsalidapallet;?></label>
                                                                    </td>
                                                                    <td>
                                                                        <label style="color:green;">
                                                                            <?php
                                                                               echo $value->totalentrada  -  ($value->totalsalidaparciales + $value->totalsalidapallet);
                                                                             ?>

                                                                            </label>
                                                                    </td>

                                                                    <td align="center">
                                                                        <a class="btn btn-icons btn-rounded  btn-round btn-info btn-sm"  href="<?php echo site_url('Bodegap/ubicacion/'.$value->idposicion) ?>">
                                                                        Detalles</a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach;?>
                                                        <?php endif;?>
                                                    </tbody>
                                                </table>
                                </div>
                            </div>


<!-- /page content -->
<script type="text/javascript">
  $( document ).ready(function() {
    $('#datatablewarehouse').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7 ]
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
