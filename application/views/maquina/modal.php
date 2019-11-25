<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >Agregar nueva Maquina</h3>
    <div slot="body"  >
        <div >
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="text-danger" v-html="formValidate.msgerror"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="form-group">
                    <label><font color="red">*</font> Maquina</label>
                    <input type="text" v-model="newMaquina.nombremaquina" class="form-control"  :class="{'is-invalid': formValidate.nombremaquina}" name="po"> 
                           <div class="text-danger" v-html="formValidate.nombremaquina"></div>
                </div>
            </div> 
        </div>
 
  
    </div>
    </div>
    <div slot="foot">
        <button class="btn btn-primary" @click="addMaquina">Agregar</button>
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
    </div>
</modal>
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Editar Maquina</h3>
    <div slot="body">
         <div  >
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="text-danger" v-html="formValidate.msgerror"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="form-group">
                    <label><font color="red">*</font> Linea</label>
                    <input type="text" v-model="chooseMaquina.nombremaquina" class="form-control"  :class="{'is-invalid': formValidate.nombremaquina}" name="po"> 
                           <div class="text-danger" v-html="formValidate.nombremaquina"></div>
                </div>
            </div> 
        </div>
         <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="form-group">
                    <label for=""><font color="red">*</font> Estatus</label><br>
                    <label class="radio-inline"> 
                    <input type="radio" name="activo" v-model="chooseMaquina.activo" value="1" :checked="chooseMaquina.activo==1"> Activo 
                    </label>
                    <label class="radio-inline">  
                    <input type="radio" name="activo" v-model="chooseMaquina.activo" value="0" :checked="chooseMaquina.activo==0"> Inactivo 
                    </label>
                </div>
            </div>
        </div>

 
 
</div>
    </div>
    <div slot="foot">
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
        <button class="btn btn-primary" @click="updateMaquina">Modificar</button>
    </div>
</modal>

