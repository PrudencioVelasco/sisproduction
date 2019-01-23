<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
   <h3 slot="head" >Agregar Usuario</h3>
   <div slot="body" class="row">
    <div class="col-md-12">
       <div class="text-danger" v-html="formValidate.smserror"> </div>
    </div>
      <div class="col-md-6">
       
        
         <div class="form-group">
            <label>* Usuario</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.usuario}" name="usuario" v-model="newUser.usuario" autcomplete="off">
            <div class="text-danger" v-html="formValidate.usuario"> </div>
         </div>
          <div class="form-group">
            <label>* Contraseña</label>
            <input type="password" class="form-control" :class="{'is-invalid': formValidate.password2}" name="password2" v-model="newUser.password2" autcomplete="off" >
            <div class="text-danger" v-html="formValidate.password2"></div>
         </div>
          <div class="form-group"> 
            <label>* Rol</label> 
             <select v-model="newUser.rol"  :class="{'is-invalid': formValidate.rol}"class="form-control">
                <option   v-for="option in roles" v-bind:value="option.id">
                {{ option.rol }}
              </option>
            </select>
              <div class="text-danger" v-html="formValidate.rol"></div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label>* Nombre</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.name}" name="name" v-model="newUser.name" autcomplete="off">
            <div class="text-danger" v-html="formValidate.name"></div>
         </div>
          <div class="form-group">
            <label>* Repita Contraseña</label>
            <input class="form-control" :class="{'is-invalid': formValidate.password1}" name="password1" v-model="newUser.password1" type="password" autcomplete="off">
            <div class="text-danger" v-html="formValidate.password1"></div>
         </div>
         
      </div>
   </div>
   <div slot="foot"> 
    <button class="btn btn-danger" @click="clearAll">Cancelar</button>
      <button class="btn btn-primary" @click="addUser">Agregar</button>
   </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
   <h3 slot="head" >Editar usuario</h3>
   <div slot="body" class="row">
     <div class="col-md-12">
       <div class="text-danger" v-html="formValidate.smserror"> </div>
    </div>
      <div class="col-md-6">
         
         <div class="form-group">
            <label>* Nombre</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.name}" name="name" v-model="chooseUser.name">
            <div class="text-danger" v-html="formValidate.name"> </div>
         </div>

           <div class="form-group">
            <label>* Rol</label> 
              <select class="form-control" v-model="chooseUser.idrol" >
                  <option v-for="option in roles"  :selected="option.id == chooseUser.idrol ? 'selected' : ''" :value="option.id" >
                      {{ option.rol }}
                  </option>
             </select>
         </div>
        
        
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label>* Usuario</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.usuario}" name="usuario" v-model="chooseUser.usuario" disabled="disabled">
            <div class="text-danger" v-html="formValidate.usuario"></div>
         </div>
          <div class="form-group">
            <label for="">* Estatus</label><br>
            <label class="radio-inline"> <input type="radio" name="status" v-model="chooseUser.activo" value="1" :checked="chooseUser.activo==1"> Activo </label>
            <label class="radio-inline">  <input type="radio" name="status" v-model="chooseUser.activo" value="0" :checked="chooseUser.activo==0"> Inactivo </label>
         </div>
        
      </div>
   </div>
   <div slot="foot">  
      <button class="btn btn-danger" @click="clearAll">Cancelar</button>
      <button class="btn btn-primary" @click="updateUser">Modificar</button>
   </div>
</modal>
<!--Modificar passeord model-->
 <modal v-if="passwordModal" @close="clearAll()">
   <h3 slot="head" >Cambiar Contraseña</h3>
   <div slot="body" class="row">
      <div class="col-md-6">
         <div class="form-group">
            <label>* Contraseña</label>
         

             <input type="password" class="form-control" :class="{'is-invalid': formValidate.password1}" name="password1" v-model="chooseUser.password1">
            <div class="text-danger" v-html="formValidate.password1"></div>

         </div>
     
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label>* Repita contraseña</label>
           <input type="password" class="form-control" :class="{'is-invalid': formValidate.password2}" name="password2" v-model="chooseUser.password2">
            <div class="text-danger" v-html="formValidate.password2"></div>
         </div>
         
        
      </div>
   </div>
   <div slot="foot">  
      <button class="btn btn-danger" @click="clearAll">Cancelar</button>
      <button class="btn btn-primary" @click="passwordupdateUser">Modificar</button>
   </div>
</modal>
