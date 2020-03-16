
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

   <link href="<?php echo base_url(); ?>/assets/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="<?php echo base_url(); ?>/assets/datepicker/js/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/datepicker/js/bootstrap-datetimepicker.es.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/datepicker/js/bootstrap-datetimepicker.min.js"></script>


<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Reporte por Procesos</h3>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <form method="POST" action="<?= base_url('reporte/buscar_reporte_procesos') ?>">

                        <div class="row">
 <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Lamina / Número de Parte</label>
                                    <select class="js-example-basic-lamina " style="width: 100%" name="idlamina">
            <option value=""></option>
            <?php
                foreach ($partes as  $value) {
                    # code...
                    echo ' <option   value="'.$value->idparte.'">'.$value->numeroparte.'</option> ';
                }
            ?>

        </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> De</label>
                                              <div class='input-group date' id='datetimepicker1' style="border-radius: 3px; border:solid 2px #ccc; ">
                    <input type='text' class="form-control"  name="fechainicio" required=""  />
                    <span class="input-group-addon" style="border-radius: 2px; border:solid 1px #ccc; padding-bottom: 10px; padding-left: 10px;">
                        <span class="glyphicon glyphicon-calendar"  style="color: blue;  font-size: 18px" ></span>
                    </span>
                </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> a</label>
                                       <div class='input-group date' id='datetimepicker2' style="border-radius: 3px; border:solid 2px #ccc; ">
                    <input type='text' class="form-control " name="fechafin" required="" />
                    <span class="input-group-addon" style="border-radius: 2px; border:solid 1px #ccc; padding-bottom: 10px; padding-left: 10px;">
                        <span class="glyphicon glyphicon-calendar"  style="color: blue;  font-size: 18px" ></span>
                    </span>
                </div>
                                </div>
                            </div>



                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> Procesos</label>
                                   <select   name="idproceso" class="form-control" required="">
                                    <option value="">--SELECCIONAR--</option>
                                    <option value="2804">TODOS LOS PROCESOS</option>
                                        <?php
                foreach ($procesos as  $value) {
                    # code...
                    echo ' <option   value="'.$value->idproceso.'">'.$value->nombreproceso.'* '.$value->pasos.'</option> ';
                }
            ?>
                                   </select>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-12 col-xs-12">
                                <div class="form-group"  >
                                    <button type="submit"   style="margin-top: 25px" class="btn btn-primary">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatableentry" class="table">
                                    <thead>
                                        <tr>
                                             <th scope="col">No</th>
                                             <th scope="col">Proceso</th>
                                            <th scope="col">Lamina</th>
                                            <th scope="col">Parte</th>
                                            <th scope="col">C. Meta</th>
                                            <th scope="col">C. Entrada (IN)</th>
                                            <th scope="col">C. Malas (NG)</th>
                                            <th scope="col">C. Salidas (FG)</th>
                                             <th scope="col">Estatus</th>
                                             <th scope="col">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($datareporte2) && !empty($datareporte2)):
                                              //var_dump($datareporte);
                                              foreach ($datareporte2 as $value) {
                                                //echo $value->idmaquinafina;
                                                $totalok="";
                                                $totalerror="";
                                                if($value->idmaquinafina == 3){
                                                    $totalok  = $value->totalentrada - $value->totalerrorconscrap;
                                                    $totalerror = $value->totalerrorconscrap;
                                                  //  echo "A";
                                                }else{
                                                    $totalok =  $value->totalsalidasinscrap;
                                                    $totalerror = $value->totalentrada - $value->totalsalidasinscrap;
                                                    //echo "B";
                                                } ?>
                                                <tr>
                                                    <td><?php echo $value->identradaproceso; ?></td>
                                                    <td><?php echo $value->pasos; ?></td>
                                                    <td><?php echo $value->lamina; ?></td>
                                                    <td><?php echo $value->numeroparte; ?></td>
                                                    <td><strong style="color:black;"><?php echo number_format($value->metaproduccion ); ?></strong></td>

                                                    <td>
                                                      <strong style="color:green;"><?php
                                                     echo number_format($value->totalentrada);
                                                      ?>
                                                      </strong>
                                                    </td>
                                                    <td>
                                                      <strong style="color:red;"><?php
                                                     echo number_format($totalerror);
                                                      ?>
                                                      </strong>
                                                    </td>
                                                    <td><strong style="color:blue;">
                                                        <?php echo number_format($totalok); ?></strong>
                                                      </td>
                                                      <td>
                                                        <?php
                                                      if($value->finalizado == 1){
                                                             echo "<strong style='color:green;'>FINALIZADO</strong>";
                                                         }else{
                                                              echo "<strong style='color:#e1c40a;'>EN PROCESO</strong>";
                                                         }
                                                      ?></td>

                                                     <td><?php echo $value->fecharegistro; ?></td>
                                                </tr>
                                                <?php
                                              }
                                          ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script >
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2({
    placeholder: "Buscar el Numero de Parte",
    allowClear: true,
    //dropdownParent: $("#modalLoginForm")
})
     $('.js-example-basic-lamina').select2({
    placeholder: "Buscar...",
    allowClear: true,
    //dropdownParent: $("#modalLoginForm")
})
     });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatableentry').DataTable({
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
        });

    });
</script>

<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    format: 'YYYY-MM-DD HH:mm'
                });
                   $('#datetimepicker2').datetimepicker({
                    format: 'YYYY-MM-DD HH:mm'
                });
            });
        </script>
