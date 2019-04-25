<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >Agregar Cliente</h3>
    <div slot="body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><font color="red">*</font> RFC</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.rfc}" name="rfc" v-model="newClient.rfc" autcomplete="off">
                           <div class="text-danger" v-html="formValidate.rfc"> </div>
                </div> 
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    <label><font color="red">*</font> Nombre del cliente</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombre}" name="nombre" v-model="newClient.nombre" autcomplete="off">
                           <div class="text-danger" v-html="formValidate.nombre"> </div>
                </div>  
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><font color="red">*</font> Abreviatura de nombre del cliente</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.abreviatura}" name="nombre" v-model="newClient.abreviatura" autcomplete="off">
                           <div class="text-danger" v-html="formValidate.abreviatura"> </div>
                </div>  
            </div> 

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><font color="red">*</font> Dirección de entrega</label>
                    <textarea class="form-control"  :class="{'is-invalid': formValidate.direccion}" name="nombre" v-model="newClient.direccion" autcomplete="off" rows="2"></textarea>
                    <div class="text-danger" v-html="formValidate.direccion"> </div>
                </div>  
            </div> 
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><font color="red">*</font> Dirección de facturación</label>
                    <textarea class="form-control"  :class="{'is-invalid': formValidate.direccionfacturacion}" name="nombre" v-model="newClient.direccionfacturacion" autcomplete="off" rows="2"></textarea>
                    <div class="text-danger" v-html="formValidate.direccionfacturacion"> </div>
                </div>  
            </div> 
        </div>

    </div>
    <div slot="foot">
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
        <button class="btn btn-primary" @click="addClient">Agregar</button>
    </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Editar Cliente</h3>
    <div slot="body"  >
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><font color="red">*</font> RFC</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.rfc}" name="nombre" v-model="chooseClient.rfc">
                           <div class="text-danger" v-html="formValidate.rfc"> </div>
                </div> 
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    <label><font color="red">*</font> Nombre del cliente</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombre}" name="nombre" v-model="chooseClient.nombre">
                           <div class="text-danger" v-html="formValidate.nombre"> </div>
                </div> 
            </div> 
        </div> 
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><font color="red">*</font> Abreviatura</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.abreviatura}" name="nombre" v-model="chooseClient.abreviatura">
                           <div class="text-danger" v-html="formValidate.abreviatura"> </div>
                </div> 
            </div> 
           
        </div>
        <div class="row">
             <div class="col-md-12">
                <div class="form-group">
                    <label><font color="red">*</font> Dirección de entrega</label>
                    <textarea class="form-control" :class="{'is-invalid': formValidate.direccion}" name="nombre" v-model="chooseClient.direccion"></textarea>      
                    <div class="text-danger" v-html="formValidate.direccion"> </div>
                </div> 
            </div> 
        </div>
        <div class="row">
             <div class="col-md-12">
                <div class="form-group">
                    <label><font color="red">*</font> Dirección de facturación</label>
                    <textarea class="form-control" :class="{'is-invalid': formValidate.direccionfacturacion}" name="nombre" v-model="chooseClient.direccionfacturacion"></textarea>      
                    <div class="text-danger" v-html="formValidate.direccionfacturacion"> </div>
                </div> 
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group">
                    <label for=""><font color="red">*</font> Estatus</label><br>
                    <label class="radio-inline"> <input type="radio" name="status" v-model="chooseClient.activo" value="1" :checked="chooseClient.activo==1"> Activo </label>
                    <label class="radio-inline">  <input type="radio" name="status" v-model="chooseClient.activo" value="0" :checked="chooseClient.activo==0"> Inactivo </label>
                </div>
            </div>
        </div>

    </div>
    <div slot="foot"> 
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
        <button class="btn btn-primary" @click="updateClient">Modificar</button>
    </div>
</modal>
