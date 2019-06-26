<!-- page content -->
<script type="text/javascript">
    var data_score = '<?php echo $idparte; ?>';
</script>
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h4><strong><?php echo $paso; ?></strong></h4>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="appmodelo">
                            <div class="container">
                                <div class="row">
                                     
                                            
                                        
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                  <button class="btn btn-round btn-primary" @click="addModal= true">Agregar</button>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control btn-round" v-model="search.text" @keyup="searchModelo" name="search">
                                            </div>
                                        
                                     
                                </div> 
                                <br>
                                <div class="row"> 
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table   class="table table-striped responsive-utilities jambo_table bulk_action"  >
                                            <thead>
                                                <tr class="table-dark">
                                                    <th  v-column-sortable:descripcion>Modelo</th>
                                                    <th  v-column-sortable:nombrehoja>Nom. Caja</th>
                                                    <th  v-column-sortable:fulloneimpresion>Full/One/Impresion</th>
                                                    <th  v-column-sortable:colorlinea>Liner Color</th>
                                                    <th  v-column-sortable:color>Color</th> 
                                                    <th></th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="row in modelos" >
                                                    <td><strong>{{row.descripcion}}</strong></td> 
                                                    <td>{{row.nombrehoja}}</td> 
                                                    <td>{{row.fulloneimpresion}}</td> 
                                                    <td>{{row.colorlinea}}</td> 
                                                    <td>{{row.color}}</td> 
                                                    <td align="right">
                                                        <button type="button" class="btn btn-icons btn-rounded btn-success btn-xs" @click="editModal = true; selectModelo(row)" title="Modificar Datos">
                                                            <i class="fa  fa-edit"></i> 
                                                        </button>
                                                        <a v-bind:href="'../../revision/ver/'+ row.idmodelo" class="btn btn-icons btn-rounded btn-info btn-xs " title="Ver">
                                                              <i class="fa  fa-eye"></i> 
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
                                                :total_users="totalModelo"
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

<script src="https://cdn.jsdelivr.net/npm/vue-column-sortable@0.0.1/dist/vue-column-sortable.js"></script>
<script data-my_var_1="<?php echo $idparte; ?>" src="<?php echo base_url(); ?>/assets/js/appvue/appmodelo.js"></script>
