 
<style type="text/css">
  

</style>
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <h3><strong>Administrar Procesos</strong></h3>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12" align="right">
                           <h3><strong><?php echo $detallemaquina->nombremaquina; ?></strong></h3>
                        </div>
                      </div>
                       

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <div class="container">

<div id="exTab2" class="container"> 
<ul class="nav nav-tabs">
      <li class="active">
        <a  href="#1" data-toggle="tab"><strong>Procesos Pendientes</strong></a>
      </li>
      <li><a href="#2" data-toggle="tab"><strong>Procesos Anteriores</strong></a>
      </li>
      
    </ul>

      <div class="tab-content ">
        <div class="tab-pane active" id="1">
          <br>
                  <div class="container">


   <table   class="table table-striped table-bordered example" style="width:100%">
                                            <thead class="text-white bg-dark" >
                                            <th>Lamina</th>
                                            <th>Num. Parte</th>  
                                            <th>Proceso Actual</th>  
                                            <th>C. Recibida (IN)</th>
                                            <th>Malas (NG)</th>
                                            <th>Salidas (FG)</th> 
                                            <th>Opción</th>
                                            </thead>
                                            <tbody>
                                               
                                                <?php 
                                                if (isset($registros) && !empty($registros)) {

                                                    foreach ($registros as $value) { 
                                                       //echo $value->tuturno ;
                                                        if($value->tuturno == $maquina){
                                                        // echo $value->tuturno ;
                                                        ?>
                                                        <tr > 
                                                            <td><strong><?php echo $value->lamina; ?></strong></td>
                                                            <td><strong><?php echo $value->numeroparte;?></strong></td>
                                                             
                                                            <td>
                                                              <?php
                                                                if($value->finalizado == 1){ ?>
                                                                   <span style="font-size: 12px" class="label label-success "><strong><?php echo $value->procesoactual; ?></strong></span>
                                                                <?php }else{ ?>
                                                                   <span style="font-size: 12px" class="label label-warning "><strong><?php echo $value->procesoactual; ?></strong></span>
                                                               <?php  }
                                                              ?>
                                                             

                                                            </td>
                                                            <td align="center"><strong style="color: green"><?php echo number_format($value->cantidadentrada); ?></strong></td>
                                                            <td align="center"><strong style="color: red"><?php echo number_format($value->cantidadmal); ?></strong></td>
                                                            <td align="center"><strong style="color: blue"><?php echo number_format($value->cantidadsalida); ?></strong></td>
                                                            <td>
                                                              <a title="Ver Proceso"  href="" class="btn btn-info btn-sm edit_button" data-toggle="modal" data-target="#myModal"
                                                              data-procesos="<?php echo $value->pasos;?>" >
                                                              <i class="fa fa-eye" aria-hidden="true"></i></a>
                                                               <a title="Enviar al siguiente Proceso" href="" class="btn btn-primary btn-sm edit_button_enviar"
                                                                data-toggle="modal" data-target="#myModalEnviar"
                                                              data-id="<?php echo $value->id;?>"
                                                              data-identradaproceso="<?php echo $value->identradaproceso;?>"
                                                              data-cantidad="<?php echo $value->cantidadentrada;?>"
                                                               ><i class="fa fa-paper-plane" aria-hidden="true"></i>
</a>
        
                                                            </td>
                                                             
                                                        </tr>
                                                        <?php 
                                                         
                                                          } 
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
      
    
                        </div>


        </div>
        <div class="tab-pane" id="2">
          
<br>
          <table   class="table table-striped table-bordered example" style="width:100%">
        <thead> 
               <th>Lamina</th>
                                            <th>Num. Parte</th>  
                                            <th>Proceso Actual</th>  
                                            <th>C. Recibida (IN)</th>
                                            <th>Malas (NG)</th>
                                            <th>Salidas (FG)</th> 
                                            <th>Opción</th>
             
        </thead>
        <tbody>
           <?php 
                                                if (isset($registros) && !empty($registros)) {

                                                    foreach ($registros as $value) { 
                                                       //echo $value->pasoporaqui;
                                                        if($value->pasoporaqui > 0){
                                                        // echo $value->tuturno ;
                                                        ?>
                                                        <tr > 
                                                            <td><strong><?php echo $value->lamina; ?></strong></td>
                                                            <td><strong><?php echo $value->numeroparte;?></strong></td>
                                                             
                                                            <td>
                                                              <?php
                                                                if($value->finalizado == 1){ ?>
                                                                   <span style="font-size: 12px" class="label label-success "><strong><?php echo $value->procesoactual; ?></strong></span>
                                                                <?php }else{ ?>
                                                                   <span style="font-size: 12px" class="label label-warning "><strong><?php echo $value->procesoactual; ?></strong></span>
                                                               <?php  }
                                                              ?>
                                                             

                                                            </td>
                                                            <td align="center"><strong style="color: green"><?php echo number_format($value->cantidadentrada); ?></strong></td>
                                                            <td align="center"><strong style="color: red"><?php echo number_format($value->cantidadmal); ?></strong></td>
                                                            <td align="center"><strong style="color: blue"><?php echo number_format($value->cantidadsalida); ?></strong></td>
                                                            <td>
                                                              <a title="Ver Proceso"  href="" class="btn btn-info btn-sm edit_button" data-toggle="modal" data-target="#myModal"
                                                              data-procesos="<?php echo $value->pasos;?>" >
                                                              <i class="fa fa-eye" aria-hidden="true"></i></a>
                                                               <a title="Enviar al siguiente Proceso" href="" class="btn btn-primary btn-sm edit_button_enviar"
                                                                data-toggle="modal" data-target="#myModalEnviar"
                                                              data-id="<?php echo $value->id;?>"
                                                              data-identradaproceso="<?php echo $value->identradaproceso;?>"
                                                              data-cantidad="<?php echo $value->cantidadentrada;?>"
                                                               ><i class="fa fa-paper-plane" aria-hidden="true"></i>
</a>
        
                                                            </td>
                                                             
                                                        </tr>
                                                        <?php 
                                                         
                                                          } 
                                                        }
                                                    }
                                                ?>
        </tbody>
       
    </table>


        </div>
       

      </div>
  </div>

<hr></hr>

 


                        
                 

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
                <h3 class="modal-title " id="myModalLabel">Proceso a seguir</h3>
            </div>
            <form method="post" action="" id="frmentrada">
                <div class="modal-body"> 
                    <div class="form-group">
                         <label style="font-weight: bolder; font-size: 13px;" id="idprocesos"></label>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button> 
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalEnviar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title " id="myModalLabel">CANTIDAD RECIBIDA: <label class="titlecantidad"></label> </h3>
            </div>
            <form method="post" action="" id="frmenviar">
                <div class="modal-body">
                  <div class="alert alert-danger print-error-msg" style="display:none"></div>
                    <div class="form-group">
                        <input  id="iddetalle" type="hidden" name="iddetalle">
                        <input  id="cantidad" type="hidden" name="cantidad">
                        <input  id="identradaproceso" type="hidden" name="identradaproceso">
                        <input   type="hidden" name="maquina" value="<?php echo $maquina ?>">
                     </div>
                     <div class="form-group">
                         <label ><font color="red">*</font> Cantidad Buenas (FG) </label><br>
                        <input type="text" name="cantidadbien"  class="form-control">
                    </div>
                    <div class="form-group">
                         <label ><font color="red">*</font> Cantidad Malas (NG)</label><br>
                        <input type="text" name="cantidaderror"  class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnenviar"  class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
$(document).on( "click", '.edit_button',function(e) { 
    var procesos = $(this).data('procesos');  
 
    $("#idprocesos").text(procesos);   
});
$(document).on( "click", '.edit_button_enviar',function(e) { 
    var id = $(this).data('id'); 
    var cantidad = $(this).data('cantidad');
    var identradaproceso = $(this).data('identradaproceso');  
 
    $("#iddetalle").val(id); 
    $("#cantidad").val(cantidad);
    $("#identradaproceso").val(identradaproceso); 

    $(".titlecantidad").text(formatNumber( cantidad));   
});
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
 
</script>


<script> 
 

    $("#btnenviar").click(function(){ 
       if (confirm('Despues de enviarlo ya no podra ser modificado, ESTA SEGURO DE ENVIARLO?')) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('proceso/siguiente_proceso');?>",
                data: $('#frmenviar').serialize(),
                success: function(data) {
                    var msg = $.parseJSON(data);
                    console.log(msg.error);
                    if((typeof msg.error === "undefined")){ 
                    $(".print-error-msg").css('display','none'); 
                    alert(msg.success) ? "" : location.reload(); 
                    }else{ 
                    $(".print-error-msg").css('display','block'); 
                    $(".print-error-msg").html(msg.error);

                    }
                }
            });
          }
         
    }); 
</script>
