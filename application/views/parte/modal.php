<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
   <h3 slot="head" >Agregar número de parte</h3>
   <div slot="body" class="row">
      <div class="col-md-12">
         <div class="text-danger" v-html="formValidate.smserror"> </div>
         <div class="form-group">
            <label>* Número de parte</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.numeroparte}" name="nombre" v-model="newParte.numeroparte" autcomplete="off">
            <div class="text-danger" v-html="formValidate.numeroparte"> </div>
         </div> 
          
      </div> 
         <div class="col-md-12"> 
         <div class="form-group">
            <label>* Cliente</label>
             <select v-model="newParte.idcliente"  :class="{'is-invalid': formValidate.idcliente}"class="form-control">
                <option   v-for="option in clientes" v-bind:value="option.idcliente">
                {{ option.nombre }}
              </option>
            </select>
              <div class="text-danger" v-html="formValidate.idcliente"></div>
         </div>
      </div>
   </div>
   <div slot="foot">
       <button class="btn btn-primary" @click="addParte">Agregar</button>
      <button class="btn btn-danger" @click="clearAll">Cancelar</button> 
   </div>
</modal>

<!--update modal--> 
<modal v-if="editModal" @close="clearAll()">
   <h3 slot="head" >Modificar número de parte</h3>
   <div slot="body" >

        <div class="row">
         <div class="form-group col-md-12">
            <div class="text-danger" v-html="formValidate.smserror"> </div>
            <label>* Número parte Caja</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.numeroparte }" name="Precio" v-model="chooseParte.numeroparte " autcomplete="off" placeholder="Número parte Caja" >
            <div class="text-danger" v-html="formValidate.numeroparte "> </div>
         </div> 
      </div>


    <div class="row">
      <div class="col-md-12">

         <div class="form-group">
            <label>* Cliente</label>
             
             <select class="form-control" v-model="chooseParte.idcliente" >
                  <option v-for="option in clientes"  :selected="option.idcliente === chooseParte.idcliente ? 'selected' : ''" :value="option.idcliente" >
                      {{ option.nombre }}
                  </option>
             </select>
         </div>
      </div>
   </div>
    <div class="row">
      <div class="col-md-12">
<div class="form-group">
            <label for="">* Estatus</label><br>
            <label class="radio-inline"> <input type="radio" name="activo" v-model="chooseParte.activo" value="1" :checked="chooseParte.activo==1"> Activo </label>
            <label class="radio-inline">  <input type="radio" name="activo" v-model="chooseParte.activo" value="0" :checked="chooseParte.activo==0"> Inactivo </label>
         </div>
      </div>
   </div>

    
    
     
   </div>
   <div slot="foot">
    <button class="btn btn-danger" @click="clearAll">Cancelar</button> 
   </div>
</modal>
