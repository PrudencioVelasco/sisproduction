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
                    <h3>Reporte Almacen</h3>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <form method="POST" action="<?= base_url('reporte/buscar_reporte_almacen') ?>">     

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
                                    <input type='text' class="form-control" disabled="" placeholder="Fecha inicio"  name="fechainicio" required="" />
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
                                    <input type='text' class="form-control " disabled="" placeholder="Fecha fin" name="fechafin"  required="" />
                                    <span class="input-group-addon" style="border-radius: 2px; border:solid 1px #ccc; padding-bottom: 10px; padding-left: 10px;"  title="Clic para seleccionar la fecha.">
                                        <span style="color: blue;  font-size: 18px"  class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-12 col-xs-12">
                            <div class="form-group"  >
                                <button type="submit" style="margin-top: 25px" class="btn btn-success">BUSCAR</button>
                            </div>
                        </div>
                    </div> 
                </form>               
                <hr/>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12"> 
                        <table id="datatablereportealmacen" class="table">
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
                                    <td><?php echo $value->cantidadcajaspallet; ?></td>
                                    <td><?php echo $value->totalpallet; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr/>
        <form method="POST" action="<?= base_url('reporte/generar_pdf_almacen') ?>"> 
            <?php  if (!empty($fechainicio) && !empty($fechafin)) {?>
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
        $('#datatablereportealmacen').DataTable({
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


