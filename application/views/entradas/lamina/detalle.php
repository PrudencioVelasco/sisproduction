<div class="right_col" role="main">

<div class="">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="row">
                        <div class="col-md-12" align="left">
                            <h2><strong>Detalle de Movimientos</strong></h2>
                        </div>  
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   
                   
                    <table class="table is-bordered is-hoverable" id="datatable2">
                                            <thead class="text-white bg-dark" >
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Tipo Operacion</th> 
                                            <th>Cantidad</th>   
                                            <th>Opción</th>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if (isset($entradas) && !empty($entradas)) {

                                                    foreach ($entradas as $value) { 

                                                        ?>
                                                        <tr class="table-default"> 
                                                            <td><strong>
                                                                <?php
setlocale(LC_ALL, 'es_ES');
$date = new Datetime($value->fecharegistro);
$fecha = strftime("%A %d de %B de %Y", $date->getTimestamp());
 echo $fecha;?>
                                                            </strong></td>
                                                            <td><?php echo date("h:i:s a", strtotime($value->fecharegistro));?></td>
                                                            <td>

<i class="fa fa-sign-in" aria-hidden="true"></i>
 <span class="label label-success"> <strong  >ENTRADA</strong></span></td>
                                                            <td><strong style="color:green;"><?php echo number_format($value->cantidad) ?></strong></td> 
                                                            <td> 
                                                            <a  href="#"  class="edit_button btn btn-primary btn-xs"
                                                            data-toggle="modal" data-target="#myModal"
                    data-idparte="<?php echo $value->idparte;?>"
                    data-idlamina="<?php echo $value->idlamina;?>"
                    data-cantidad="<?php echo $value->cantidad;?>"
                    data-numeroparte="<?php echo $value->numeroparte;?>"
                    data-comentarios="<?php echo $value->comentarios;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
 Modificar</a>
                                                            <a  href="<?php echo base_url() ?>lamina/eliminar_entrada/<?php echo $value->idlamina."/".$value->idparte ?>"  class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i>
 Eliminar</a>
                                                              </td>
                                                        </tr> 
                                                        
                                                        <?php
                                                    }
                                                } if (isset($salidas) && !empty($salidas)) {

                                                    foreach ($salidas as $value) { 

                                                        ?>
                                                        <tr class="table-default"> 
                                                            <td><strong>
                                                                <?php
setlocale(LC_ALL, 'es_ES');
$date = new Datetime($value->fecharegistro);
$fecha = strftime("%A %d de %B de %Y", $date->getTimestamp());
 echo $fecha;?>
                                                            </strong></td>
                                                            <td><?php echo date("h:i:s a", strtotime($value->fecharegistro));?></td>
                                                            <td><i class="fa fa-sign-out" aria-hidden="true"></i>
 <span class="label label-info"><strong >SALIDAS</strong></span> </td>
                                                            <td><strong><?php echo number_format($value->cantidad) ?></strong></td> 
                                                            <td> </td>
                                                        </tr> 
                                                        
                                                        <?php
                                                    }
                                                }
                                                 if (isset($devoluciones) && !empty($devoluciones)) {

                                                    foreach ($devoluciones as $value) { 

                                                        ?>
                                                        <tr class="table-default"> 
                                                            <td><strong>
                                                                <?php
setlocale(LC_ALL, 'es_ES');
$date = new Datetime($value->fecharegistro);
$fecha = strftime("%A %d de %B de %Y", $date->getTimestamp());
 echo $fecha;?>
                                                            </strong></td>
                                                            <td><?php echo date("h:i:s a", strtotime($value->fecharegistro));?></td>
                                                            <td><i class="fa fa-undo" aria-hidden="true"></i>
 <span class="label label-danger">DEVOLUCIONES</span></td>
                                                            <td><strong style="color:red;"><?php echo number_format($value->cantidad) ?></strong></td> 
                                                            <td> </td>
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

 



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title " id="myModalLabel">Modificar a: <label id="titleentradanumeroparte"></label> </h3>
            </div>
            <form method="post" action="" id="frmentrada">
                <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none"></div>
                    <div class="form-group">
                        <input class="form-control peidparte" type="hidden" name="idparte">
                        <input class="form-control peidlamina" type="hidden" name="idparte">
                      </div>
                     <div class="form-group">
                         <label ><font color="red">*</font> Cantidad</label><br>
                        <input type="text" name="cantidad"  class="form-control pecantidad">
                    </div>
                    <div class="form-group">
                         <label >Comentarios</label><br>
                        <textarea  class="form-control pecomentarios" name="comentarios"></textarea>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnentrada" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>




<script>
$(document).on( "click", '.edit_button',function(e) { 
    var idparte = $(this).data('idparte'); 
    var idlamina = $(this).data('idlamina');
    var comentarios = $(this).data('comentarios');
    var cantidad = $(this).data('cantidad');
    var numeroparte = $(this).data('numeroparte');

    $(".peidparte").val(idparte);  
    $(".peidlamina").val(idlamina);  
    $(".pecomentarios").val(comentarios);   
    $(".pecantidad").val(cantidad);
    $("#titleentradanumeroparte").text(numeroparte);    
}); 
</script>