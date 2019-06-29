<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >Agregar nueva Linea</h3>
    <div slot="body"  >
        <div style=" height: 100px;overflow-x: hidden; overflow-y: scroll;">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="text-danger" v-html="formValidate.msgerror"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="form-group">
                    <label><font color="red">*</font> Linea</label>
                    <input type="text" v-model="newLinea.nombrelinea" class="form-control"  :class="{'is-invalid': formValidate.nombrelinea}" name="po"> 
                           <div class="text-danger" v-html="formValidate.nombrelinea"></div>
                </div>
            </div> 
        </div>
 
  
    </div>
    </div>
    <div slot="foot">
        <button class="btn btn-primary" @click="addLinea">Agregar</button>
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
    </div>
</modal>
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Editar Linea</h3>
    <div slot="body">
         <div style=" height: 100px;overflow-x: hidden; overflow-y: scroll;">
         <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="text-danger" v-html="formValidate.msgerror"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="form-group">
                    <label><font color="red">*</font> Linea</label>
                    <input type="text" v-model="chooseLinea.nombrelinea" class="form-control"  :class="{'is-invalid': formValidate.nombrelinea}" name="po"> 
                           <div class="text-danger" v-html="formValidate.nombrelinea"></div>
                </div>
            </div> 
        </div>
 
 
</div>
    </div>
    <div slot="foot">
        <button class="btn btn-danger" @click="clearAll">Cancelar</button>
        <button class="btn btn-primary" @click="updateLinea">Modificar</button>
    </div>
</modal>

