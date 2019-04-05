<!-- page content -->

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Generar una orden de salida</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Número de Control: <strong><?php echo $detallesalida->numerosalida; ?></strong></h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 text-right">
                                <div class="form-group">
                                    <h4>Cliente: <strong><?php echo $detallesalida->nombre; ?></strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4>Número de Transferencia: <strong><?php echo $detallesalida->idsalida; ?></strong></h4>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php if ($detallesalida->finalizado == 0) { ?>
                                    <button type="button" class="btn  btn-round btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-search" aria-hidden="true"></i> Buscar parte</button>
                                <?php } ?>
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="exampleModalCenterTitle">Agregar número de parte</h3>

                                            </div>
                                            <div class="modal-body">
                                                <div id="app">
                                                    <div class="row">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input placeholder="Buscar" type="search" :autofocus="'autofocus'" class="form-control btn-round" v-model="search.text" @keyup="searchParte" name="search">
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <table class="table table-striped responsive-utilities jambo_table bulk_action"  >
                                                            <thead class="text-white bg-dark" >
                                                            <th class="text-white">Trans.</th>
                                                            <th class="text-white">N. Parte</th>
                                                            <th class="text-white">Pallet</th>
                                                            <th class="text-white">Cajas x pallet</th>
                                                            <th class="text-white">Cajas Disponibles</th>
                                                            <th class="text-white">N. modelo</th>
                                                            <th class="text-white">Revisión</th>
                                                            <th class="text-white">Fecha</th>
                                                            <th class="text-white text-right" align="right">Opción</th>
                                                            </thead>
                                                            <tbody class="table-light">

                                                                <tr v-for="row in partes" class="table-default">
                                                                    <td v-if="row.totalpallet > 0">{{row.folio}}</td>
                                                                    <td v-if="row.totalpallet > 0">{{row.numeroparte}}</td>
                                                                    <td v-if="row.totalpallet > 0">
                                                                        <label style="color:red;" >{{row.totalpallet}}</label>
                                                                    </td>
                                                                    <td v-if="row.totalpallet > 0">
                                                                        <label style="color:red;">{{row.cajasporpallet}} </label>

                                                                    </td>
                                                                    <td v-if="row.totalpallet > 0">
                                                                        <label style="color:green;">{{row.cajasdisponibles}} </label>

                                                                    </td>
                                                                    <td v-if="row.totalpallet > 0">{{row.modelo}}</td>
                                                                    <td v-if="row.totalpallet > 0">{{row.revision}}</td>
                                                                    <td v-if="row.totalpallet > 0">{{row.fecharegistro}}</td>
                                                                    <td v-if="row.totalpallet > 0" align="right">
                                                                        <a class="btn btn-icons btn-rounded btn-info btn-xs" v-bind:href="'/sisproduction/salida/agregarParteOrdenDetallado/'+ row.iddetalleparte+'/'+row.cajasporpallet+'/'+<?php echo $idsalida ?>" ><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                                            Agregar</a>
                                                                    </td>
                                                                </tr> 
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="8" align="right">
                                                            <pagination
                                                                :current_page="currentPage"
                                                                :row_count_page="rowCountPage"
                                                                @page-update="pageUpdate"
                                                                :total_users="totalParte"
                                                                :page_range="pageRange"
                                                                >
                                                            </pagination>
                                                            </td>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <?php if (isset($detalleparte) && !empty($detalleparte)) { ?> 
                                <form method="post" id="frmagregar" action="">
                                    <div class="col-md-3 col-sm-12 col-xs-12 ">
                                        <div class="form-group">
                                            <label><font color="red">*</font> Parte</label>
                                            <input type="text" name="numeroparte" class="form-control" value="<?php echo $detalleparte->numeroparte ?>" disabled="">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12 ">
                                        <div class="form-group">
                                            <label><font color="red">*</font> Tipo</label>
                                            <p style="padding-top:5px;">
                                                <strong>Pallet:</strong>
                                                <input type="radio" name="tipo" id="selectPal" value="pallet" checked="" required /> <strong>Parciales:</strong>
                                                <input type="radio" name="tipo" id="selectPar" value="parciales" />
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12 " id="pallet">
                                        <div class="form-group">
                                            <label><font color="red">*</font> C. Pallet</label>
                                            <input type="text" name="pallet" id="ppallet" class="form-control" placeholder="C. Pallet" ">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12 " id="cajas">
                                        <div class="form-group">
                                            <label><font color="red">*</font> Total Cajas</label>
                                            <input type="text" name="cajas" id="pcajas" class="form-control" placeholder="Total Cajas" >
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12 ">
                                        <div class="form-group">
                                            <input type="hidden" name="iddetalleparte" value="<?php echo $detalleparte->iddetalleparte; ?>"/>
                                            <input type="hidden" name="idsalida" value="<?php echo $idsalida; ?>"/>
                                            <input type="hidden" name="cajasporpallet" value="<?php echo $cajasporpallet ?>"/>
                                            <button type="button" id="btnagregar" style="margin-top:22px;" class="btn btn-default">Agregar</button>
                                        </div>
                                    </div>
                                </form>
                            <?php }
                            ?>

                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <label id="msgerror" style="color:red;"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table class="table table-striped responsive-utilities jambo_table bulk_action" >
                                    <thead>
                                        <tr>
                                            <th><strong>Número de parte</strong></th>
                                            <th><strong>Tipo</strong></th>
                                            <th><strong>C. Pallet</strong></th>
                                            <th><strong>C. Caja por Pallet</strong></th>
                                            <th><strong>Modelo</strong></th>
                                            <th><strong>Revisión</strong></th>
                                            <?php if ($detallesalida->finalizado == 0) { ?>
                                                <th></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <?php
                                    if (isset($detalleorden) && !empty($detalleorden)) {
                                        $totalpallet = 0;
                                        $totalcajas = 0;
                                        foreach ($detalleorden as $value) {




                                            // code...
                                            echo "<tr>";
                                            echo "<td>" . $value->numeroparte . "</td>";
                                            echo '<td>';
                                            if ($value->tipo == 0) {
                                                echo '<label style="color:#8938f5;">Por pallet</label>';
                                            } else {
                                                echo '<label style="color:#1abd53;">Parciales</label>';
                                            }
                                            echo '</td>';
                                            echo "<td>1</td>";
                                            ?>
                                            <td>
                                                <?php
                                                if ($value->tipo == 0) {
                                                    echo $value->cajaspallet;
                                                } else {
                                                    echo $value->caja;
                                                }
                                                ?>
                                            </td>
                                            <?php
                                            echo "<td>" . $value->modelo . "</td>";
                                            echo "<td>" . $value->revision . "</td>";
                                            ?>
                                            <?php if ($detallesalida->finalizado == 0) { ?>
                                                <td align="right">
                                                    <input type="hidden" id="idordensalida" name="idordensalida" value="<?php echo $value->idordensalida; ?>"/>

                                                    <a onclick="return confirm('Estas seguro de quitar?')" href="<?php echo site_url('salida/eliminarParteOrden/' . $value->idordensalida . '/' . $value->idsalida . '/' . $value->idpalletcajas) ?>"><i style="color:red;padding-right: 10px;"  class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
                                                </td>
                                            <?php } ?>
                                            <?php
                                            echo "</tr>";
                                        }

                                       
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">

                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style=" background-color: #d8d8d8">
                                            <h4 class="panel-title" >
                                                <a data-toggle="collapse" href="#collapse1"><i class="fa fa-bars" aria-hidden="true"></i> Click para ver detalle de la Orden.</a>
                                            </h4>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Número de parte</th>
                                                            <th>Modelo</th>
                                                            <th>Pallet</th>
                                                            <th>Cajas</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                          $totalpallet = 0;
                                                        $totalcajas = 0;
                                                        if (isset($detallepallet) && !empty($detallepallet)) {
                                                            foreach ($detallepallet as $value) {
                                                                $totalpallet += $value->totalpallet;
                                                                $totalcajas += $value->sumacajas;
                                                                echo "<tr>";
                                                                echo "<td><i class='fa fa-check'  style='color:#8938f5;' aria-hidden='true'></i> $value->numeroparte </td>";
                                                                echo "<td>$value->modelo</td>";
                                                                echo "<td>$value->totalpallet</td>";
                                                                echo "<td>$value->sumacajas</td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                        if (isset($detalleparciales) && !empty($detalleparciales)) {
                                                            foreach ($detalleparciales as $value) {
                                                                $totalpallet += 1;
                                                                $totalcajas += $value->sumacajas;
                                                                echo "<tr>";
                                                                echo "<td><i class='fa fa-check'  style='color:#1abd53;' aria-hidden='true'></i> $value->numeroparte </td>";
                                                                echo "<td>$value->modelo</td>";
                                                                echo "<td>1</td>";
                                                                echo "<td>$value->sumacajas</td>";
                                                                echo "</tr>";
                                                            }
                                                        }

                                                        echo "<tr>"; 
                                                        echo "<td></td>";
                                                        echo "<td></td>";
                                                        echo "<td><strong>" . number_format($totalpallet) . "</strong></td>";
                                                        echo "<td><strong>" . number_format($totalcajas) . "</strong></td>";
                                                        echo "</tr>";
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php if ($detallesalida->finalizado == 0) { ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" align="right">
                                    <form method="POST" action="<?= base_url('salida/terminarOrdenSalida') ?>">
                                        <input type="hidden" name="idsalida" value="<?php echo $idsalida; ?>"/>
                                        <button type="submit" id="btnterminarorden" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>
                                            Terminar orden</button>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($detallesalida->finalizado == 1) { ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" align="right"> 
                                    <a target=”_blank” href="<?php echo site_url('salida/generarPDFOrden/' . $idsalida) ?>"  class="btn btn-default"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                        Descargar Orden</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#pallet').show();
        $('#cajas').hide();
        $('#selectPal').on('click', function () {
            $('#pallet').show();
            $('#cajas').hide();
        });
        $('#selectPar').on('click', function () {
            $('#pallet').hide();
            $('#cajas').show();
        });
        $('#btnagregar').on('click', function () {

            form = $("#frmagregar").serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('salida/agregarNumeroParteOrder'); ?>",
                data: form,

                success: function (data) {

                    console.log(data);
                    if (data == 10) {
                        $("#msgerror").text("Campo requerido.");
                    } else if (data == 11) {
                        $("#msgerror").text("Solo debe de ser númerico.");
                    } else if (data == 12) {
                        $("#msgerror").text("Debe de ser mayor a 0.");
                    } else if (data == 13) {
                        $("#msgerror").text("No existe Stock suficiente.");
                    } else {
                        location.reload();
                    }
                    // location.reload();
                    //$("#msgerror").text(data);
//                               if(data == 0){
//                                  $("#msgerror").text("No existe suficiente en Existencia.");
//                               setTimeout(function(){
//                                   location.reload();
//                               },5000);   
//                               }else{
//                                setTimeout(function(){
//                                   location.reload();
//                               },1000); 
//                               }
                }

            });
            //event.preventDefault();
            return false;  //stop the actual form post !important!


        });
    });
</script>
<script>
    Vue.config.devtools = true
    Vue.component('modal', {//modal
        template: `
   <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-dialog">
                            <div class="modal-content">
			      

                              <div class="modal-header">
                                        <h5 class="modal-title"> <slot name="head"></slot></h5> 
                <i class="fa fa-window-close  icon-md text-danger" @click="$emit('close')"></i>
                                      </div>

                              <div class="modal-body" style="background-color:#fff;">
                                 <slot name="body"></slot>
                              </div>
                              <div class="modal-footer">

                                 <slot name="foot"></slot>
                              </div>
                            </div>
          </div>
        </div>
      </div>
    </transition> 
    `
    })
    var v = new Vue({
        el: '#app',
        data: {
            url: 'http://localhost:8383/sisproduction/',

            addModal: false,
            editModal: false,
            //passwordModal:false,
            //deleteModal:false,
            partes: [],
            search: {text: ''},
            emptyResult: false,
            chooseParte: {},
            formValidate: [],
            successMSG: '',

            //pagination
            currentPage: 0,
            rowCountPage: 5,
            totalParte: 0,
            pageRange: 2
        },
        created() {
            this.showAll();
        },
        methods: {

            showAll() {


                axios.get(this.url + "salida/test1/" +<?php echo $idsalida ?>).then(function (response) {
                    if (response.data.partes == null) {
                        v.noResult()
                    } else {
                        v.getData(response.data.partes);

                    }
                })
            },
            searchParte() {
                var formData = v.formData(v.search);
                axios.post(this.url + "salida/searchPartes", formData).then(function (response) {
                    if (response.data.partes == null) {
                        v.noResult()
                    } else {
                        v.getData(response.data.partes);

                    }
                })
            },

            formData(obj) {
                var formData = new FormData();
                for (var key in obj) {
                    formData.append(key, obj[key]);
                }
                return formData;
            },
            getData(partes) {
                v.emptyResult = false; // become false if has a record
                v.totalParte = partes.length //get total of user
                v.partes = partes.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

                // if the record is empty, go back a page
                if (v.partes.length == 0 && v.currentPage > 0) {
                    v.pageUpdate(v.currentPage - 1)
                    v.clearAll();
                }
            },

            selectParte(parte) {
                v.chooseParte = parte;
            },
            clearMSG() {
                setTimeout(function () {
                    v.successMSG = ''
                }, 3000); // disappearing message success in 2 sec
            },
            clearAll() {
                v.formValidate = false;
                v.addModal = false;
                v.editModal = false;
                v.deleteModal = false;
                v.refresh()

            },
            noResult() {

                v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
                v.partes = null
                v.totalClient = 0 //remove current page if is empty

            },

            pageUpdate(pageNumber) {
                v.currentPage = pageNumber; //receive currentPage number came from pagination template
                v.refresh()
            },
            refresh() {
                v.search.text ? v.searchPartes() : v.showAll(); //for preventing

            }
        }
    })
</script>