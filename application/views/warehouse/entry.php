<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="row">  
            <div class="col-md-11 col-sm-12 col-xs-12">
              <h3>Reporte de Entradas</h3>
            </div>
            <div class="col-md-1 col-sm-12 col-xs-12">
              <a href="<?php echo base_url('warehouse/index')?>" class="btn btn-success"><i class="fa fa-home" aria-hidden="true"></i></a>
            </div>
          </div>

          <div class="clearfix"></div>
        </div>

        <div class="x_content">

          <form method="POST" action="<?= base_url('warehouse/entry') ?>"> 
            <div class="row">  
              <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label><font color="red">*</font> Fecha Inicial</label>
                  <input type="date" name="fechainicio" class="form-control" required/>
                </div>
              </div>
              <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label><font color="red">*</font> Fecha Final</label>
                  <input type="date" name="fechafin" class="form-control" required/>
                </div>
              </div>
              <div class="col-md-3 col-sm-12 col-xs-12">
               <div class="form-group"  >
                 <button type="submit"  style="margin-top: 25px" class="btn btn-primary">BUSCAR</button>
               </div>
             </div>

           </div> 
         </form>
         <br>
         <br>
         <div class="container">
          <div class="row">
            <div class="col-md-12">
              <table id="datatableentry" class="table">
                <thead>
                  <tr>
                    <th scope="col">Transferencia</th> 
                    <th scope="col">Cliente</th>
                    <th scope="col">No. Parte</th>
                    <th scope="col">Revision</th>
                    <th scope="col">Pallet</th>
                     <th scope="col">CajasxPallet</th>
                    <th scope="col">T. Cajas</th>
                    <th scope="col">Posicion</th> 
                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($entries) && !empty($entries)):?>
                  <?php foreach ($entries as $value):?>
                    <tr>
                      <td><?php echo $value->idtransferancia; ?></td> 
                      <td><?php echo $value->nombre; ?></td>
                      <td><?php echo $value->numeroparte; ?></td>
                      <td><?php echo $value->descripcion; ?></td>
                      <td><strong><?php echo $value->totalpallet; ?></strong></td>
                      <td><strong><?php echo $value->cantidadxpallet; ?></strong></td>
                      <td><strong><?php echo $value->cantidad; ?></strong></td>
                      <td><?php echo $value->nombreposicion; ?></td>
                    </tr>
                  <?php endforeach;?>
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
<script type="text/javascript">
  $( document ).ready(function() {
    $('#datatableentry').DataTable( {
      dom: 'Bfrtip',
      buttons: [
      'excelHtml5',
      'pdfHtml5'
      ]
    } );
  });
</script>