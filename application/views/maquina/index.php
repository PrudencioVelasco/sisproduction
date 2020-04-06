
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3> <strong>ADMINISTRAR MAQUINAS</strong> </h3>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="applinea">
                            <div class="container">
                                <div class="row">



                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                  <button class="btn btn-round btn-primary" @click="addModal= true"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control btn-round" v-model="search.text" @keyup="searchMaquina" name="search">
                                            </div>


                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table   class="table table-striped responsive-utilities jambo_table bulk_action"  >
                                            <thead>
                                                <tr class="table-dark">
                                                    <th  v-column-sortable:nombremaquina>Nombre de la Maquina </th>
                                                    <th  v-column-sortable:activo>Estatus </th>
                                                    <td align="right" ><strong>Opción </strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="row in maquinas" >
                                                    <td><strong>{{row.nombremaquina}}</strong></td>
                                                     <td >
                                                        <span v-if="row.activo==1" class="label label-success">Activo</span>
                                                        <span v-else class="label label-danger">Inactivo</span>
                                                    </td>
                                                    <td align="right">
                                                        <button type="button" class="btn btn-info" @click="editModal = true; selectMaquina(row)" title="Modificar Datos">
                                                           Editar
                                                        </button>
                                                    </td>
                                                </tr>
                                                  <tr v-if="emptyResult">
                                       <td colspan="3"   class="text-center h4">No encontrado</td>
                                    </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" align="right">
                                            <pagination
                                                :current_page="currentPage"
                                                :row_count_page="rowCountPage"
                                                @page-update="pageUpdate"
                                                :total_users="totalMaquina"
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
<script data-my_var_1="<?php echo base_url() ?>" src="<?php echo base_url(); ?>/assets/js/appvue/appmaquina.js"></script>
