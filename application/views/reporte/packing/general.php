
<script src="<?php echo base_url(); ?>/assets/js/jquery2.min.js"></script>

<link href="<?php echo base_url(); ?>/assets/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/datepicker/js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/datepicker/js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/datepicker/js/bootstrap-datetimepicker.min.js"></script>


<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                         <h3>REPORTE COMPLETO</h3>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12" align="right">
                     <a href="<?= base_url('Reporte/reportepacking') ?>" class="btn btn-default" style="margin-top: 0px"><i class="fa fa-home"></i> Inicio</a>
                          <a href="<?= base_url('Reporte/reporteCompleto') ?>" class="btn btn-default" style="margin-top: 0px"><i class="fa fa-download"></i> R. Completo</a>
                          <a href="<?= base_url('Reporte/reportePorTransferencia') ?>" class="btn btn-default" style="margin-top: 0px"><i class="fa fa-download"></i> R. por Transferencia</a>
                    </div>
                   </div>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <form method="POST" action="<?= base_url('Reporte/buscar_reporte_packing_completo') ?>">
                        <div class="row">
                            <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label><font color="red">*</font> Tipo</label>
                                <select class="form-control" name="tipo" required="">
                                    <option value="">--Seleccionar--</option>
                                    <option value="1">Producción</option>
                                    <option value="0">Retorno</option>
                                </select>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                         <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Lamina / Número de Parte</label>
                                <select class="js-example-basic-lamina " style="width: 100%" name="idparte">
                                    <option value=""></option>
                                    <?php
                                    foreach ($partes as  $value) {
                                        echo ' <option   value="'.$value->idparte.'">'.$value->numeroparte.'</option> ';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label><font color="red">*</font> Fecha inicio</label>
                                <div class='input-group date' id='datetimepicker3' style="border-radius: 3px; border:solid 2px #ccc; ">
                                    <input type='text' class="form-control"  placeholder="Fecha inicio"  name="fechainicio" required="" />
                                    <span class="input-group-addon" style="border-radius: 2px; border:solid 1px #ccc; padding-bottom: 10px; padding-left: 10px;"  title="Clic para seleccionar la fecha.">
                                        <span style="color: blue;  font-size: 18px"  class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label><font color="red">*</font> Fecha fin</label>
                                <div class='input-group date' id='datetimepicker4' style="border-radius: 3px; border:solid 2px #ccc; ">
                                    <input type='text' class="form-control "  placeholder="Fecha fin" name="fechafin"  required="" />
                                    <span class="input-group-addon" style="border-radius: 2px; border:solid 1px #ccc; padding-bottom: 10px; padding-left: 10px;"  title="Clic para seleccionar la fecha.">
                                        <span style="color: blue;  font-size: 18px"  class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-12 col-xs-12">
                            <div class="form-group"  >
                                <button type="submit" style="margin-top: 25px" class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr/>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatablereporteturnos" class="table">
                            <thead>
                                <tr>
                                 <th scope="col">Num. parte</th>
                                 <th scope="col">Modelo</th>
                                 <th scope="col">Revision</th>
                                 <th scope="col">Planeacion</th>
                                 <th scope="col">Tiempo</th>
                                 <th scope="col">Tot. cajas</th>
                                 <th scope="col">Cant. por pallet</th>
                                 <th scope="col">Tot. de pallet</th>
                                 <th scope="col">Turno</th>
                             </tr>
                         </thead>
                         <tbody>
                            <?php if (isset($informacion) && !empty($informacion)): ?>
                            <?php foreach ($informacion as $value): ?>
                                <tr>
                                    <td><?php echo $value->numeroparte; ?></td>
                                    <td><?php echo $value->modelo; ?></td>
                                    <td><?php echo $value->revision; ?></td>
                                    <td><?php echo "---"; ?></td>
                                    <td><?php echo "LINEA ".$value->tiempo;?></td>
                                    <td><?php echo $value->totalcajas; ?></td>
                                    <td><?php echo "---"; ?></td>
                                    <td><?php echo $value->totalpallet; ?></td>
                                    <td>MATUTINO</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                       <?php if (isset($informacion2) && !empty($informacion2)): ?>
                            <?php foreach ($informacion2 as $value): ?>
                                <tr>
                                    <td><?php echo $value->numeroparte; ?></td>
                                    <td><?php echo $value->modelo; ?></td>
                                    <td><?php echo $value->revision; ?></td>
                                    <td><?php echo "---"; ?></td>
                                    <td><?php echo "LINEA ".$value->tiempo;?></td>
                                    <td><?php echo $value->totalcajas; ?></td>
                                    <td><?php echo "---"; ?></td>
                                    <td><?php echo $value->totalpallet; ?></td>
                                     <td>VESPERTINO</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    <form method="POST" action="<?= base_url('Reporte/generar_pdf_packing_completo') ?>">
        <?php  if (!empty($fechainicio) && !empty($fechafin)) {?>
             <input type = "hidden" name="tipo" value="<?php echo $tipo; ?>"/>
         <input type = "hidden" name="idparte" value="<?php echo $idparte; ?>"/>
         <input type = "hidden" name="fechai" value="<?php echo $fechainicio; ?>"/>
         <input type = "hidden" name="fechaf" value="<?php echo $fechafin; ?>"/>
     <?php }?>
     <div class="row">
        <div class="col-md-1 col-sm-12 col-xs-12">
            <div class="form-group"  >
               <?php  if (!empty($fechainicio) && !empty($fechafin)) {?>
                <button type="submit" style="margin-top: 25px" class="btn btn-danger btn-sm"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> GENERAR REPORTE</button>
            <?php }else{?>
                <button type="submit" style="margin-top: 25px" class="btn btn-danger btn-sm" disabled="" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> GENERAR REPORTE</button>
            <?php }?>
        </div>
    </div>
</div>
</form>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: "Buscar el Numero de Parte",
            allowClear: true
        })

        $('.js-example-basic-lamina').select2({
            placeholder: "Buscar...",
            allowClear: true,
        })
    });
</script>
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
