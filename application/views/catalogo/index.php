<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3><strong>ADMINISTRAR CATALOGOS</strong></h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row">
                   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                       <a class="pointer" href="<?php echo site_url('user/') ?>">
                       <div class="info-box-2  bg-light-blue hover-expand-effect pointer">
                           <div class="icon">
                               <i class="fa fa-user"></i>
                           </div>
                           <div class="content">
                            <div class="text" ><span class="titulocatalogo">USUARIOS</span></div>
                            <div class="number"><?php echo $totalusuario ?></div>
                           </div>
                       </div>
                       </a>
                   </div>
                   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <a class="pointer" href="<?php echo site_url('client/') ?>">
                       <div class="info-box-2 bg-light-blue hover-expand-effect pointer">
                           <div class="icon">
                               <i class="fa fa-users"></i>
                           </div>
                           <div class="content">
                               <div class="text" ><span class="titulocatalogo">CLIENTES</span></div>
                               <div class="number"><?php echo $totalcliente; ?></div>
                           </div>
                       </div>
                       <a>
                   </div>
                   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                       <a class="pointer" href="<?php echo site_url('turno/') ?>">
                       <div class="info-box-2 bg-light-blue hover-expand-effect pointer">
                           <div class="icon">
                               <i class="fa fa-clock-o"></i>
                           </div>
                           <div class="content">
                               <div class="text" ><span class="titulocatalogo">TURNOS</span></div>
                               <div class="number"><?php echo $totalturno; ?></div>
                           </div>
                       </div>
                     </a>
                   </div>
                   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                     <a class="pointer" href="<?php echo site_url('linea/') ?>">
                       <div class="info-box-2 bg-light-blue hover-expand-effect pointer">
                           <div class="icon">
                               <i class="fa fa-check-square-o"></i>
                           </div>
                           <div class="content">
                               <div class="text" ><span class="titulocatalogo">LINEAS</span></div>
                               <div class="number"><?php echo $totallinea; ?></div>
                           </div>
                       </div>
                     </a>
                   </div>
               </div>


               <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="pointer" href="<?php echo site_url('ubicacion/') ?>">
                <div class="info-box-2 bg-light-blue hover-expand-effect pointer">
                    <div class="icon">
                        <i class="fa fa-thumb-tack"></i>
                    </div>
                    <div class="content">
                     <div class="text" ><span class="titulocatalogo">UBICACIONES</span></div>
                     <div class="number"><?php echo $totalubicacion ?></div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <a class="pointer" href="<?php echo site_url('motivorechazo/') ?>">
                <div class="info-box-2 bg-light-blue hover-expand-effect pointer">
                    <div class="icon">
                        <i class="fa fa-stack-exchange"></i>
                    </div>
                    <div class="content">
                        <div class="text" ><span class="titulocatalogo">RECHAZOS</span></div>
                        <div class="number"><?php echo $totalmotivo; ?></div>
                    </div>
                </div>
                <a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="pointer" href="<?php echo site_url('warehouse/') ?>">
                <div class="info-box-2 bg-light-blue hover-expand-effect pointer">
                    <div class="icon">
                        <i class="fa fa-exchange"></i>
                    </div>
                    <div class="content">
                        <div class="text" ><span class="titulocatalogo">MOVIMIENTOS</span></div>
                        <div class="number"></div>
                    </div>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <a class="pointer" href="<?php echo site_url('parte/parteadmin') ?>">
                <div class="info-box-2 bg-light-blue hover-expand-effect pointer">
                    <div class="icon">
                        <i class="fa fa-archive"></i>
                    </div>
                    <div class="content">
                      <div class="text" ><span class="titulocatalogo">PARTES</span></div>
                        <div class="number"><?php echo number_format($totalnumeroparte); ?></div>
                    </div>
                </div>
              </a>
            </div>
        </div>

        <div class="row">
     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
         <a class="pointer" href="<?php echo site_url('categoria/') ?>">
         <div class="info-box-2 bg-light-blue hover-expand-effect pointer">
             <div class="icon">
                <i class="fa fa-flag-o"></i>
             </div>
             <div class="content">
              <div class="text" ><span class="titulocatalogo">CATEGORIAS</span></div>
              <div class="number"><?php echo $totalcategorias ?></div>
             </div>
         </div>
         </a>
     </div>
     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="pointer" href="<?php echo site_url('documentos/specs') ?>">
         <div class="info-box-2 bg-light-blue hover-expand-effect pointer">
             <div class="icon">
                 <i class="fa fa-file-pdf-o"></i>
             </div>
             <div class="content">
                 <div class="text" ><span class="titulocatalogo">SPECS</span></div>
                 <div class="number"></div>
             </div>
         </div>
         <a>
     </div>
     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
         <a class="pointer" href="<?php echo site_url('documentos/procedimientos') ?>">
         <div class="info-box-2 bg-light-blue hover-expand-effect pointer">
             <div class="icon">
                <i class="fa fa-file-pdf-o"></i>
             </div>
             <div class="content">
                 <div class="text" ><span class="titulocatalogo">PROCEDIMIENTOS</span></div>
                 <div class="number"></div>
             </div>
         </div>
       </a>
     </div>
 </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
