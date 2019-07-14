<div class="right_col" role="main">
  <?php 
  $sumparcial = 0;
  $sumpallet = 0;
  $total =0;
  ?>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="row">  
            <div class="col-md-11 col-sm-12 col-xs-12">
              <h3>Historial de Movimientos</h3>
            </div>
            <div class="col-md-1 col-sm-12 col-xs-12">
              <a href="<?php echo base_url('warehouse/wharehouse')?>" class="btn btn-success"><i class="fa fa-home" aria-hidden="true"></i></a>
            </div>
          </div>

          <div class="clearfix"></div>
        </div>

        <div class="x_content">

          <!--<form method="POST" action="<?= base_url('warehouse/entry') ?>"> 
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
         </form>-->
         <br>
         <br>
         <div class="container">
          <div class="row">
            <div class="col-md-12">
              <table id="datatablerecord" class="table">
                <thead>
                  <tr>
                    <th scope="col">Cliente</th>
                    <th scope="col">No. Parte</th>
                    <th scope="col">Revision</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Posicion</th> 
                    <th scope="col">Fecha</th> 
                    <th scope="col">Hora</th> 
                    <th scope="col">Estatus</th> 
                    <th scope="col">Tipo</th>
                  </tr>
                </thead>
                <tbody>
                  <!--Entradas-->
                  <?php if (isset($entradas) && !empty($entradas)):?>
                  <?php foreach ($entradas as $value):?>
                    <tr>
                      <td><?php echo $value->nombre; ?></td>
                      <td><?php echo $value->numeroparte; ?></td>
                      <td><?php echo $value->descripcion; ?></td>
                      <td><?php echo $value->cantidad; ?></td>
                      <td><?php echo $value->nombreposicion; ?></td>
                      <td><?php echo date("Y-m-d", strtotime($value->fecharegistro));?></td>
                      <td><?php echo date("h:i:s a", strtotime($value->fecharegistro));?></td>
                      <td> <label style="color:green;">ENTRADA</label> </td>
                      <td><label style="color:green;">ENTRADA</label></td>
                    </tr>
                  <?php endforeach;?>
                <?php endif;?> 

                <!--Salidas parciales-->
                <?php if (isset($salidasparciales) && !empty($salidasparciales)):?>
                <?php foreach ($salidasparciales as $value):?>
                  <?php $sumparcial = $sumparcial + $value->caja; ?>
                  <tr>
                    <td><?php echo $value->nombre; ?></td>
                    <td><?php echo $value->numeroparte; ?></td>
                    <td><?php echo $value->descripcion; ?></td>
                    <td><?php echo $value->caja; ?></td>
                    <td><?php echo $value->nombreposicion; ?></td>
                    <td><?php echo date("Y-m-d", strtotime($value->fecharegistro));?></td>
                    <td><?php echo date("h:i:s a", strtotime($value->fecharegistro));?></td>
                    <td> <label style="color:red;">SALIDA</label> </td>
                    <td><label style="color:orange;">PARCIAL</label></td>
                  </tr>
                <?php endforeach;?>
              <?php endif;?> 
              <!--Salidas Pallet-->
              <?php if (isset($salidaspallet) && !empty($salidaspallet)):?>
              <?php foreach ($salidaspallet as $value):?>
                <?php $sumpallet = $sumpallet + $value->cantidad; ?>
                <tr>
                  <td><?php echo $value->nombre; ?></td>
                  <td><?php echo $value->numeroparte; ?></td>
                  <td><?php echo $value->descripcion; ?></td>
                  <td><?php echo $value->cantidad; ?></td>
                  <td><?php echo $value->nombreposicion; ?></td>
                  <td><?php echo date("Y-m-d", strtotime($value->fecharegistro));?></td>
                  <td><?php echo date("h:i:s a", strtotime($value->fecharegistro));?></td>
                  <td> <label style="color:red;">SALIDA</label> </td>
                  <td><label style="color: #3633ff ;">PALLET</label></td>
                </tr>
              <?php endforeach;?>
            <?php endif;?> 

          </tbody>
        </table>
        <?php $total = $sumparcial = $sumpallet; ?>
      </div> 
    </div> 
  </div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
  $( document ).ready(function() {
    $('#datatablerecord').DataTable( {
      dom: 'Bfrtip',
      buttons: [
      'excelHtml5',
      'pdfHtml5'
      ]
    } );
  });
</script>