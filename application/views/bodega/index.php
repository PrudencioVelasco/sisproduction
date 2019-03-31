<!-- page content -->


<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Módulo de Almacen</h3>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div id="app">
                        <transition
                            enter-active-class="animated fadeInLeft"
                            leave-active-class="animated fadeOutRight">
                            <div class="notification is-success text-center px-5 top-middle" v-if="successMSG" @click="successMSG = false">{{successMSG}}</div>
                        </transition>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                 <button id="reload" type="button" class="btn btn-info"><i class="fa fa-refresh" aria-hidden="true"></i></button> 
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control btn-round" v-model="search.text" @keyup="searchDetalleStatus" name="search">
                            </div>
                        </div>

                        <table class="table table-striped responsive-utilities jambo_table bulk_action" style=" margin-top:20px;">
                            <thead class="text-white bg-dark" >
                            <th class="text-white">Transferencia</th>
                            <th class="text-white">Número de parte</th>
                            <th class="text-white">Estatus</th>
                            <th class="text-white">Pallet</th>
                            <th class="text-white">Cantidad</th>
                            <th class="text-white">Revisión</th>
                            <th class="text-white">Fecha</th>
                            <th class="text-white text-right" align="right">Opción</th>
                            </thead>
                            <tbody  >

                                <tr v-for="row in detallestatus" class="table-default">
                                    <td >{{row.folio}} </td>
                                    <td >{{row.numeroparte}} </td>
                                    <td >
                                        <h6 style="color:blue" v-if="row.totalenviado > 0"><strong><i class="fa fa-hourglass-start" aria-hidden="true"></i>
                                                EN ESPERA</strong></h6>
                                        <h6 style="color:green" v-else-if="row.totalpallet ==row.enalmacen"><strong><i class="fa fa-home" aria-hidden="true"></i> EN ALMACEN</strong></h6>
                                        <h6 style="color:red" v-else-if="row.rechazadoacalidad > 0"><strong>R. A CALIDAD</strong></h6>
                                        <h6 style="color:red" v-else-if="row.rechazadoapacking > 0"><strong><i class="fa fa-home" aria-hidden="true"></i>
                                                R. A PACKING</strong></h6>
                                        <h6 style="color:blue" v-else-if="row.enhold > 0"><strong><i class="fa fa-clock-o" aria-hidden="true"></i>
                                                EN HOLD</strong></h6>
                                        <h6 style="color:blue" v-else-if="row.enviadoacalidad > 0"><strong><i class="fa fa-clock-o" aria-hidden="true"></i>
                                                EN CALIDAD</strong></h6>
                                                
                                        
                                       
                                        <h1 v-else>No found</h1>
                                    </td>
                                    <td >{{row.totalpallet}} </td>
                                    <td >{{row.totalcajas}} </td>
                                    <td >{{row.revision}} </td>
                                    <td >{{row.fecharegistro}} </td>

                                    <td align="right">
                                        <a href="" v-bind:href="'verDetalle/'+ row.iddetalleparte"  class="btn btn-info">Ver detalle</a>
                                    </td>
                                </tr>
                                <tr v-if="emptyResult">
                                    <td colspan="6" rowspan="4" class="text-center h4">No encontrado</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" align="right">
                            <pagination
                                :current_page="currentPage"
                                :row_count_page="rowCountPage"
                                @page-update="pageUpdate"
                                :total_users="totalDetalleStatus"
                                :page_range="pageRange"
                                >
                            </pagination>

                            </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 




<script src="<?php echo base_url(); ?>/assets/js/appvue/appbodega.js"></script>
