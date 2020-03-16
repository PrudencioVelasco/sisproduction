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
        <button class="btn btn-primary" @click="addProceso"><i class='fa fa-floppy-o'></i> Agregar</button>
        <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
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
                <label><font color="red">*</font> Estatus</label><br>
               <div class="demo-radio-button">
                      <input name="group5" type="radio" id="radio_31" class="with-gap radio-col-green" v-model="chooseProceso.activo" value="1" :checked="chooseProceso.activo==1" />
                      <label for="radio_31">ACTIVO</label>
                      <input name="group5" type="radio" id="radio_32" class="with-gap radio-col-red"  v-model="chooseProceso.activo" value="0" :checked="chooseProceso.activo==0" />
                      <label for="radio_32">INACTIVO</label>
                </div>
             </div>
            </div>
        </div>


    </div>
    <div slot="foot">
        <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
        <button class="btn btn-primary" @click="updateProceso"><i class='fa fa-edit'></i> Modificar</button>
    </div>
</modal>
