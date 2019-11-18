 <div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">  
                          <div class="col-md-11 col-sm-12 col-xs-12">
                            <h3>Listado de Almacen</h3>
                        </div>
                        <div class="col-md-1 col-sm-12 col-xs-12">
                            <a href="<?php echo base_url('warehouse/index')?>" class="btn btn-success"><i class="fa fa-home" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="app">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="datatablewarehouse" class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Cliente</th>
                                                <th scope="col">No. Parte</th>
                                                <th scope="col">Categoria</th>
                                                <th scope="col">Modelo</th>
                                                <th scope="col">Revisión</th>
                                                <th scope="col">Entradas</th> 
                                                <th scope="col">Salidas</th> 
                                                <th scope="col">Existencia</th> 
                                                
                                                <th class="text-center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($informacion) && !empty($informacion)):?>
                                            <?php foreach ($informacion as $value):?>
                                                <tr>
                                                    <td><?php echo $value->nombre; ?></td>
                                                    <td><?php echo $value->numeroparte; ?></td>
                                                    <td><?php echo $value->nombrecategoria; ?></td>
                                                    <td><?php echo $value->nombremodelo; ?></td>
                                                    <td><?php echo $value->nombrerevision; ?></td>
                                                    <td>
                                                        <label style="color:green;"><?php echo number_format($value->totalsalidaparciales + $value->totalsalidapallet + $value->total);?></label>
                                                    </td>
                                                    <td>
                                                        <label style="color:red;"><?php echo number_format($value->totalsalidaparciales + $value->totalsalidapallet);?></label>
                                                    </td>
                                                    <td>
                                                        <label style="color:green;"><?php echo number_format($value->total);?></label>                                                        
                                                      </td>
                                                    
                                                    <td align="center">
                                                        <a class="btn btn-icons btn-rounded  btn-round btn-success btn-xs"  href="<?php echo site_url('warehouse/historial/'.$value->idrevision) ?>"><i class="fa fa-align-justify" aria-hidden="true"></i>
                                                        Historial</a>
                                                    </td>
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
</div>
</div>
</div>
<!-- /page content -->
<script type="text/javascript">
  $( document ).ready(function() {
    $('#datatablewarehouse').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        'excelHtml5',
        'pdfHtml5'
        ]
    } );
});
</script>