<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
   <h3 slot="head" >Agregar Cliente</h3>
   <div slot="body" class="row">
      <div class="col-md-12">
         <div class="form-group">
            <label>* Nombre del cliente</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombre}" name="nombre" v-model="newClient.nombre" autcomplete="off">
            <div class="text-danger" v-html="formValidate.nombre"> </div>
         </div> 
          
      </div> 
   </div>
   <div slot="foot">
      <button class="btn btn-danger" @click="clearAll">Cancelar</button>
      <button class="btn btn-primary" @click="addClient">Agregar</button>
   </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
   <h3 slot="head" >Editar Cliente</h3>
   <div slot="body" class="row">
      <div class="col-md-12">
         <div class="form-group">
            <label>* Nombre del cliente</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombre}" name="nombre" v-model="chooseClient.nombre">
            <div class="text-danger" v-html="formValidate.nombre"> </div>
         </div>
          <div class="form-group">
            <label for="">* Estatus</label><br>
            <label class="radio-inline"> <input type="radio" name="status" v-model="chooseClient.activo" value="1" :checked="chooseClient.activo==1"> Activo </label>
            <label class="radio-inline">  <input type="radio" name="status" v-model="chooseClient.activo" value="0" :checked="chooseClient.activo==0"> Inactivo </label>
         </div>
        
      </div>
     
   </div>
   <div slot="foot"> 
    <button class="btn btn-danger" @click="clearAll">Cancelar</button>
      <button class="btn btn-primary" @click="updateClient">Modificar</button>
   </div>
</modal>
