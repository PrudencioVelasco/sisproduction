<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
   <h3 slot="head" >Agregar Usuario</h3>
   <div slot="body" class="row">
    <div class="col-md-12">
       <div class="text-danger" v-html="formValidate.smserror"> </div>
    </div>
      <div class="col-md-6">


         <div class="form-group">
            <label><font color="red">*</font> Usuario</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.usuario}" name="usuario" v-model="newUser.usuario" autcomplete="off">
            <div class="text-danger" v-html="formValidate.usuario"> </div>
         </div>
          <div class="form-group">
            <label><font color="red">*</font> Contraseña</label>
            <input type="password" class="form-control" :class="{'is-invalid': formValidate.password2}" name="password2" v-model="newUser.password2" autcomplete="off" >
            <div class="text-danger" v-html="formValidate.password2"></div>
         </div>
          <div class="form-group">
            <label><font color="red">*</font> Rol</label>

             <select v-model="newUser.rol"  :class="{'is-invalid': formValidate.rol}"class="form-control">
                <option value="" selected="">--Seleccionar--</option>
                <option   v-for="option in roles" v-bind:value="option.id">
                {{ option.rol }}
              </option>
            </select>
              <div class="text-danger" v-html="formValidate.rol"></div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><font color="red">*</font> Nombre</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.name}" name="name" v-model="newUser.name" autcomplete="off">
            <div class="text-danger" v-html="formValidate.name"></div>
         </div>
          <div class="form-group">
            <label><font color="red">*</font> Repita Contraseña</label>
            <input class="form-control" :class="{'is-invalid': formValidate.password1}" name="password1" v-model="newUser.password1" type="password" autcomplete="off">
            <div class="text-danger" v-html="formValidate.password1"></div>
         </div>
         <div class="form-group">
           <label><font color="red">*</font> Turno</label>
            <select v-model="newUser.idturno"  :class="{'is-invalid': formValidate.idturno}"class="form-control">
               <option value="" selected="">--Seleccionar--</option>
               <option   v-for="option in turnos" v-bind:value="option.idturno">
               {{ option.nombreturno }}
             </option>
           </select>
             <div class="text-danger" v-html="formValidate.idturno"></div>
        </div>
      </div>
   </div>
   <div slot="foot">
    <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
      <button class="btn btn-primary" @click="addUser"><i class='fa fa-floppy-o'></i> Agregar</button>
   </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
   <h3 slot="head" >Editar usuario</h3>
   <div slot="body" class="row">
     <div class="col-md-12">
       <div class="text-danger" v-html="formValidate.smserror"> </div>
    </div>
    <div class="row">
      <div class="col-md-6">

         <div class="form-group">
            <label><font color="red">*</font> Nombre</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.name}" name="name" v-model="chooseUser.name">
            <div class="text-danger" v-html="formValidate.name"> </div>
         </div>

           <div class="form-group">
            <label><font color="red">*</font> Rol</label>
              <select class="form-control" v-model="chooseUser.idrol" >
                  <option v-for="option in roles"  :selected="option.id == chooseUser.idrol ? 'selected' : ''" :value="option.id" >
                      {{ option.rol }}
                  </option>
             </select>
         </div>


      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><font color="red">*</font> Usuario</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.usuario}" name="usuario" v-model="chooseUser.usuario" disabled="disabled">
            <div class="text-danger" v-html="formValidate.usuario"></div>
         </div>

            <div class="form-group">
                   

                <label for=""><font color="red">*</font> Estatus</label><br>
                <div class="demo-radio-button">  
                                <input name="group5" type="radio" id="radio_31" class="with-gap radio-col-green" v-model="chooseUser.activo" value="1" :checked="chooseUser.activo==1" />
                                <label for="radio_31">ACTIVO</label>
                                <input name="group5" type="radio" id="radio_32" class="with-gap radio-col-red"  v-model="chooseUser.activo" value="0" :checked="chooseUser.activo==0" />
                                <label for="radio_32">INACTIVO</label>
                            </div>
            </div> 

      </div>
      </div>

<div class="row">

<div class="col-md-6">
         <div class="form-group">
            <label><font color="red">*</font> Turno</label>
            <select class="form-control" v-model="chooseUser.idturno" >
                  <option v-for="option in turnos"  :selected="option.idturno == chooseUser.idturno ? 'selected' : ''" :value="option.idturno" >
                      {{ option.nombreturno }}
                  </option>
             </select>
         </div> 

      </div>
      
</div>

   </div>
   <div slot="foot">
      <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
      <button class="btn btn-primary" @click="updateUser"><i class='fa fa-edit'></i> Modificar</button>
   </div>
</modal>
<!--Modificar passeord model-->
 <modal v-if="passwordModal" @close="clearAll()">
   <h3 slot="head" >Cambiar Contraseña</h3>
   <div slot="body" class="row">
      <div class="col-md-6">
         <div class="form-group">
            <label><font color="red">*</font> Contraseña</label>


             <input type="password" class="form-control" :class="{'is-invalid': formValidate.password1}" name="password1" v-model="chooseUser.password1">
            <div class="text-danger" v-html="formValidate.password1"></div>

         </div>

      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><font color="red">*</font> Repita contraseña</label>
           <input type="password" class="form-control" :class="{'is-invalid': formValidate.password2}" name="password2" v-model="chooseUser.password2">
            <div class="text-danger" v-html="formValidate.password2"></div>
         </div>


      </div>
   </div>
   <div slot="foot">
      <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
      <button class="btn btn-primary" @click="passwordupdateUser"><i class='fa fa-edit'></i> Modificar</button>
   </div>
</modal>
