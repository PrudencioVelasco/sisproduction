<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Módulo de Parte</h3>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">
                               
                                   
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <button class="btn btn-round btn-primary" @click="addModal= true">Nueva parte</button>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control btn-round" v-model="search.text" @keyup="searchParte" name="search">
                                            </div>
                                        </div>
                                        <br>
                                         <div class="row">
                                        <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                            <thead class="text-white bg-dark" >
                                            <th class="text-white" v-column-sortable:numeroparte>Número de parte</th>
                                            <th class="text-white" v-column-sortable:nombre>Cliente</th>
                                            <th class="text-white" v-column-sortable:name>Usuario registro</th>
                                            <th class="text-white" v-column-sortable:activo>Estatus</th>
                                            <th class="text-white text-right" align="right">Opción</th>
                                            </thead>
                                            <tbody class="table-light">
                                                <tr v-for="row in partes" class="table-default">
                                                    <td>{{row.numeroparte}}</td>
                                                    <td>{{row.nombre}}</td>
                                                    <td>{{row.name}}</td>
                                                    <td >
                                                        <span v-if="row.activo==1" class="label label-success">Activo</span>
                                                        <span v-else class="label label-danger">Inactivo</span>
                                                    </td>
                                                    <td align="right">
                                                        <button type="button" class="btn btn-icons btn-rounded  btn-round  btn-success btn-xs" @click="editModal = true; selectParte(row)" title="Modificar Datos">
                                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                            Modificar
                                                        </button>
                                                       
                                                         

                                                        <a class="btn btn-icons btn-rounded  btn-round btn-info btn-xs" v-if="row.activo==1"   v-bind:href="'../modelo/ver/'+ row.idparte" ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                            Ver</a>
                                                        
                                                    </td>
                                                </tr>
                                                <tr v-if="emptyResult">
                                                    <td colspan="9" rowspan="4" class="text-center h4">No encontrado</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" align="right">
                                            <pagination
                                                :current_page="currentPage"
                                                :row_count_page="rowCountPage"
                                                @page-update="pageUpdate"
                                                :total_users="totalParte"
                                                :page_range="pageRange"
                                                >
                                            </pagination>

                                            </td>
                                            </tr>
                                            </tfoot>
                                        </table> 
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
<script src="<?php echo base_url(); ?>/assets/js/appvue/appparte.js"></script>
