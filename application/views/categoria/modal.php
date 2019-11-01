<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >Agregar Categoria</h3>
    <div slot="body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><font color="red">*</font> Nombre</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombrecategoria}" name="nombrecategoria" v-model="newCategoria.nombrecategoria" autcomplete="off">
                           <div class="text-danger" v-html="formValidate.nombrecategoria"> </div>
                </div> 
            </div> 
             
        </div> 

    </div>
    <div slot="foot">
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
        <button class="btn btn-primary" @click="addCategoria">Agregar</button>
    </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Editar Categoria</h3>
    <div slot="body"  >
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
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
                    <label class="radio-inline"> <input type="radio" name="status" v-model="chooseCategoria.activo" value="1" :checked="chooseCategoria.activo==1"> Activo </label>
                    <label class="radio-inline">  <input type="radio" name="status" v-model="chooseCategoria.activo" value="0" :checked="chooseCategoria.activo==0"> Inactivo </label>
                </div>
            </div>
        </div>

    </div>
    <div slot="foot"> 
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
        <button class="btn btn-primary" @click="updateCategoria">Modificar</button>
    </div>
</modal>
