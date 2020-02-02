<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
   <h3 slot="head" >Agregar Rol</h3>
   <div slot="body" class="row">
      <div class="col-md-12">
         <div class="form-group">
            <label><font color="red">*</font> Rol</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.rol}" name="rol" v-model="newRol.rol" autcomplete="off">
            <div class="text-danger" v-html="formValidate.rol"> </div>
         </div>
          
      </div> 
   </div>
   <div slot="foot">
       <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
      <button class="btn btn-primary" @click="addRol"><i class='fa fa-floppy-o'></i> Agregar</button>
   </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
   <h3 slot="head" >Editar Rol</h3>
   <div slot="body" class="row">
      <div class="col-md-12">
         <div class="form-group">
            <label><font color="red">*</font> Rol</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.rol}" name="rol" v-model="chooseRol.rol">
            <div class="text-danger" v-html="formValidate.rol"> </div>
         </div>
        
        
      </div>
     
   </div>
   <div slot="foot"> 
     <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
      <button class="btn btn-primary" @click="updateRol"><i class='fa fa-edit'></i> Modificar</button>
   </div>
</modal>
