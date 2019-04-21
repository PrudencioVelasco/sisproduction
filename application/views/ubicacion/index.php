<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Administrar Ubicaciones</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <div id="app">
                            <div class="container">
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-round btn-primary" @click="addModal= true">Nueva ubicación</button>


                                            </div>
                                            <div class="col-md-6">
                                                
                                                <input placeholder="Buscar" type="search" class="form-control  btn-round " v-model="search.text" @keyup="searchUbicacion" name="search">
                                                
                                            </div>
                                        </div>  
                                        <table class="table is-bordered is-hoverable">
                                            <thead class="text-white bg-dark" >
                                            <th class="text-white">Ubicación</th>
                                            <th class="text-white">Estatus</th>
                                            <th class="text-white">Opción</th>
                                            </thead>
                                            <tbody class="table-light">
                                                <tr v-for="row in ubicaciones" class="table-default">
                                                    <td>{{row.nombreposicion}}</td> 
                                                    <td >
                                                        <span v-if="row.activo==1" class="label label-success">Activo</span>
                                                        <span v-else class="label label-danger">Inactivo</span>
                                                    </td>
                                                    <td align="">
                                                        <button type="button" class="btn btn-icons btn-rounded btn-success" @click="editModal = true; selectUbicacion(row)" title="Modificar Datos">
                                                            <i class="fa  fa-edit"></i>
                                                        </button> 

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
                                                :total_users="totalUbicacion"
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

<script src="<?php echo base_url(); ?>/assets/js/appvue/appubicacion.js"></script> 