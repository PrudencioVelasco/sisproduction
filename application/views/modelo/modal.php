<!--add modal-->
<modal v-if="addModal" @close="clearAll()">
    <h3 slot="head" >Agregar  Módelo</h3>
    <div slot="body"  >
        <div style=" height: 250px;overflow-x: hidden; overflow-y: scroll;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 ">
                    <div class="text-danger" v-html="formValidate.msgerror"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label><font color="red">*</font> MÓDELO</label>
                        <input type="text" v-model="newModelo.descripcion" class="form-control"  :class="{'is-invalid': formValidate.descripcion}" name="po">
                               <div class="text-danger" v-html="formValidate.descripcion"></div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>SHEET NAME</label>
                        <input type="text" v-model="newModelo.nombrehoja" class="form-control"  :class="{'is-invalid': formValidate.nombrehoja}" name="po">
                               <div class="text-danger" v-html="formValidate.nombrehoja"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>FULL/ONE/IMPRESION</label>
                        <input type="text" v-model="newModelo.fulloneimpresion " class="form-control"  :class="{'is-invalid': formValidate.fulloneimpresion }" name="po">
                               <div class="text-danger" v-html="formValidate.fulloneimpresion "></div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>LINER COLOR</label>
                        <input type="text" v-model="newModelo.colorlinea" class="form-control"  :class="{'is-invalid': formValidate.colorlinea}" name="po">
                               <div class="text-danger" v-html="formValidate.colorlinea"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>DIE CUT NO</label>
                        <input type="text" v-model="newModelo.diucutno  " class="form-control"  :class="{'is-invalid': formValidate.diucutno  }" name="po">
                               <div class="text-danger" v-html="formValidate.diucutno  "></div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>PLATE NO</label>
                        <input type="text" v-model="newModelo.platonumero  " class="form-control"  :class="{'is-invalid': formValidate.platonumero  }" name="po">
                               <div class="text-danger" v-html="formValidate.platonumero  "></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>COLOR</label>
                        <input type="text" v-model="newModelo.color  " class="form-control"  :class="{'is-invalid': formValidate.color  }" name="po">
                               <div class="text-danger" v-html="formValidate.color  "></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>SHARED STANDARDS</label>
                        <input type="text" v-model="newModelo.normascompartidas  " class="form-control"  :class="{'is-invalid': formValidate.normascompartidas  }" name="po">
                               <div class="text-danger" v-html="formValidate.normascompartidas  "></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>BLANK SIZE</label>
                        <input type="text" v-model="newModelo.blanksize  " class="form-control"  :class="{'is-invalid': formValidate.blanksize  }" name="po">
                               <div class="text-danger" v-html="formValidate.blanksize  "></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>SHEET SIZE</label>
                        <input type="text" v-model="newModelo.sheetsize  " class="form-control"  :class="{'is-invalid': formValidate.sheetsize  }" name="po">
                               <div class="text-danger" v-html="formValidate.sheetsize  "></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>SCORE</label>
                        <input type="text" v-model="newModelo.score  " class="form-control"  :class="{'is-invalid': formValidate.score  }" name="po">
                               <div class="text-danger" v-html="formValidate.score  "></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>OUT</label>
                        <input type="text" v-model="newModelo.salida   " class="form-control"  :class="{'is-invalid': formValidate.salida   }" name="po">
                               <div class="text-danger" v-html="formValidate.salida   "></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>COMBINATION</label>
                        <input type="text" v-model="newModelo.combinacion   " class="form-control"  :class="{'is-invalid': formValidate.combinacion   }" name="po">
                               <div class="text-danger" v-html="formValidate.combinacion   "></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>LITHO NAME</label>
                        <input type="text" v-model="newModelo.lithoname   " class="form-control"  :class="{'is-invalid': formValidate.lithoname   }" name="po">
                               <div class="text-danger" v-html="formValidate.lithoname   "></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>MEDIDA</label>
                        <input type="text" v-model="newModelo.medida   " class="form-control"  :class="{'is-invalid': formValidate.medida   }" name="po">
                               <div class="text-danger" v-html="formValidate.medida   "></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>DIMENSIÓN</label>
                        <input type="text" v-model="newModelo.dimension   " class="form-control"  :class="{'is-invalid': formValidate.dimension   }" name="po">
                               <div class="text-danger" v-html="formValidate.dimension   "></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>COMMENT</label>
                        <input type="text" v-model="newModelo.comment   " class="form-control"  :class="{'is-invalid': formValidate.comment   }" name="po">
                               <div class="text-danger" v-html="formValidate.comment   "></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div slot="foot">
         <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
        <button class="btn btn-primary" @click="addModelo"><i class='fa fa-floppy-o'></i> Agregar</button>

    </div>
