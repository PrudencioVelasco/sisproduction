<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery2.min.js"></script>


<link href="<?php echo base_url(); ?>/assets/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/datepicker/js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/datepicker/js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/datepicker/js/bootstrap-datetimepicker.min.js"></script>


<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Reporte de Transferencias</h3>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <form method="POST" action="<?= base_url('reporte/buscar') ?>"> 
                        <div class="row">  

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group" >
                                    <label><font color="red">*</font> De</label>
                                     <div class='input-group date' id='datetimepicker3' style="border-radius: 3px; border:solid 2px #ccc; ">
                                    <input type='text' disabled="" placeholder="Fecha inicio" class="form-control"  name="fechainicio" required="" />
                                    <span style="border-radius: 2px; border:solid 1px #ccc; padding-bottom: 10px; padding-left: 10px;"  title="Clic para seleccionar la fecha." class="input-group-addon">
                                        <span style="color: blue;  font-size: 18px"  class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> a</label>
                                   <div class='input-group date' id='datetimepicker4' style="border-radius: 3px; border:solid 2px #ccc; ">
                                    <input type='text' class="form-control" disabled="" placeholder="Fecha fin" name="fechafin"  required="" />
                                    <span class="input-group-addon" style="border-radius: 2px; border:solid 1px #ccc; padding-bottom: 10px; padding-left: 10px;"  title="Clic para seleccionar la fecha.">
                                        <span  style="color: blue;  font-size: 18px"  class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> Módulo</label>
                                    <select class="form-control" required name="modulo"> 
                                        <option value="">Seleccionar</option>
                                        <option value="1">PACKING</option>
                                        <option value="2">CALIDAD</option>
                                        <option value="3">ALMACEN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group"  >
                                    <button type="submit"  style="margin-top: 25px" class="btn btn-primary">Buscar</button>
                                </div>
                            </div>
                        </div> 
                    </form>
                    <hr/>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12"> 
                            <table id="datatablereporteturnos" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>T</th>
                                        <th>N. Parte</th>
                                        <th>Módelo</th>
                                        <th>Revisión</th>
                                        <th>Pallet</th>
                                        <th>C</th>  
                                        <th>Fecha</th> 
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <?php
                                    if (isset($result) && !empty($result)) {
                                        foreach ($result as $value):
                                            ?>
                                            <tr>
                                                <td><?php echo $value->folio ?></td>
                                                <td><?php echo $value->numeroparte ?></td>
                                                <td><?php echo $value->nombremodelo ?></td>
                                                <td><?php echo $value->nombrerevision ?></td>
                                                <td><?php echo "1" ?></td>
                                                <td><?php echo $value->cantidad ?></td>
                                                <td><?php echo date("d/m/Y", strtotime($value->fecha)); ?></td>  
                                                <td>
                                                    <?php
                                                    if ($modulo == "1") {
                                                        switch ($value->idestatus) {
                                                            case 1:
                                                                # code...
                                                                echo '<span class="label label-info">E. a Calidad</span>';
                                                                break;
                                                            case 8:
                                                                # code...
                                                                echo '<span class="label label-success">En Bodega</span>';
                                                                break;
                                                            case 3:
                                                                # code...
                                                                echo '<span class="label label-danger">Rechazado</span>';
                                                                break;

                                                            default:
                                                                # code...
                                                                break;
                                                        }
                                                    } elseif ($modulo == "2") {
                                                        # code...
                                                        switch ($value->idestatus) {
                                                            case 4:
                                                                # code...
                                                                echo '<span class="label label-info">E. a Almacen</span>';
                                                                break;
                                                            case 8:
                                                                # code...
                                                                echo '<span class="label label-success">En Bodega</span>';
                                                                break;
                                                            case 6:
                                                                # code...
                                                                echo '<span class="label label-danger">Rechazado</span>';
                                                                break;

                                                            default:
                                                                # code...
                                                                break;
                                                        }
                                                    } elseif ($modulo == "3") {
                                                        # code...
                                                        switch ($value->idestatus) {
                                                            case 4:
                                                                # code...
                                                                echo '<span class="label label-info">E. a Almacen</span>';
                                                                break;
                                                            case 8:
                                                                # code...
                                                                echo '<span class="label label-success">En Bodega</span>';
                                                                break;

                                                            default:
                                                                # code...
                                                                break;
                                                        }
                                                    } else {
                                                        
                                                    }
                                                    ?>

                                                </td>
                                            </tr> 
                                        <?php endforeach ?>
                                    <?php } ?>

                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatablereporteturnos').DataTable({
            "scrollX": false,
            dom: 'Bfrtip',
             buttons: [
        'excelHtml5'
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
        });
        
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker3').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });
        $('#datetimepicker4').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });
    });
</script>




