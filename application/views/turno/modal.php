<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
   <h3 slot="head" >Agregar Turno</h3>
   <div slot="body" class="row">
      <div class="col-md-12">
        <div class="text-danger" v-html="formValidate.smserror"> </div>
         <div class="form-group">
            <label><font color="red">*</font> Nombre</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombreturno}" name="nombreturno" v-model="newturno.nombreturno" autcomplete="off">
            <div class="text-danger" v-html="formValidate.nombreturno"> </div>
         </div>
          <div class="form-group">
            <label><font color="red">*</font> Hora inicial (Formato 24 hrs.)</label>
            <input type="time" class="form-control" :class="{'is-invalid': formValidate.horainicial}" name="horainicial" v-model="newturno.horainicial" autcomplete="off">
            <div class="text-danger" v-html="formValidate.horainicial"> </div>
         </div>
          <div class="form-group">
            <label><font color="red">*</font> Hora final (Formato 24 hrs.)</label>
            <input type="time" class="form-control" :class="{'is-invalid': formValidate.horafinal}" name="horafinal" v-model="newturno.horafinal" autcomplete="off">
            <div class="text-danger" v-html="formValidate.horafinal"> </div>
         </div>
         <div class="form-group">
            <label><font color="red">*</font> Siguiente dia</label><br/>
            <div class="demo-radio-button">  
                                <input name="group5" type="radio" id="radio_31" class="with-gap radio-col-green" :class="{'is-invalid': formValidate.horafinal}"  v-model="newturno.siguientedia" value="0"/>
                                <label for="radio_31">NO</label>
                                <input name="group5" type="radio" id="radio_32" class="with-gap radio-col-red"  :class="{'is-invalid': formValidate.horafinal}"  v-model="newturno.siguientedia" value="1"/>
                                <label for="radio_32">SI</label>
                            </div>
               <div class="text-danger" v-html="formValidate.siguientedia"> </div>

 
         </div>
          
      </div> 
   </div>
   <div slot="foot">
       <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
      <button class="btn btn-primary" @click="addTurno"><i class='fa fa-floppy-o'></i> Agregar</button>
   </div>
</modal>
<!--update modal-->
<modal v-if="editModal" @close="clearAll()">
   <h3 slot="head" >Editar Turno</h3>
   <div slot="body" class="row">
      <div class="col-md-12">
         <div class="form-group">
            <label><font color="red">*</font> Nombre</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombreturno}" name="rol" v-model="chooseTurno.nombreturno">
            <div class="text-danger" v-html="formValidate.nombreturno"> </div>
         </div>
        <div class="form-group">
            <label><font color="red">*</font> Hora inicial (Formato 24 hrs.)</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.horainicial}" name="rol" v-model="chooseTurno.horainicial">
            <div class="text-danger" v-html="formValidate.horainicial"> </div>
         </div>
         <div class="form-group">
            <label><font color="red">*</font> Hora final (Formato 24 hrs.)</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.horafinal}" name="rol" v-model="chooseTurno.horafinal">
            <div class="text-danger" v-html="formValidate.horafinal"> </div>
         </div>
         <div class="form-group">
            <label><font color="red">*</font> Estatus</label><br/>

            <div class="demo-radio-button">  
                                <input name="group5" type="radio" id="radio_31" class="with-gap radio-col-green" v-model="chooseTurno.activo" value="1" :checked="chooseTurno.activo==1" />
                                <label for="radio_31">ACTIVO</label>
                                <input name="group5" type="radio" id="radio_32" class="with-gap radio-col-red"  v-model="chooseTurno.activo" value="0" :checked="chooseTurno.activo==0" />
                                <label for="radio_32">INACTIVO</label>
                            </div> 
         </div>
          <div class="form-group">
            <label><font color="red">*</font> Siguiente dia</label><br/>

            <div class="demo-radio-button">  
                                <input name="group6" type="radio" id="radio_33" class="with-gap radio-col-green" v-model="chooseTurno.siguientedia" value="1" :checked="chooseTurno.siguientedia==1"/>
                                <label for="radio_33">SI</label>
                                <input name="group7" type="radio" id="radio_34" class="with-gap radio-col-red"  v-model="chooseTurno.siguientedia" value="0" :checked="chooseTurno.siguientedia==0" />
                                <label for="radio_34">NO</label>
                            </div> 
 
         </div>
        
      </div>
     
   </div>
   <div slot="foot"> 
     <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i>  Cancelar</button>
      <button class="btn btn-primary" @click="updateTurno"><i class='fa fa-edit'></i> Modificar</button>
   </div>
</modal>
