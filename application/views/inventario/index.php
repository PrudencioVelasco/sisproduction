<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><strong>Inventario de Bodega</strong></h2>

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
                                            <th><i class="fa fa-sign-in" aria-hidden="true"></i>
                                                Pallets Producidos</th>
                                            <th><i class="fa fa-sign-in" aria-hidden="true"></i>
                                                Cajas Producidas</th> 
                                            <th><i class="fa fa-sign-out" aria-hidden="true"></i>
                                                Pallets Salidas</th>
                                            <th><i class="fa fa-sign-out" aria-hidden="true"></i>
                                                Cajas Salidas</th> 
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $totalpallet = 0;
                                        $totalcaja = 0;
                                        $totalpalletsa = 0;
                                        $totalcajasa = 0;
                                        foreach ($resultinventario as $row) {
                                            $totalpallet = +$row->totalpallet;
                                            $totalcaja = +$row->totalcajas;
                                            $totalpalletsa = +$row->totalpalletsalida;
                                            $totalcajasa = +$row->totalcajassalida;
                                            ?>
                                            <tr>
                                                <td><?php echo $row->nombre; ?></td>
                                                <td><?php echo $row->numeroparte; ?></td>
                                                <td class="text-success"><strong><?php echo number_format($row->totalpallet); ?></strong></td>
                                                <td class="text-success"><strong><?php echo number_format($row->totalcajas); ?></strong></td>
                                                <td class="text-danger"><strong><?php echo number_format($row->totalpalletsalida); ?></strong></td>
                                                <td class="text-danger"><strong><?php echo number_format($row->totalcajassalida); ?></strong></td>
                                                <td align="center"> <a href="" class="btn btn-round btn-info btn-xs">Detalle</a> </td>  
                                            </tr>
                                        <?php } ?>                                  

                                        <tr>
                                            <td colspan="7"  align="right">
                                                <h4 style="color:red;">Pallet Stock: <strong><?php echo number_format($totalpallet - $totalpalletsa); ?></strong></h4> 
                                                <h4 style="color:red;">Cajas Stock: <strong><?php echo number_format($totalcaja - $totalcajasa); ?></strong></h4> 
                                            </td>
                                        </tr>
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

