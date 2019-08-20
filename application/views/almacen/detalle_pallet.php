<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Detalle del pallet</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="app"> 
              <br>
              <?php  if(isset($information) && !empty($information)){ ?>
                <table id="datatable-buttons" class="table table-striped table-bordered">
                 <thead>
                  <tr>
                   <th>#</th>
                   <th>Transferencia</th>
                   <th>Numero de parte</th>
                   <th>Modelo</th>
                   <th>Pallet</th>
                   <th>Cantidad</th>
                   <th>Linea</th>
                 </tr>
               </thead>
               <tbody>
                <?php 
                $i=1;
                $count = 1;
                foreach ($information as $row) { ?>
                  <tr>
                    <td><?php echo $count++;?></td>
                    <td><?php echo $row->folio; ?></td>
                    <td><?php echo $row->numeroparte; ?></td>
                    <td><?php echo $row->modelo;?></td>
                    <td><?php echo $row->pallet;?></td> 
                    <td><?php echo $row->cajas;?></td>
                    <td><?php echo $row->nombreposicion;?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<!--<script src="<?php echo base_url();?>/assets/js/appvue/appenviadoscalidad.js"></script>-->