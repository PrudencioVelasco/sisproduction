<!-- page content -->
<script type="text/javascript">
    var data_score = '<?php echo $idmodelo; ?>';
</script>
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h4><strong><?php echo $text; ?></strong></h4>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                 <button class="btn btn-round btn-primary" @click="addModal= true"><i class='fa fa-plus'></i> Agregar Revisión</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                              </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control btn-round" v-model="search.text" @keyup="searchRevision" name="search">
                                            </div>
                                        </div>


                                <br>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table   class="table table-striped responsive-utilities jambo_table bulk_action"  >
                                            <thead>
                                                <tr class="table-dark">
                                                    <th  v-column-sortable:descripcion>Revisión </th>
                                                    <th  v-column-sortable:activo>Estatus </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="row in revisiones" >
                                                    <td><strong>{{row.descripcion}}</strong></td>
                                                    <td>
                                                        <span v-if="row.activo==1" class="label label-success">Activo</span>
                                                        <span v-else class="label label-danger">Inactivo</span>
                                                    </td>
                                                    <td align="right">
                                                        <button type="button" class="btn btn-icons  btn-success btn-sm" @click="editModal = true; selectRevision(row)" title="Modificar Datos">
                                                            <i class="fa  fa-edit"></i> Modificar
                                                        </button>
                                                          <button type="button" class="btn btn-icons  btn-danger btn-sm" @click="deleteRevision(row.idrevision)" title="Modificar Datos">
                                                            <i class="fa fa-trash" aria-hidden="true"></i></i> Eliminar
                                                        </button>

                                                        <a v-bind:href="'../../cantidad/ver/'+ row.idrevision" class="btn btn-icons  btn-info btn-sm " title="Agregar cantidad">
                                                              <i class="fa  fa-plus"></i> A. Cantidad
                                                        </a>
                                                    </td>
                                                </tr>
                                                 <tr v-if="emptyResult">
                                       <td colspan="2" rowspan="4" class="text-center h4">No encontrado</td>
                                    </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" align="right">
                                            <pagination
                                                :current_page="currentPage"
                                                :row_count_page="rowCountPage"
                                                @page-update="pageUpdate"
                                                :total_users="totalRevision"
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
<script data-my_var_2="<?php echo $idmodelo; ?>" data-my_var_1="<?php echo base_url() ?>" src="<?php echo base_url(); ?>/assets/js/appvue/apprevision.js"></script>
