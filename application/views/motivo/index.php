<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Administrar Motivos de Rechazo</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <div id="app">
                            <div class="container">
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-round btn-primary" @click="addModal= true">Nuevo motivo</button>


                                            </div>
                                            <div class="col-md-6">
                                                
                                                <input placeholder="Buscar" type="search" class="form-control  btn-round " v-model="search.text" @keyup="searchMotivo" name="search">
                                                
                                            </div>
                                        </div>  
                                       <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                            <thead class="text-white bg-dark" >
                                            <th class="text-white" v-column-sortable:motivo>Motivo</th>
                                            <th class="text-white" v-column-sortable:nombreproceso>Proceso</th>
                                             <th class="text-white" v-column-sortable:activo>Estatus</th>
                                             <td align="right" class="text-white"><strong>Opción</strong></td>
                                            </thead>
                                            <tbody class="table-light">
                                                <tr v-for="row in motivos" class="table-default">
                                                    <td>{{row.motivo}}</td> 
                                                    <td><strong>{{row.nombreproceso}}</strong></td> 
                                                    <td >
                                                        <span v-if="row.activo==1" class="label label-success">Activo</span>
                                                        <span v-else class="label label-danger">Inactivo</span>
                                                    </td>
                                                    <td align="right">
                                                        <button type="button" class="btn btn-icons btn-rounded btn-info btn-xs" @click="editModal = true; selectMotivo(row)" title="Modificar Datos">
                                                            Editar
                                                        </button> 

                                                    </td>
                                                </tr>
                                                <tr v-if="emptyResult">
                                                    <td colspan="4" rowspan="4" class="text-center h4">No encontrado</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4" align="right">
                                            <pagination
                                                :current_page="currentPage"
                                                :row_count_page="rowCountPage"
                                                @page-update="pageUpdate"
                                                :total_users="totalMotivo"
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
<script data-my_var_1="<?php echo base_url() ?>" src="<?php echo base_url(); ?>/assets/js/appvue/appmotivorechazo.js"></script> 