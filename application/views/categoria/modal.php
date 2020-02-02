<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >Agregar Categoria</h3>
    <div slot="body">
        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group">
                    <div class="text-danger" v-html="formValidate.smserror"> </div>
                    <label><font color="red">*</font> Nombre</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombrecategoria}" name="nombrecategoria" v-model="newCategoria.nombrecategoria" autcomplete="off">
                           <div class="text-danger" v-html="formValidate.nombrecategoria"> </div>
                </div> 
            </div> 
             
        </div> 

    </div>
    <div slot="foot">
        <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i>  Cancelar</button>
        <button class="btn btn-primary" @click="addCategoria"><i class='fa fa-floppy-o'></i> Agregar</button>
    </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Editar Categoria</h3>
    <div slot="body"  >
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="text-danger" v-html="formValidate.smserror"> </div>
                    <label><font color="red">*</font> Nombre de la Categoria</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombrecategoria}" name="nombre" v-model="chooseCategoria.nombrecategoria">
                           <div class="text-danger" v-html="formValidate.nombrecategoria"> </div>
                </div> 
            </div> 
           
        </div> 
      
        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group">
                    <label for=""><font color="red">*</font> Estatus</label><br>
                             <div class="demo-radio-button">  
                                <input name="group5" type="radio" id="radio_31" class="with-gap radio-col-green" v-model="chooseCategoria.activo" value="1" :checked="chooseCategoria.activo==1" />
                                <label for="radio_31">ACTIVO</label>
                                <input name="group5" type="radio" id="radio_32" class="with-gap radio-col-red"  v-model="chooseCategoria.activo" value="0" :checked="chooseCategoria.activo==0" />
                                <label for="radio_32">INACTIVO</label>
                            </div> 
                </div>
            </div>
        </div>

    </div>
    <div slot="foot"> 
        <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i>  Cancelar</button>
        <button class="btn btn-primary" @click="updateCategoria"><i class='fa fa-edit'></i> Modificar</button>
    </div>
</modal>
