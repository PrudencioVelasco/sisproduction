<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Catalogos</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row top_tiles">
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-user"></i>
                                    </div>
                                    <div class="count"><?php echo $totalusuario ?></div>

                                    <h3><a href="<?php echo site_url('user/') ?>">Usuarios</a></h3>
                                    <p>Catalogo de usuarios.</p>
                                </div>
                            </div>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-users"></i>
                                    </div>
                                    <div class="count"><?php echo $totalcliente; ?></div>

                                    <h3><a href="<?php echo site_url('client/') ?>">Clientes</a></h3>
                                    <p>Catalogo de clientes.</p>
                                </div>
                            </div>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-clock-o"></i>
                                    </div>
                                    <div class="count"><?php echo $totalturno; ?></div>

                                    <h3><a href="<?php echo site_url('turno/') ?>">Turnos</a></h3>
                                    <p>Catalogo de tuenos.</p>
                                </div>
                            </div>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-check-square-o"></i>
                                    </div>
                                    <div class="count"><?php echo $totallinea; ?></div>

                                    <h3><a href="<?php echo site_url('linea/') ?>">Linea</a></h3>
                                    <p>Catalogo de linea.</p>
                                </div>
                            </div>
                        </div>


                        <div class="row top_tiles">
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-thumb-tack"></i>
                                    </div>
                                    <div class="count"><?php echo $totalubicacion ?></div>

                                    <h3><a href="<?php echo site_url('ubicacion/') ?>">Ubicación</a></h3>
                                    <p>Catalogo de ubicación.</p>
                                </div>
                            </div>
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-stack-exchange"></i>
                                    </div>
                                    <div class="count"><?php echo $totalmotivo ?></div>

                                    <h3><a href="<?php echo site_url('motivorechazo/') ?>">Rechazo</a></h3>
                                    <p>Motivo de rechazo.</p>
                                </div>
                            </div> 
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-exchange"></i>
                                    </div>
                                    <div class="count">---</div>

                                    <h3><a href="<?php echo site_url('warehouse/') ?>">Movimientos</a></h3>
                                    <p>Movimientos de partes.</p>
                                </div>
                            </div> 
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="count">---</div>

                                    <h3><a href="<?php echo site_url('almacen/') ?>">Locación</a></h3>
                                    <p>Ubicar los pallet en el almacen.</p>
                                </div>
                            </div> 
                        </div>




                        <div class="row top_tiles">
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-archive"></i>
                                    </div>
                                    <div class="count"><?php echo $totalnumeroparte; ?></div>

                                    <h3><a href="<?php echo site_url('parte/parteadmin') ?>">Parte</a></h3>
                                    <p>Catalogo de Número Parte.</p>
                                </div>
                            </div>  
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-archive"></i>
                                    </div>
                                    <div class="count"><?php echo $totalcategorias; ?></div>

                                    <h3><a href="<?php echo site_url('categoria/') ?>">Categorias</a></h3>
                                    <p>Categorias de Número de Parte.</p>
                                </div>
                            </div> 
                              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats">
                                    <div class="icon"><i class="fa fa-upload"></i>
                                    </div>
                                    <div class="count">---</div>

                                    <h3><a href="<?php echo site_url('catalogo/subir') ?>">Subir</a></h3>
                                    <p>Subir inventario al Sistema.</p>
                                </div>
                            </div> 
                        </div> 

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
