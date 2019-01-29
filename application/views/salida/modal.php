<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
   <h3 slot="head" >Agregar número de parte</h3>
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
   </div>
   <div slot="foot">
       <button class="btn btn-primary" @click="addSalida">Agregar</button>
      <button class="btn btn-danger" @click="clearAll">Cancelar</button>
   </div>
</modal>