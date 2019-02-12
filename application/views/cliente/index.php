<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Administrar Cliente</h2>

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
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-round btn-primary" @click="addModal= true">Nuevo Cliente</button>


                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <input placeholder="Buscar" type="search" class="form-control" v-model="search.text" @keyup="searchClient" name="search">
                                            </div>
                                        </div>
                                        <br>
                                        <table class="table is-bordered is-hoverable">
                                            <thead class="text-white bg-dark" >
                                            <th class="text-white">RFC</th>
                                            <th class="text-white">Nombre del cliente</th>
                                            <th class="text-white">Abreviatura</th>
                                            <th class="text-white">Dirección</th>
                                            <th class="text-white">Estatus</th>
                                            <th class="text-white">Opción</th>
                                            </thead>
                                            <tbody class="table-light">
                                                <tr v-for="row in clientes" class="table-default">
                                                    <td>{{row.rfc}}</td> 
                                                    <td>{{row.nombre}}</td> 
                                                    <td>{{row.abreviatura}}</td> 
                                                    <td>{{row.direccion}}</td> 
                                                    <td >
                                                        <span v-if="row.activo==1" class="label label-success">Activo</span>
                                                        <span v-else class="label label-danger">Inactivo</span>
                                                    </td>
                                                    <td align="">
                                                        <button type="button" class="btn btn-icons btn-rounded btn-success" @click="editModal = true; selectRol(row)" title="Modificar Datos">
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
                                                :total_users="totalClient"
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

<script src="<?php echo base_url(); ?>/assets/js/appvue/appclient.js"></script> 