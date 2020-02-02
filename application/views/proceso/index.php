<!-- page content -->
 
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h4><strong>Administrar Procesos</strong></h4>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="appproceso">
                            <div class="container">
                                <div class="row">
                                     
                                            
                                        
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                  <button class="btn btn-round btn-primary" @click="addModal= true">Agregar</button>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control btn-round" v-model="search.text" @keyup="searchProceso" name="search">
                                            </div>
                                        
                                     
                                </div> 
                                <br>
                                <div class="row"> 
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table   class="table table-striped responsive-utilities jambo_table bulk_action"  >
                                            <thead>
                                                <tr class="table-dark">
                                                    <th  v-column-sortable:nombreproceso>Nombre del Proceso </th>
                                                    <th  v-column-sortable:pasos>Pasos a seguir </th>
                                                    <th  v-column-sortable:activo>Estatus </th>  
                                                    <th></th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="row in procesos" >
                                                    <td><strong>{{row.nombreproceso}}</strong></td> 
                                                    <td>{{row.pasos}}</td> 
                                                     <td >
                                                        <span v-if="row.activo==1" class="label label-success">Activo</span>
                                                        <span v-else class="label label-danger">Inactivo</span>
                                                    </td>
                                                    <td align="right">
                                                        <button type="button" class="btn btn-icons btn-rounded btn-success btn-xs" @click="editModal = true; selectProceso(row)" title="Modificar Datos">
                                                            <i class="fa  fa-edit"></i> Modificar
                                                        </button>
                                                        <a v-bind:href="'ver/'+ row.idproceso" class="btn btn-icons btn-rounded btn-info btn-xs " title="Agregar revisión">
                                                              <i class="fa  fa-eye"></i> Detalle
                                                        </a>
                                                    </td> 
                                                </tr>
                                                  <tr v-if="emptyResult">
                                       <td colspan="6" rowspan="4" class="text-center h4">No encontrado</td>
                                    </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" align="right">
                                            <pagination
                                                :current_page="currentPage"
                                                :row_count_page="rowCountPage"
                                                @page-update="pageUpdate"
                                                :total_users="totalProceso"
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


</div>

 <script src="<?php echo base_url(); ?>/assets/js/vue-column-sortable.js"></script>
<script data-my_var_2="<?php echo base_url() ?>" src="<?php echo base_url(); ?>/assets/js/appvue/appprocesos.js"></script>
