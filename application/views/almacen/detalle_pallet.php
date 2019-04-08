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
              <!--<div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                  <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control btn-round" v-model="search.text" @keyup="searchDetalleStatus" name="search">
                </div>
              </div>-->
              <br>
              <table class="table table-striped responsive-utilities jambo_table bulk_action">
                <thead class="text-white bg-dark">
                  <th class="text-white">#</th>
                  <th class="text-white">Num. Transferencia</th>
                  <th class="text-white">Numero parte</th>
                  <th class="text-white">Modelo</th>
                  <th class="text-white">Pallet</th>
                  <th class="text-white">Cajas</th>
                  <th class="text-white">Posicion</th>
                </thead>
                <tbody>
                    <?php $count = 1;?>
                    <?php if(!empty($information)):?>
                    <?php foreach($information as $data):?>
                    <tr class="table-default">
                        <td><?php echo $count++;?></td>
                        <td><?php echo $data->folio;?></td>
                        <td><?php echo $data->numeroparte;?></td>
                        <td><?php echo $data->modelo;?></td>
                        <td><?php echo $data->pallet;?></td>
                        <td><?php echo $data->cajas;?></td>
                        <td><?php echo $data->nombreposicion;?></td>
                    </tr>
                    <?php endforeach;?>
                    <?php else:?>
                    <tr>
                        <td colspan="6" rowspan="6" class="text-center h4">No encontrado</td>
                    </tr>
                    <?php endif;?>
                </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<!--<script src="<?php echo base_url();?>/assets/js/appvue/appenviadoscalidad.js"></script>-->