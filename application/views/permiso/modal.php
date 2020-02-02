<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
   <h3 slot="head" >Agregar Permiso</h3>
   <div slot="body" class="row">
      <div class="col-md-12">
         <div class="form-group">
            <label><font color="red">*</font> Permiso</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.uri}" name="rol" v-model="newPermiso.uri" autcomplete="off">
            <div class="text-danger" v-html="formValidate.uri"> </div>
         </div> 
      </div> 
      <div class="col-md-12">
         <div class="form-group">
            <label><font color="red">*</font> Descripción</label> 
            <textarea type="text" class="form-control" :class="{'is-invalid': formValidate.description}" name="description" v-model="newPermiso.description" >
               
            </textarea>
            <div class="text-danger" v-html="formValidate.description"> </div>
         </div>
      </div> 
   </div>
   <div slot="foot">
      <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
      <button class="btn btn-primary" @click="addPermiso"><i class='fa fa-floppy-o'></i> Agregar</button>
   </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
   <h3 slot="head" >Editar Permiso</h3>
   <div slot="body" class="row">
      <div class="col-md-12">
         <div class="form-group">
            <label><font color="red">*</font> Permiso</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.uri}" name="uri" v-model="choosePermiso.uri">
            <div class="text-danger" v-html="formValidate.uri"> </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="form-group">
            <label><font color="red">*</font> Descripción</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.uri}" name="description" v-model="choosePermiso.description">
            <div class="text-danger" v-html="formValidate.description"> </div>
         </div>
      </div>
   </div>
   <div slot="foot">
      <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
      <button class="btn btn-primary" @click="updatePermiso"><i class='fa fa-edit'></i> Modificar</button>
   </div>
</modal>
