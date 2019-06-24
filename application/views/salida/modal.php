<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
   <h3 slot="head" >Agregar nueva salida</h3>
   <div slot="body">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
         <div class="form-group">
            <label>* Cliente</label>
             <select v-model="newSalida.idcliente" class="form-control"  :class="{'is-invalid': formValidate.idcliente}"class="form-control">
                <option   v-for="option in clientes" v-bind:value="option.idcliente">
                {{ option.nombre }}
              </option>
            </select>
              <div class="text-danger" v-html="formValidate.idcliente"></div>
         </div>
      </div>
      </div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
         <div class="form-group">
            <label>P.O.</label>
              <input type="text" v-model="newSalida.po" class="form-control"  :class="{'is-invalid': formValidate.po}" name="po"> 
              <div class="text-danger" v-html="formValidate.po"></div>
         </div>
      </div>
      </div>

        <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
         <div class="form-group">
            <label>Notas</label>
            <textarea v-model="newSalida.notas" class="form-control"  :class="{'is-invalid': formValidate.notas}"rows="3"></textarea> 
              <div class="text-danger" v-html="formValidate.notas"></div>
         </div>
      </div>
      </div>

   </div>
   <div slot="foot">
       <button class="btn btn-primary" @click="addSalida">Agregar</button>
      <button class="btn btn-danger" @click="clearAll">Cancelar</button>
   </div>
</modal>

<modal v-if="editModal" @close="clearAll()">
   <h3 slot="head" >Editar usuario</h3>
    <div slot="body">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
         <div class="form-group">
            <label>* Cliente</label>
             <select v-model="chooseSalida.idcliente" class="form-control"  :class="{'is-invalid': formValidate.idcliente}"class="form-control">
                <option   v-for="option in clientes" :selected="option.idcliente == chooseSalida.idcliente ? 'selected' : ''" v-bind:value="option.idcliente">
                {{ option.nombre }}
              </option>
            </select>
              <div class="text-danger" v-html="formValidate.idcliente"></div>
         </div>
      </div>
      </div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
         <div class="form-group">
            <label>P.O.</label>
              <input type="text" v-model="chooseSalida.po" class="form-control"  :class="{'is-invalid': formValidate.po}" name="po"> 
              <div class="text-danger" v-html="formValidate.po"></div>
         </div>
      </div>
      </div>

        <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12 ">
         <div class="form-group">
            <label>Notas</label>
            <textarea v-model="chooseSalida.notas" class="form-control"  :class="{'is-invalid': formValidate.notas}"rows="3"></textarea> 
              <div class="text-danger" v-html="formValidate.notas"></div>
         </div>
      </div>
      </div>

   </div>
   <div slot="foot">
      <button class="btn btn-danger" @click="clearAll">Cancelar</button>
      <button class="btn btn-primary" @click="updateSalida">Modificar</button>
   </div>
</modal>
