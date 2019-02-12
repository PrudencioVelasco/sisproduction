<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <?php if (isset($_SESSION['err'])): ?>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Permiso!</h4>
                    <p>Usted tiene acceso denegado para entrar a esta menu.</p>
                    <hr>
                    <p class="mb-0">Si requiere permiso solicitelo al administrador.</p>
                </div>
            <?php endif ?>
        </div>  
    </div>
    <br />

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><strong><i class="fa fa-industry" aria-hidden="true"></i>
                        Producción total por Mes</strong></h2>
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
                <table class="table table-striped">
                    <thead>
                        <tr>

                            <th>Mes</th>
                            <th>Subtotal pallet</th>
                            <th>Subtotal cajas</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($datatotal) && !empty($datatotal)) {
                            $sumapallet = 0;
                            $sumacajas = 0;
                            foreach ($datatotal as $row) {
                                $sumapallet += $row->totalpallet;
                                $sumacajas += $row->totalcajas;
                                ?>

                                <tr>

                                    <td><?php echo $row->mes ?></td>
                                    <td><?php echo number_format($row->totalpallet) ?></td>
                                    <td><?php echo number_format($row->totalcajas) ?></td>

                                </tr>


                            <?php }
                            ?>
                            <tr> 
                                <td></td>
                                <td><label class="text-success" >Total: <?php echo number_format($sumapallet); ?></label></td>
                                <td><label class="text-success" >Total: <?php echo number_format($sumacajas); ?></label></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>       
                </table>

            </div>
        </div>
    </div> 
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><strong><i class="fa fa-industry" aria-hidden="true"></i>
                        Producción detallada por número de parte</strong></h2>
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>N. Parte</th>
                            <th>Mes</th>
                            <th>Subtotal pallet</th>
                            <th>Subtotal cajas</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($datadetallada) && !empty($datadetallada)) {
                            $sumapallet = 0;
                            $sumacajas = 0;
                            foreach ($datadetallada as $row) {
                                $sumapallet += $row->totalpallet;
                                $sumacajas += $row->totalcajas;
                                ?>

                                <tr>
                                    <td><?php echo $row->numeroparte ?></td>
                                    <td><?php echo $row->mes ?></td>
                                    <td><?php echo number_format($row->totalpallet) ?></td>
                                    <td><?php echo number_format($row->totalcajas) ?></td>

                                </tr>


                            <?php }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><label class="text-success" >Total: <?php echo number_format($sumapallet); ?></label></td>
                                <td><label class="text-success" >Total: <?php echo number_format($sumacajas); ?></label></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>       
                </table>

            </div>
        </div>
    </div> 
</div>