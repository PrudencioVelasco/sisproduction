<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >Agregar Cliente</h3>
    <div slot="body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="text-danger" v-html="formValidate.msgerror"></div>
            </div>
        </div>
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
            <div class="col-md-6">
                <div class="form-group">
                    <label><font color="red">*</font> Abreviatura de nombre del cliente</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.abreviatura}" name="nombre" v-model="newClient.abreviatura" autcomplete="off">
                           <div class="text-danger" v-html="formValidate.abreviatura"> </div>
                </div>  
            </div> 
            
            <div class="col-md-6">
                <div class="form-group">
                    <label><font color="red">*</font> Clave</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.clave}" name="nombre" v-model="newClient.clave" autcomplete="off">
                           <div class="text-danger" v-html="formValidate.clave"> </div>
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
        <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
        <button class="btn btn-primary" @click="addClient"><i class='fa fa-floppy-o'></i> Agregar</button>
    </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Editar Cliente</h3>
    <div slot="body"  >
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="text-danger" v-html="formValidate.msgerror"></div>
            </div>
        </div>
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
            <div class="col-md-6">
                <div class="form-group">
                    <label><font color="red">*</font> Abreviatura de nombre del cliente</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.abreviatura}" name="nombre" v-model="chooseClient.abreviatura">
                           <div class="text-danger" v-html="formValidate.abreviatura"> </div>
                </div> 
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    <label><font color="red">*</font> Clave</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.clave}" name="nombre" v-model="chooseClient.clave">
                           <div class="text-danger" v-html="formValidate.clave"> </div>
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
                     <div class="demo-radio-button">  
                                <input name="group5" type="radio" id="radio_31" class="with-gap radio-col-green" v-model="chooseClient.activo" value="1" :checked="chooseClient.activo==1" />
                                <label for="radio_31">ACTIVO</label>
                                <input name="group5" type="radio" id="radio_32" class="with-gap radio-col-red"  v-model="chooseClient.activo" value="0" :checked="chooseClient.activo==0" />
                                <label for="radio_32">INACTIVO</label>
                            </div>

                   
                </div>
            </div>
        </div>

    </div>
    <div slot="foot"> 
        <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
        <button class="btn btn-primary" @click="updateClient"><i class='fa fa-edit'></i> Modificar</button>
    </div>
</modal>
