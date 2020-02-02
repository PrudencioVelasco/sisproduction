<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >Agregar nuevo Proceso</h3>
    <div slot="body"  > 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="text-danger" v-html="formValidate.msgerror"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="form-group">
                    <label><font color="red">*</font> Nombre del proceso</label>
                    <input type="text" v-model="newProceso.nombreproceso" class="form-control"  :class="{'is-invalid': formValidate.nombreproceso}" name="po"> 
                           <div class="text-danger" v-html="formValidate.nombreproceso"></div>
                </div>
            </div> 
        </div> 
    </div>
    <div slot="foot">
        <button class="btn btn-primary" @click="addProceso">Agregar</button>
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
    </div>
</modal>
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Editar Proceso</h3>
    <div slot="body"> 
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="text-danger" v-html="formValidate.msgerror"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="form-group">
                    <label><font color="red">*</font> Nombre del proceso</label>
                    <input type="text" v-model="chooseProceso.nombreproceso" class="form-control"  :class="{'is-invalid': formValidate.nombreproceso}" name="po"> 
                           <div class="text-danger" v-html="formValidate.nombreproceso"></div>
                </div>
            </div> 
        </div> 

         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                 <div class="form-group">
                <label for="">* Estatus</label><br>
                <label class="radio-inline"> <input type="radio" name="status" v-model="chooseProceso.activo" value="1" :checked="chooseProceso.activo==1"> Activo </label>
                <label class="radio-inline">  <input type="radio" name="status" v-model="chooseProceso.activo" value="0" :checked="chooseProceso.activo==0"> Inactivo </label>
             </div>
            </div> 
        </div> 

        
    </div>
    <div slot="foot">
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
        <button class="btn btn-primary" @click="updateProceso">Modificar</button>
    </div>
</modal>

