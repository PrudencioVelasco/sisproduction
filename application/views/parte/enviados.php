 <!-- page content -->


 <div class="right_col" role="main">
   <div class="">
     <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="x_panel">
                   <div class="x_title">
                     <h3>Enviados a Calidad</h3>

                     <div class="clearfix"></div>
                   </div>

                   <div class="x_content">
<div id="app">
                     <transition
                        enter-active-class="animated fadeInLeft"
                        leave-active-class="animated fadeOutRight">
                        <div class="notification is-success text-center px-5 top-middle" v-if="successMSG" @click="successMSG = false">{{successMSG}}</div>
                     </transition>
                     <div class="row">
                         <div class="col-md-6">
                            <label>Botones</label>


                         </div>
                         <div class="col-md-6"></div>
                      </div>
                       <div class="row">
                         <div class="col-md-6">
                         </div>
                         <div class="col-md-6">
                             <input placeholder="Buscar" type="search" class="form-control" v-model="search.text" @keyup="searchDetalleStatus" name="search">
                         </div>
                      </div>

                     <table class="table">
                        <thead class="text-white bg-dark" >
                           <th class="text-white">Número de parte</th>
                           <th class="text-white">Estatus</th>
                           <th class="text-white">Pallet</th>
                           <th class="text-white">Cantidad</th>

                           <th class="text-white text-right" align="right">Opción</th>
                        </thead>
                        <tbody  >
                           <tr v-for="row in detallestatus" class="table-default">
                              <td>{{row.numeroparte}} </td>
                               <td>
                                 <h6 style="color:green" v-if="row.idestatus==1"><strong>{{row.nombrestatus}}</strong></h6>
                                 <h1 v-else>{{row.nombrestatus}}</h1> </td>
                                <td>{{row.pallet}} </td>
                                 <td>{{row.cantidad}} </td>
                              <td> </td>
                              <td >
                              </td>
                              <td align="right">
                                <div class="btn-group">
                                <button type="button" class="btn btn-danger">Action</button>
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="#">Action</a>
                                  </li>
                                  <li><a href="#">Another action</a>
                                  </li>
                                  <li><a href="#">Something else here</a>
                                  </li>
                                  <li class="divider"></li>
                                  <li><a href="#">Separated link</a>
                                  </li>
                                </ul>
                              </div>
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
                                                :total_users="totalDetalleStatus"
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
               </div>
   </div>
 </div>




       <script src="<?php echo base_url();?>/assets/js/appvue/appenviados.js"></script>
