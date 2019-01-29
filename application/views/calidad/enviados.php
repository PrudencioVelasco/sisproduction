<div class="right_col" role="main">
 <div class="">
   <div class="col-md-12 col-sm-12 col-xs-12">
     <div class="x_panel">
       <div class="x_title">
         <h3>Partes enviadas</h3>
         <div class="clearfix"></div>
       </div>
       <div class="x_content">
        <div id="app">
         <div class="row">
          <div class="col-md-6">
            
          </div>
           <div class="col-md-6">
             <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control" v-model="search.text" @keyup="searchDetalleStatus" name="search">
           </div>
         </div>

         <table class="table">
          <thead class="text-white bg-dark" >
           <th class="text-white">Número de parte</th>
           <th class="text-white">Estatus</th>
           <th class="text-white">Pallet</th>
           <th class="text-white">Cantidad</th>
           <th class="text-white">Fecha</th>
         </thead>
         <tbody  >
           <tr v-for="row in detallestatus" class="table-default">
            <td>{{row.numeroparte}} </td>
            <td><h6 style="color:green" v-if="row.idestatus==4"><strong>Enviado</strong></h6></td>
             <td>{{row.pallet}} </td>
             <td>{{row.cantidad}} </td>
             <td>{{row.fecharegistro}} </td>
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




<script src="<?php echo base_url();?>/assets/js/appvue/appenviadoscalidad.js"></script>