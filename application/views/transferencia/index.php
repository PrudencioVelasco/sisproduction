



 <!-- page content -->
      <div class="right_col" role="main">

        <div class="">
          
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Administrar Usuarios</h2>
                  
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
                                </div>
                                <div class="col-md-6">
                                    <input placeholder="Buscar" type="search" class="form-control" v-model="search.text" @keyup="searchUser" name="search">
                                </div>
                             </div>
                             <br>
                              <table class="table is-bordered is-hoverable">
                                 <thead class="text-white bg-dark" >
                                   
                                    <th class="text-white">Transferencia</th>
                                    <th class="text-white">Usuario</th>
                                    <th class="text-white">Fecha</th> 
                                    <th class="text-center text-white">Opción</th>
                                 </thead>
                                 <tbody class="table-light">
                                    <tr v-for="row in transferencias" class="table-default">
                                      
                                       <td>{{row.folio}}</td>
                                       <td>{{row.nombre}}</td>
                                       <td>{{row.fecharegistro}}</td> 
                                       <td align="right"> 
                                     <a class="btn btn-icons btn-rounded  btn-round btn-info btn-xs"  v-bind:href="'detalle/'+ row.idtransferancia" ><i class="fa fa-plus-circle" aria-hidden="true"></i>
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
                                                         :total_users="totalTransferencia"
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
                     <?php //include 'modal.php';?>
                  </div>




                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
      <!-- /page content -->

     <script src="<?php echo base_url();?>/assets/js/appvue/apptransferencia.js"></script> 