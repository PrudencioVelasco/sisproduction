<div class="right_col" role="main">
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_title">
               <h3><i class="fa fa-bars"></i> Módulo de Movimientos</h3>
               <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                     <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                     </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
               </ul>
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                     <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"> <i class="fa fa-sign-in" aria-hidden="true" style="color:green;"></i>
                        <label>ENTRADAS</label></a>
                     </li>
                     <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-sign-in" aria-hidden="true" style="color:red;"></i> <label>SALIDAS COMPLETAS</label></a>
                     </li>
                     <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false"><i class="fa fa-sign-in" aria-hidden="true" style="color:red;"></i> <label>SALIDAS PARCIALES</label></a>
                     </li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                     <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        <p>Detallado de número de parte producidas.</p>
                        <div class = "form-inline">
                           <label>Fecha:</label>
                           <input type = "text" class = "form-control" placeholder = "Inicial"  id = "date1"/>
                           <label>a</label>
                           <input type = "text" class = "form-control" placeholder = "Final"  id = "date2"/>
                           <button type = "button" class = "btn btn-primary" id = "btn_search"><span class = "glyphicon glyphicon-search"></span></button> <button type = "button"  class = "btn btn-success reset"><span class = "glyphicon glyphicon-refresh"></span></button>
                        </div>
                        <table class="table">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Cliente</th>
                                 <th>Número de parte</th>
                                 <th>Total Pallet</th>
                                 <th>Total Cajas</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody id = "load_data">
                              <?php 
                                 $i=1;
                                 $sumapallet = 0;
                                 $sumacajas = 0;
                                 if(isset($entradas) && !empty($entradas)){
                                 foreach ($entradas as $value){ 
                                 $sumapallet+=$value->totalpallet;
                                 $sumacajas+=$value->totalcajas;
                                 ?>
                              <tr>
                                 <th scope="row"><?php echo $i++; ?></th>
                                 <td><?php echo $value->nombre ?></td>
                                 <td><strong><?php echo $value->numeroparte ?></strong></td>
                                 <td><?php echo number_format($value->totalpallet) ?></td>
                                 <td><?php echo number_format($value->totalcajas) ?></td>
                              </tr>
                              <?php }  ?>
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td><strong><?php echo number_format($sumapallet); ?></strong></td>
                                 <td><strong><?php echo number_format($sumacajas); ?></strong></td>
                                 <td></td>
                              </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                     <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        <p>Detallado de número de partes dado de salida, pallet completos.</p>
                         <div class = "form-inline">
                           <label>Fecha:</label>
                           <input type = "text" class = "form-control" placeholder = "Inicial"  id = "date3"/>
                           <label>a</label>
                           <input type = "text" class = "form-control" placeholder = "Final"  id = "date4"/>
                           <button type = "button" class = "btn btn-primary" id = "btn_search2"><span class = "glyphicon glyphicon-search"></span></button> <button type = "button"  class = "btn btn-success reset"><span class = "glyphicon glyphicon-refresh"></span></button>
                        </div>
                        
                        <table class="table">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Cliente</th>
                                 <th>Número de parte</th>
                                 <th>Total Pallet</th>
                                 <th>Total Cajas</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody id="load_data2">
                              <?php 
                                 $i=1;
                                 $sumapallet = 0;
                                 $sumacajas = 0;
                                 if(isset($salidascompletos) && !empty($salidascompletos)){
                                 foreach ($salidascompletos as $value){ 
                                 $sumapallet+=$value->totalpallet;
                                 $sumacajas+=$value->totalcajas;
                                 ?>
                              <tr>
                                 <th scope="row"><?php echo $i++; ?></th>
                                 <td><?php echo $value->nombre ?></td>
                                 <td><strong><?php echo $value->numeroparte ?></strong></td>
                                 <td><?php echo number_format($value->totalpallet) ?></td>
                                 <td><?php echo number_format($value->totalcajas) ?></td>
                              </tr>
                              <?php }  ?>
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td><strong><?php echo number_format($sumapallet); ?></strong></td>
                                 <td><strong><?php echo number_format($sumacajas); ?></strong></td>
                                 <td></td>
                              </tr>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                     <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        <p>Detallado de salidas de número de pallet en parciales.</p>
                           <div class = "form-inline">
                           <label>Fecha:</label>
                           <input type = "text" class = "form-control" placeholder = "Inicial"  id = "date5"/>
                           <label>a</label>
                           <input type = "text" class = "form-control" placeholder = "Final"  id = "date6"/>
                           <button type = "button" class = "btn btn-primary" id = "btn_search3"><span class = "glyphicon glyphicon-search"></span></button> <button type = "button" class = "btn btn-success reset"><span class = "glyphicon glyphicon-refresh"></span></button>
                        </div>
                        <table class="table">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Cliente</th>
                                 <th>Número de parte</th>
                                 <th>Total Cajas</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody id="load_data3">
                              <?php 
                                 $i=1; 
                                 $sumacajas = 0;
                                 if(isset($salidasparciales) && !empty($salidasparciales)){
                                 foreach ($salidasparciales as $value){ 
                                 
                                 $sumacajas+=$value->totalcajas;
                                 ?>
                              <tr>
                                 <th scope="row"><?php echo $i++; ?></th>
                                 <td><?php echo $value->nombre ?></td>
                                 <td><strong><?php echo $value->numeroparte ?></strong></td>
                                 <td><?php echo number_format($value->totalcajas) ?></td>
                                 <td></td>
                              </tr>
                              <?php }  ?>
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td><strong><?php echo number_format($sumacajas); ?></strong></td>
                                 <td></td>
                              </tr>
                              <?php } ?>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function() {
    $('#date1').datepicker();
    $('#date2').datepicker();
    $('#date3').datepicker();
    $('#date4').datepicker();
    $('#date5').datepicker();
    $('#date6').datepicker();
    $('#btn_search').on('click', function() {
        if ($('#date1').val() == "" || $('#date2').val() == "") {
            alert("Please enter something on the text field");
        } else {
            $date1 = $('#date1').val();
            $date2 = $('#date2').val();
            $('#load_data').empty();
            $loader = $('<tr ><td colspan = "5"><h4><strong><center>Searching....</center></strong></h4></td></tr>');
            $loader.appendTo('#load_data');
            setTimeout(function() {
                $loader.remove();
                $.ajax({
                    url: '<?php echo base_url("inventario/searchDate"); ?>',
                    type: 'POST',
                    data: {
                        date1: $date1,
                        date2: $date2
                    },
                    success: function(res) {
                        $('#load_data').html(res);
                    }
                });
            }, 3000);
        }
    });
        $('#btn_search2').on('click', function() {
        if ($('#date3').val() == "" || $('#date4').val() == "") {
            alert("Please enter something on the text field");
        } else {
            $date3 = $('#date3').val();
            $date4 = $('#date4').val();
            $('#load_data2').empty();
            $loader = $('<tr ><td colspan = "5"><h4><strong><center>Searching....</center></strong></h4></td></tr>');
            $loader.appendTo('#load_data2');
            setTimeout(function() {
                $loader.remove();
                $.ajax({
                    url: '<?php echo base_url("inventario/searchDatePallet"); ?>',
                    type: 'POST',
                    data: {
                        date3: $date3,
                        date4: $date4
                    },
                    success: function(res) {
                        $('#load_data2').html(res);
                    }
                });
            }, 3000);
        }
    });
    
        $('#btn_search3').on('click', function() {
        if ($('#date5').val() == "" || $('#date6').val() == "") {
            alert("Please enter something on the text field");
        } else {
            $date5 = $('#date5').val();
            $date6 = $('#date6').val();
            $('#load_data3').empty();
            $loader = $('<tr ><td colspan = "4"><h4><strong><center>Searching....</center></strong></h4></td></tr>');
            $loader.appendTo('#load_data3');
            setTimeout(function() {
                $loader.remove();
                $.ajax({
                    url: '<?php echo base_url("inventario/searchDateParciales"); ?>',
                    type: 'POST',
                    data: {
                        date5: $date5,
                        date6: $date6
                    },
                    success: function(res) {
                        $('#load_data3').html(res);
                    }
                });
            }, 3000);
        }
    });

    $('.reset').on('click', function() {
        location.reload();
    });
});
</script>