</modal>
<modal v-if="editModal" @close="clearAll()">
    <h3 slot="head" >Editar Modelo</h3>
    <div slot="body">
        <div style=" height: 250px;overflow-x: hidden; overflow-y: scroll;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 ">
                    <div class="text-danger" v-html="formValidate.msgerror"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label><font color="red">*</font> MODELO</label>
                        <input type="text" v-model="chooseModelo.descripcion" class="form-control"  :class="{'is-invalid': formValidate.descripcion}" name="po">
                               <div class="text-danger" v-html="formValidate.descripcion"></div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>SHEET NAME</label>
                        <input type="text" v-model="chooseModelo.nombrehoja" class="form-control"  :class="{'is-invalid': formValidate.nombrehoja}" name="po">
                               <div class="text-danger" v-html="formValidate.nombrehoja"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>FULL/ONE/IMPRESION</label>
                        <input type="text" v-model="chooseModelo.fulloneimpresion " class="form-control"  :class="{'is-invalid': formValidate.fulloneimpresion }" name="po">
                               <div class="text-danger" v-html="formValidate.fulloneimpresion "></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>LINER COLOR</label>
                        <input type="text" v-model="chooseModelo.colorlinea" class="form-control"  :class="{'is-invalid': formValidate.colorlinea}" name="po">
                               <div class="text-danger" v-html="formValidate.colorlinea"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>DIE CUT NO</label>
                        <input type="text" v-model="chooseModelo.diucutno  " class="form-control"  :class="{'is-invalid': formValidate.diucutno  }" name="po">
                               <div class="text-danger" v-html="formValidate.diucutno  "></div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>PLATE NO</label>
                        <input type="text" v-model="chooseModelo.platonumero  " class="form-control"  :class="{'is-invalid': formValidate.platonumero  }" name="po">
                               <div class="text-danger" v-html="formValidate.platonumero  "></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>COLOR</label>
                        <input type="text" v-model="chooseModelo.color  " class="form-control"  :class="{'is-invalid': formValidate.color  }" name="po">
                               <div class="text-danger" v-html="formValidate.color  "></div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>SHARED STANDARDS</label>
                        <input type="text" v-model="chooseModelo.normascompartidas" class="form-control"  :class="{'is-invalid': formValidate.normascompartidas  }" name="po">
                               <div class="text-danger" v-html="formValidate.normascompartidas"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>BLANK SIZE</label>
                        <input type="text" v-model="chooseModelo.blanksize" class="form-control"  :class="{'is-invalid': formValidate.blanksize  }" name="po">
                               <div class="text-danger" v-html="formValidate.blanksize"></div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>SHEET SIZE</label>
                        <input type="text" v-model="chooseModelo.sheetsize  " class="form-control"  :class="{'is-invalid': formValidate.sheetsize  }" name="po">
                               <div class="text-danger" v-html="formValidate.sheetsize  "></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>SCORE</label>
                        <input type="text" v-model="chooseModelo.score  " class="form-control"  :class="{'is-invalid': formValidate.score  }" name="po">
                               <div class="text-danger" v-html="formValidate.score  "></div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>OUT</label>
                        <input type="text" v-model="chooseModelo.salida   " class="form-control"  :class="{'is-invalid': formValidate.salida   }" name="po">
                               <div class="text-danger" v-html="formValidate.salida   "></div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>COMBINATION</label>
                        <input type="text" v-model="chooseModelo.combinacion   " class="form-control"  :class="{'is-invalid': formValidate.combinacion   }" name="po">
                               <div class="text-danger" v-html="formValidate.combinacion   "></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>LITHO NAME</label>
                        <input type="text" v-model="chooseModelo.lithoname   " class="form-control"  :class="{'is-invalid': formValidate.lithoname   }" name="po">
                               <div class="text-danger" v-html="formValidate.lithoname   "></div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>MEDIDA</label>
                        <input type="text" v-model="chooseModelo.medida   " class="form-control"  :class="{'is-invalid': formValidate.medida   }" name="po">
                               <div class="text-danger" v-html="formValidate.medida   "></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>DIMENSIÓN</label>
                        <input type="text" v-model="chooseModelo.dimension   " class="form-control"  :class="{'is-invalid': formValidate.dimension   }" name="po">
                               <div class="text-danger" v-html="formValidate.dimension   "></div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                        <label>COMMENT</label>
                        <input type="text" v-model="chooseModelo.comment   " class="form-control"  :class="{'is-invalid': formValidate.comment   }" name="po">
                               <div class="text-danger" v-html="formValidate.comment   "></div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12 ">
                    <div class="form-group">
                       <label for=""><font color="red">*</font> Estatus</label><br>
                       <div class="demo-radio-button">
                                      <input name="group5" type="radio" id="radio_31" class="with-gap radio-col-green" v-model="chooseModelo.activo" value="1" :checked="chooseModelo.activo==1" />
                                      <label for="radio_31">ACTIVO</label>
                                      <input name="group5" type="radio" id="radio_32" class="with-gap radio-col-red"  v-model="chooseModelo.activo" value="0" :checked="chooseModelo.activo==0" />
                                      <label for="radio_32">INACTIVO</label>
                      </div>
                    </div>
                  </div>
                </div>


        </div>
    </div>
    <div slot="foot">
        <button class="btn btn-danger" @click="clearAll"><i class='fa fa-ban'></i> Cancelar</button>
        <button class="btn btn-primary" @click="updateModelo"><i class='fa fa-edit'></i>  Modificar</button>
    </div>
</modal>
