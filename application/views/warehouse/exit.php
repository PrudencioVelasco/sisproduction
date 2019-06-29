<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3>Reporte de Salidas</h3>

          <div class="clearfix"></div>
        </div>

        <div class="x_content">

          <form method="POST" action="<?= base_url('warehouse/exit') ?>"> 
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
                <div class="form-group">
                  <label for="tipo"><font color="red">*</font> Tipo</label>
                  <select class="form-control" id="tipo" name="tipo" required>
                    <option value="">Seleccione una opcion</option>
                    <option value="0">Todos</option>
                    <option value="1">Pallet</option>
                    <option value="2">Parciales</option>
                  </select>
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
              <table id="datatable" class="table">
                <thead>
                  <tr>
                    <th scope="col">No. salida</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">No. Parte</th>
                    <th scope="col">Revision</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Posicion</th>
                    <th scope="col" id="datacol">Cajas</th> 
                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($exits) && !empty($exits)):?>
                  <?php foreach ($exits as $value):?>
                    <tr>
                      <td><?php echo $value->idtransferancia; ?></td>
                      <td><?php echo $value->nombre; ?></td>
                      <td><?php echo $value->numeroparte; ?></td>
                      <td><?php echo $value->descripcion; ?></td>
                      <td><?php echo $value->cantidad; ?></td>
                      <td><?php echo $value->nombreposicion; ?></td>
                      <?php if (!empty($value->caja)): ?>
                        <td id="data"><?php echo $value->caja; ?></td>
                      <?php endif ?>
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
    var attr = $(this).attr('#data');
    if (typeof attr !== typeof undefined && attr !== false) {
      $("#datacol").show();
    }else{
      $("#datacol").hide();
    }
  });
</script>