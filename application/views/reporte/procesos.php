<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Reporte de Procesos</h3>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <form method="POST" action="<?= base_url('reporte/buscar_reporte_proceso') ?>">  
                        <div class="row">
                             <div class="col-md-4 col-sm-12 col-xs-12">
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
                        </div>
                        <div class="row">  

                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> De</label>
                                    <input type="date" name="fechainicio" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> a</label>
                                    <input type="date" name="fechafin" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Procesos</label>
                                    <select class="form-control"  name="idproceso"> 
                                        <option value="">TODOS</option>
                                       <?php
                                       if (isset($procesos) && !empty($procesos)) {
                                           foreach ($procesos as  $value) {
                                               # code...
                                            echo '<option value="'.$value->idproceso.'">'.$value->nombreproceso.' '.$value->pasos.'</option>';
                                           }
                                       }
                                       ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>  Maquina</label>
                                    <select class="form-control"  name="idmaquina"> 
                                        <option value="">TODOS</option>
                                       <?php
                                       if (isset($maquinas) && !empty($maquinas)) {
                                           foreach ($maquinas as  $value) {
                                               # code...
                                            echo '<option value="'.$value->idmaquina.'">'.$value->nombremaquina.'</option>';
                                           }
                                       }
                                       ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12">
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
                                             <th scope="col">N Entrada</th> 
                                            <th scope="col">Lamina</th> 
                                            <th scope="col">Parte</th>
                                            <th scope="col">Procesos</th>
                                            <th scope="col">Actual</th>
                                            <th scope="col">C. Entrada</th>
                                            <th scope="col">C. Erroneas</th>
                                            <th scope="col">C. Salidas</th>
                                             <th scope="col">T. Transcurrido</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($datareporte) && !empty($datareporte)): ?>
                                            <?php foreach ($datareporte as $value): ?>
                                                <tr>
                                                    <td><?php echo $value->identradaproceso; ?></td> 
                                                    <td><?php echo $value->lamina; ?></td> 
                                                    <td><?php echo $value->numeroparte; ?></td>
                                                    <td><?php echo $value->pasos; ?></td>
                                                    <td>
                                                    <?php
                                                                if($value->finalizado == 1){ ?>
                                                                   <span style="font-size: 12px" class="label label-success "><strong><?php echo $value->numerodelproceso.'.- '.$value->maquinaactual; ?></strong></span>
                                                                <?php }else{ ?>
                                                                   <span style="font-size: 12px" class="label label-warning "><strong><?php echo $value->numerodelproceso.'.- '.$value->maquinaactual; ?></strong></span>
                                                               <?php  }
                                                              ?>
                                                        </td>
                                                    <td><strong style="color:green;"><?php echo number_format($value->cantidadentrada); ?></strong></td>
                                                    <td><strong style="color:red;"><?php echo number_format($value->cantidaderronea); ?></strong></td>
                                                    <td><strong style="color:blue;"><?php echo number_format($value->cantidadsalida); ?></strong></td> 
                                                    <td>
                                                        <?php
                                                            $fecha1 = new DateTime($value->fecharegistro);
    $fecha2 = new DateTime($value->fechaliberado);
    $fecha = $fecha1->diff($fecha2);
    printf('%d horas, %d minutos', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i);
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
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



