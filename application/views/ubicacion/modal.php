<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >Agregar Ubicación</h3>
    <div slot="body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><font color="red">*</font> Ubicación</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombreposicion}" name="rfc" v-model="newUbicacion.nombreposicion" autcomplete="off">
                           <div class="text-danger" v-html="formValidate.nombreposicion"> </div>
                </div> 
            </div>  
        </div> 

    </div>
    <div slot="foot">
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
        <button class="btn btn-primary" @click="addUbicacion">Agregar</button>
    </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Editar Ubicación</h3>
    <div slot="body"  >
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><font color="red">*</font> Ubicación</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombreposicion}" name="nombreposicion" v-model="chooseUbicacion.nombreposicion">
                           <div class="text-danger" v-html="formValidate.nombreposicion"> </div>
                </div> 
            </div>   
        </div>  
        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group">
                    <label for=""><font color="red">*</font> Estatus</label><br>
                    <label class="radio-inline"> 
                    <input type="radio" name="activo" v-model="chooseUbicacion.activo" value="1" :checked="chooseUbicacion.activo==1"> Activo 
                    </label>
                    <label class="radio-inline">  
                    <input type="radio" name="activo" v-model="chooseUbicacion.activo" value="0" :checked="chooseUbicacion.activo==0"> Inactivo 
                    </label>
                </div>
            </div>
        </div>

    </div>
    <div slot="foot"> 
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
        <button class="btn btn-primary" @click="updateUbicacion">Modificar</button>
    </div>
</modal>
