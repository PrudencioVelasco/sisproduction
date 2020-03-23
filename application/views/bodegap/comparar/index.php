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
                                    <a href="<?php echo site_url('bodegap/create_search/') ?>" class="btn btn-primary" onclick="return confirm('Esta seguros de crear una nueva busqueda.?')"><i class='fa fa-plus'></i> Nueva busqueda</a>
                                        <br/> <br/>


                                        <table class="table is-bordered is-hoverable" id="datatable2">
                                            <thead class="text-white bg-dark" >
                                            <th>#</th>
                                            <th>Busqueda</th>
                                            <th>Fecha</th>
                                            <th></th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($busquedas) && !empty($busquedas)) {
                                                    $numero = 1;
                                                    foreach ($busquedas as $value) {
                                                        ?>
                                                        <tr>
                                                             <td><?php echo $numero++; ?></td>
                                                            <td><strong><?php echo $value->nombrebusqueda; ?></strong></td>
                                                            <td><?php echo date_format(date_create($value->fecharegistro),"d/m/Y h:i A") ?></td>
                                                            </td>
                                                            <td align="right">
                                                            <a class="btn btn-icons btn-info btn-sm"  href="<?php echo site_url('bodegap/detalle_busqueda/'.$value->idbusqueda) ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</a>
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
<script type="text/javascript">

     $(document).ready(function () {

        $('#datatablesearch').dataTable(
                {
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
    });
    TableManageButtons.init();
</script>
