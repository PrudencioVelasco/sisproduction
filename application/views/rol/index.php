<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3><strong>ADMINISTRAR ROLES</strong></h2>

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
                                                <button class="btn btn-round btn-primary" @click="addModal= true"><i class='fa fa-plus'></i> Nuevo Rol</button>
                                                <a  href="<?= base_url('/User/') ?>" class="btn btn-round btn-default">Usuarios</a>
                                                <a  href="<?= base_url('/Permiso/') ?>" class="btn btn-round btn-default">Permisos</a>

                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <input placeholder="Buscar" type="search" autofocus ="autofocus" class="form-control" v-model="search.text" @keyup="searchUser" name="search">
                                            </div>
                                        </div>
                                        <br>
                                        <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                            <thead class="text-white bg-dark" >
                                            <th class="text-white" v-column-sortable:rol>Rol </th>

                                            <th class="text-right text-white" >Opción </th>
                                            </thead>
                                            <tbody class="table-light">
                                                <tr v-for="rol in roles" class="table-default">
                                                    <td><strong>{{rol.rol}}</strong></td>
                                                    <td align="right">
                                                        <button type="button" class="btn btn-icons btn-sm btn-rounded btn-success" @click="editModal = true; selectRol(rol)" title="Modificar Datos"><i class='fa fa-edit'></i>
                                                           Editar
                                                        </button>

                                                        <a v-bind:href="'rolpermisos/'+ rol.id" class="btn btn-icons btn-sm btn-rounded btn-info"><i class='fa fa-eye'></i> Detalle</a>


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
                                                :total_users="totalRoles"
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
 <script src="<?php echo base_url(); ?>/assets/js/vue-column-sortable.js"></script>
<script data-my_var_1="<?php echo base_url() ?>" src="<?php echo base_url(); ?>/assets/js/appvue/approl.js"></script>
