 <!-- page content -->
 <div class="right_col" role="main">

<div class="">
  
  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Inventario de Bodega</h2>
         
          <div class="clearfix"></div>
        </div>
        <div class="x_content">


 
             <div class="container">
                <div class="row">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                                 <thead>
                                    <tr>
                                       <th>Cliente</th>
                                       <th>Número de Parte</th>
                                       <th>Stock Pallet</th>
                                       <th>Stock Caja</th> 
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=1;
                                       foreach ($resultinventario as $row) { ?>
                                    <tr>
                                       <td><?php echo $row->nombre; ?></td>
                                       <td><?php echo $row->numeroparte; ?></td>
                                       <td><?php echo $row->totalpallet;?></td>
                                       <td><?php echo $row->totalcajas;?></td>
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


</div>
<!-- /page content -->

 