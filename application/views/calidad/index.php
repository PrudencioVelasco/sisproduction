<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Módulo de Calidad</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="app">
              <!--<div class="row">
                <div class="col-md-6">
                  <a href="<?php //echo site_url('calidad/enviadosBodega') ?>" class="btn btn-round btn-primary">Ver enviados</a>
                </div>
              </div>-->
              <!-- Seccion buscador -->
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12"> 
                  <button id="reload" type="button" class="btn btn-info"><i class="fa fa-refresh" aria-hidden="true"></i></button> 
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                  <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control btn-round" v-model="search.text" @keyup="searchDetalleStatus" name="search">
                </div>
              </div>
              <br>
              <!-- /. Seccion buscador-->
              <!-- Tabla de datos -->
              <table class="table table-striped responsive-utilities jambo_table bulk_action">
                <thead class="text-white bg-dark" >
                  <th class="text-white">Transferencia</th>
                  <th class="text-white">Número de parte</th>
                  <th class="text-white">Estatus</th>
                  <th class="text-white">Pallet</th>
                  <th class="text-white">Cantidad</th>
                   <th class="text-white">Revisión</th>
                  <th class="text-white">Fecha</th>
                  <th class="text-white">Opción</th>
                </thead>
                <tbody>
                  <tr v-for="row in detallestatus" class="table-default">
                    <td>{{row.folio}} </td>
                    <td>{{row.numeroparte}} </td>
                    <td>
                        {{row.totalenviadocalidad}}
                     <h6 style="color:blue" v-if="row.totalenviadoacalidad > 0"><strong><i class="fa fa-hourglass-start" aria-hidden="true"></i> EN ESPERA</strong></h6>
                     
                     <h6 style="color:green" v-else-if="row.totalpallet == row.totalfinalizado"><strong><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> EN ALMACEN </strong></h6>
                      <h6 style="color:red" v-else-if="row.totalcancelado > 0"><strong><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> R. DE ALMACEN </strong></h6>
                      
                      <h6 style="color:red" v-else-if="row.rechazadoapacking > 0"><strong><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> R. A PACKING </strong></h6>
                     
                     <h6 style="color:green" v-else-if="row.totalenviado > 0"><strong><i class="fa fa-hand-o-right" aria-hidden="true"></i> E. A ALMACEN </strong></h6>
                    </td>
                    <td>{{row.totalpallet}} </td>
                    <td>{{row.totalcajas}} </td>
                    <td>{{row.revision}} </td>
                    <td>{{row.fecharegistro}}</td>
                    <td>
                      <a href="javascript:void(0)" v-bind:href="'detalleenvio/'+ row.iddetalleparte" class="btn btn-icons btn-rounded btn-success btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver detalles</a>
                    </td>
                  </tr>
                  <tr v-if="emptyResult">
                    <td colspan="9" rowspan="4" class="text-center h4">No encontrado</td>
                  </tr>
                </tbody>
                <!-- Paginacion -->
                <tfoot>
                  <tr>
                    <td colspan="8" align="center">
                      <pagination
                      :current_page="currentPage"
                      :row_count_page="rowCountPage"
                      @page-update="pageUpdate"
                      :total_users="totalDetalleStatus"
                      :page_range="pageRange">
                    </pagination>
                  </td>
                </tr>
              </tfoot>
              <!-- /. Paginacion -->
            </table>
            <!-- /. Tabla de datos -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>-->
<script src="<?php echo base_url();?>/assets/js/appvue/appcalidad.js"></script>
