<!-- page content -->
<div class="right_col" role="main">
<div class="">
   <div class="clearfix"></div>
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_title">
               <h3>Generar una orden de salida</h3>
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="row">
                  <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class="form-group">
                        <h4>Número de Control: <strong><?php echo $detallesalida->numerosalida; ?></strong></h4>
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12 text-right">
                     <div class="form-group">
                        <h4>Cliente: <strong><?php echo $detallesalida->nombre; ?></strong></h4>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="form-group">
                        <h4>Número de Transferencia: <strong><?php echo $detallesalida->idsalida; ?></strong></h4>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Agregar parte</button>
                     <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h3 class="modal-title" id="exampleModalCenterTitle">Agregar número de parte</h3>
                                  
                              </div>
                              <div class="modal-body">
                              <div id="app">
                     <div class="row">
                     <div class="row">
                               <div class="col-md-6">
                               </div>
                               <div class="col-md-6">
                                   <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control btn-round" v-model="search.text" @keyup="searchParte" name="search">
                               </div>
                            </div>
<br/>
                        <table class="table table-striped responsive-utilities jambo_table bulk_action"  >
                           <thead class="text-white bg-dark" >
                              <th class="text-white">N. Tranferencia</th>
                              <th class="text-white">N. Parte</th>
                              <th class="text-white">N. modelo</th>
                              <th class="text-white">C. Pallet</th>
                              <th class="text-white">C. Cajas</th>
                              <th class="text-white text-right" align="right">Opción</th>
                           </thead>
                           <tbody class="table-light">
                              <tr v-for="row in partes" class="table-default">
                              <td>{{row.folio}}</td>
                                 <td>{{row.numeroparte}}</td>
                                 <td>{{row.modelo}}</td>
                                 <td><input type="number" name="pallet" placeholder="Pallet"></td>
                                 <td><input type="number" name="cajas" placeholder="Cajas"></td>
                                 <td align="right">
                                    <a class="btn btn-icons btn-rounded btn-info btn-xs" v-bind:href="'detalleSalida/'+ row.iddetalleparte" ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    Agregar</a>
                                 </td>
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
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                     
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
             
                  </div>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-striped responsive-utilities jambo_table bulk_action" >
                           <thead>
                              <tr>
                                 <th><strong>Número de parte</strong></th>
                                 <th><strong>C. Pallet</strong></th>
                                 <th><strong>C. Caja</strong></th>
                                 <th><strong>Revisión</strong></th>
                                 <?php if($detallesalida->finalizado == 0 ){ ?>
                                 <th></th>
                                 <?php } ?>
                              </tr>
                           </thead>
                           <?php
                              if (isset($detalleorden) && !empty($detalleorden)) {
                                  foreach ($detalleorden as $value) {
                                      // code...
                                      echo "<tr>";
                                      echo "<td>" . $value->numeroparte . "</td>";
                                      echo "<td>" . $value->pallet . "</td>";
                                      echo "<td>" . $value->caja . "</td>";
                                      echo "<td>" . $value->revision . "</td>";
                              
                                      ?>
                           <?php if($detallesalida->finalizado == 0 ){ ?>
                           <td align="right">
                              <input type="hidden" id="idordensalida" name="idordensalida" value="<?php echo $value->idordensalida; ?>"/>
                              <button type="button" id="btneliminar" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>
                              Quitar</button>
                           </td>
                           <?php } ?>
                           <?php
                              echo "</tr>";
                              }
                              }
                              ?>
                        </table>
                     </div>
                  </div>
                  <?php if($detallesalida->finalizado == 0 ){ ?>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="button" id="btnterminarorden" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>
                        Terminar orden</button>
                     </div>
                  </div>
                  <?php } ?>
                  <?php if($detallesalida->finalizado == 1 ){ ?>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="button" id="btnimprimir" class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i>
                        Imprimir Orden</button>
                     </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /page content -->
<script src="<?php echo base_url(); ?>/assets/js/appvue/appaddpartesalida.js"></script>