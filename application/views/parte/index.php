 <!-- page content -->
      <div class="right_col" role="main">

        <div class="">

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h3>Módulo de Paking</h3>

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
                           <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-md-6">
                                  <button class="btn btn-round btn-primary" @click="addModal= true">Nueva parte</button>
                                   <a href="<?php echo site_url('parte/verEnviados') ?>" class="btn btn-round btn-default">Ver enviados</a>
     

 
                      </div>
                                <div class="col-md-6"></div>
                             </div>
                              <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control" v-model="search.text" @keyup="searchParte" name="search">
                                </div>
                             </div>
                             <br>
                              <table class="table table-striped responsive-utilities jambo_table bulk_action">
                                 <thead class="text-white bg-dark" >
                                    <th class="text-white">Número de parte</th>
                                    <th class="text-white">Cliente</th>
                                    <th class="text-white">Usuario registro</th>
                                    <th class="text-white">Estatus</th>
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
                                        <button type="button" class="btn btn-icons btn-rounded btn-success btn-xs" @click="editModal = true; selectParte(row)" title="Modificar Datos">
                                          <i class="fa fa-pencil-square" aria-hidden="true"></i>
 Modificar
                                                </button>
                <a class="btn btn-icons btn-rounded btn-info btn-xs" v-bind:href="'packing/'+ row.idparte" ><i class="fa fa-plus-circle" aria-hidden="true"></i>
 Agregar</a>




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
                     </div>
                     <?php include 'modal.php';?>
                  </div>




                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
      <!-- /page content -->

 <script src="<?php echo base_url();?>/assets/js/appvue/appparte.js"></script>
