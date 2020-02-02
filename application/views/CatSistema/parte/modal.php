<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >Agregar número de parte</h3>
    <div slot="body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="text-danger" v-html="formValidate.smserror"> </div>
                <div class="form-group">
                    <label><font color="red">*</font> Número de parte</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.numeroparte}" name="nombre" v-model="newParte.numeroparte" autcomplete="off">
                           <div class="text-danger" v-html="formValidate.numeroparte"> </div>
                </div>
            </div>
        </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="form-group">
                    <label><font color="red">*</font> Categoria</label>
                    <select v-model="newParte.idcategoria" class="form-control"  :class="{'is-invalid': formValidate.idcategoria}"class="form-control">
                        <option value="">-- Seleccionar --</option>
                            <option   v-for="option in categorias" v-bind:value="option.idcategoria">
                            {{ option.nombrecategoria }}
                        </option>
                    </select>
                    <div class="text-danger" v-html="formValidate.idcategoria"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="form-group">
                    <label><font color="red">*</font> Cliente</label>
                    <select v-model="newParte.idcliente" class="form-control"  :class="{'is-invalid': formValidate.idcliente}"class="form-control">
                        <option value="">-- Seleccionar --</option>
                            <option   v-for="option in clientes" v-bind:value="option.idcliente">
                            {{ option.nombre }}
                        </option>
                    </select>
                    <div class="text-danger" v-html="formValidate.idcliente"></div>
                </div>
            </div>
        </div>
    </div>
    <div slot="foot">
        <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
        <button class="btn btn-primary" @click="addParte"><i class='fa fa-floppy-o'></i> Agregar</button>
        
    </div>
</modal>

<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Modificar número de parte</h3>
    <div slot="body" >

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class=" form-group" >
                    <div class="text-danger" v-html="formValidate.smserror"> </div>
                    <label><font color="red">*</font> Número parte Caja</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.numeroparte }" name="Precio" v-model="chooseParte.numeroparte " autcomplete="off" placeholder="Número parte Caja" >
                           <div class="text-danger" v-html="formValidate.numeroparte "> </div>
                </div>
            </div>
        </div>
  <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">

                <div class="form-group">
                    <label><font color="red">*</font> Categoria</label>

                    <select class="form-control" v-model="chooseParte.idcategoria" > 
                        <option v-for="option in categorias"  :selected="option.idcategoria === chooseParte.idcategoria ? 'selected' : ''" :value="option.idcategoria" >
                                {{ option.nombrecategoria }}
                    </option>
                </select>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">

                <div class="form-group">
                    <label><font color="red">*</font> Cliente</label>

                    <select class="form-control" v-model="chooseParte.idcliente" > 
                        <option v-for="option in clientes"  :selected="option.idcliente === chooseParte.idcliente ? 'selected' : ''" :value="option.idcliente" >
                                {{ option.nombre }}
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 ">

            <div class="form-group">
                   

                <label for=""><font color="red">*</font> Estatus</label><br>
                <div class="demo-radio-button">  
                                <input name="group5" type="radio" id="radio_31" class="with-gap radio-col-green" v-model="chooseParte.activo" value="1" :checked="chooseParte.activo==1" />
                                <label for="radio_31">ACTIVO</label>
                                <input name="group5" type="radio" id="radio_32" class="with-gap radio-col-red"  v-model="chooseParte.activo" value="0" :checked="chooseParte.activo==0" />
                                <label for="radio_32">INACTIVO</label>
                            </div>
            </div>
        </div>
    </div>




</div>
<div slot="foot">
     <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
    <button class="btn btn-primary" @click="updateParte"><i class='fa fa-edit'></i> Modificar</button>
   
</div>
</modal>
