<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >Agregar Motivo</h3>
    <div slot="body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><font color="red">*</font> Motivo de rechazo</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.motivo}" name="motivo" v-model="newMotivo.motivo" autcomplete="off">
                           <div class="text-danger" v-html="formValidate.motivo"> </div>
                </div> 
            </div>  
            
        </div> 
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
            <label><font color="red">*</font> Proceso</label>
             <select v-model="newMotivo.idproceso"  :class="{'is-invalid': formValidate.idproceso}" class="form-control">
                <option   v-for="option in procesos" v-bind:value="option.idproceso">
                {{ option.nombreproceso }}
              </option>
            </select>
              <div class="text-danger" v-html="formValidate.idproceso"></div>
         </div>
            </div>  
            
        </div> 

    </div>
    <div slot="foot">
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
        <button class="btn btn-primary" @click="addMotivo">Agregar</button>
    </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Editar Motivo</h3>
    <div slot="body"  >
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><font color="red">*</font> Motivo</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.motivo}" name="motivo" v-model="chooseMotivo.motivo">
                           <div class="text-danger" v-html="formValidate.nombreposicion"> </div>
                </div> 
            </div>   
        </div>  
        <div class="row">
            <div class="col-md-12">
          <div class="form-group">
            <label><font color="red">*</font> Proceso</label>
              <select class="form-control" v-model="chooseMotivo.idproceso" >
                  <option v-for="option in procesos"  :selected="option.idproceso == chooseMotivo.idproceso ? 'selected' : ''" :value="option.idproceso" >
                      {{ option.nombreproceso }}
                  </option>
             </select>
         </div>
         </div>
         </div>
         
        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group">
                    <label for=""><font color="red">*</font> Estatus</label><br>
                    <label class="radio-inline"> 
                    <input type="radio" name="activo" v-model="chooseMotivo.activo" value="1" :checked="chooseMotivo.activo==1"> Activo 
                    </label>
                    <label class="radio-inline">  
                    <input type="radio" name="activo" v-model="chooseMotivo.activo" value="0" :checked="chooseMotivo.activo==0"> Inactivo 
                    </label>
                </div>
            </div>
        </div>

    </div>
    <div slot="foot"> 
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
        <button class="btn btn-primary" @click="updateMotivo">Modificar</button>
    </div>
</modal>
