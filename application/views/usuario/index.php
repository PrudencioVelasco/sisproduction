



<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                         <h3><strong>ADMNISTRAR USUARIOS</strong></h3>

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
                                                <button class="btn btn-round btn-primary" @click="addModal= true"><i class='fa fa-plus'></i> Nuevo Usuario</button>
                                                <a  href="<?= base_url('/Rol/') ?>" class="btn btn-round btn-default">Rol</a>


                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <input placeholder="Buscar" type="search" class="form-control" v-model="search.text" @keyup="searchUser" name="search">
                                            </div>
                                        </div>
                                        <br>
                                        <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                            <thead class="text-white bg-dark" >

                                            <th class="text-white" v-column-sortable:usuario>Usuario </th>
                                            <th class="text-white" v-column-sortable:name>Nombre </th>
                                            <th class="text-white" v-column-sortable:rolnombre>Rol </th>
                                            <th class="text-white" v-column-sortable:activo>Estatus </th>
                                            <th class="text-center text-white">Opción </th>
                                            </thead>
                                            <tbody class="table-light">
                                                <tr v-for="user in users" class="table-default">

                                                    <td><strong>{{user.usuario}}</strong></td>
                                                    <td>{{user.name}}</td>
                                                    <td>{{user.rolnombre}}</td>
                                                    <td>
                                                        <span v-if="user.activo==1" class="label label-success">Activo</span>
                                                        <span v-else class="label label-danger">Inactivo</span>
                                                    </td>
                                                    <td align="right">


                                                        <button type="button" class="btn btn-icons btn-rounded btn-success btn-sm" @click="editModal = true; selectUser(user)" title="Modificar Datos">
                                                          <i class='fa fa-edit'></i> Editar
                                                        </button>
                                                        <button type="button" class="btn btn-icons btn-rounded btn-primary btn-sm" @click="passwordModal = true; selectUser(user)">
                                                            <i class='fa fa-key'></i> Cambiar Contraseña
                                                        </button>

                                                    </td>
                                                </tr>
                                                <tr v-if="emptyResult">
                                                    <td colspan="5" class="text-center h4">No encontrado</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" align="right">
                                            <pagination
                                                :current_page="currentPage"
                                                :row_count_page="rowCountPage"
                                                @page-update="pageUpdate"
                                                :total_users="totalUsers"
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

 <script src="<?php echo base_url(); ?>/assets/js/vue-column-sortable.js"></script>
<script data-my_var_1="<?php echo base_url() ?>" src="<?php echo base_url(); ?>/assets/js/appvue/app.js"></script>
