<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >Agregar Motivo</h3>
    <div slot="body">
      <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="text-danger" v-html="formValidate.msgerror"></div>
            </div>
        </div>
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
              <option value="">--Seleccionar--</option>
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
        <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
        <button class="btn btn-primary" @click="addMotivo"><i class='fa fa-floppy-o'></i> Agregar</button>
    </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Editar Motivo</h3>
    <div slot="body"  >
      <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="text-danger" v-html="formValidate.msgerror"></div>
            </div>
        </div>
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
                     <div class="demo-radio-button">  
                                <input name="group5" type="radio" id="radio_31" class="with-gap radio-col-green" v-model="chooseMotivo.activo" value="1" :checked="chooseMotivo.activo==1" />
                                <label for="radio_31">ACTIVO</label>
                                <input name="group5" type="radio" id="radio_32" class="with-gap radio-col-red"  v-model="chooseMotivo.activo" value="0" :checked="chooseMotivo.activo==0" />
                                <label for="radio_32">INACTIVO</label>
                            </div>
                </div>
            </div>
        </div>

    </div>
    <div slot="foot"> 
        <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
        <button class="btn btn-primary" @click="updateMotivo"><i class='fa fa-edit'></i>  Modificar</button>
    </div>
</modal>
