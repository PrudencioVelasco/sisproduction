<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Módulo de Salida</h3>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <div id="app">
                            <div class="container">
                                <div class="row">
                                    <transition
                                        enter-active-class="animated fadeInLeft"
                                        leave-active-class="animated fadeOutRight">
                                        <div class="notification is-success text-center px-5 top-middle" v-if="successMSG" @click="successMSG = false">{{successMSG}}</div>
                                    </transition>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-round btn-primary" @click="addModal= true">Nueva salida</button>
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control btn-round" v-model="search.text" @keyup="searchSalida" name="search">
                                            </div>
                                        </div>
                                        <br>
                                        <table class="table table-striped responsive-utilities jambo_table bulk_action"  >
                                            <thead class="text-white bg-dark" >
                                            <th class="text-white"  v-column-sortable:idsalida >No. Tranferencia</th>
                                            <th class="text-white" v-column-sortable:numerosalida>No. Control</th>
                                            <th class="text-white" v-column-sortable:po>P.O.</th>
                                            <th class="text-white" v-column-sortable:nombre>Cliente</th>
                                            <th class="text-white" v-column-sortable:finalizado>Estatus</th>
                                            <th class="text-white" v-column-sortable:fecharegistro> Fecha</th> 
                                            <th class="text-white text-right" align="right">Opción</th>
                                            </thead>
                                            <tbody class="table-light">
                                                <tr v-for="row in salidas" class="table-default">
                                                    <td>{{row.idsalida}}</td>
                                                    <td>{{row.numerosalida}}</td> 
                                                    <td>{{row.po}}</td> 

                                                    <td>{{row.nombre}}</td>
                                                    <td>
                                                        <h6 style="color:blue" v-if="row.finalizado==0"><strong><i class="fa fa-clock-o" aria-hidden="true"></i> EN PROGRESO</strong></h6>
                                                        <h6 style="color:green" v-else><strong><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                                FINALIZADO</strong></h6>
                                                    </td>
                                                    <td>{{row.fecharegistro}}</td>
                                                    <td align="right">
                                                        <button type="button" class="btn btn-icons btn-rounded btn-success btn-xs" @click="editModal = true; selectParte(row)" title="Modificar Datos">
                                                            <i class="fa  fa-edit"></i> Modificar
                                                        </button>

                                                        <a class="btn btn-icons btn-rounded btn-info btn-xs" v-bind:href="'detalleSalida/'+ row.idsalida" ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                            Agregar</a>




                                                    </td>
                                                </tr>
                                                <tr v-if="emptyResult">
                                                    <td colspan="7" rowspan="4" class="text-center h4">No encontrado</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7" align="right">
                                            <pagination
                                                :current_page="currentPage"
                                                :row_count_page="rowCountPage"
                                                @page-update="pageUpdate"
                                                :total_users="totalSalida"
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
                            <?php include 'modal.php'; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /page content -->
<script src="https://cdn.jsdelivr.net/npm/vue-column-sortable@0.0.1/dist/vue-column-sortable.js"></script>
<script data-my_var_1="<?php echo base_url() ?>" src="<?php echo base_url(); ?>/assets/js/appvue/appsalida.js"></script> 