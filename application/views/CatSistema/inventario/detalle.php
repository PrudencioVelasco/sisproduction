<!-- page content -->
<style type="text/css">
    .checkbox2 label:after, 
.radio label:after {
    content: '';
    display: table;
    clear: both;
}

.checkbox2 .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border: 1px solid #a9a9a9;
    border-radius: .25em;
    width: 1.3em;
    height: 1.3em;
    margin-right: .5em;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox2 .cr .cr-icon,
.radio .cr .cr-icon {
    position: absolute;
    font-size: .8em;
    line-height: 0;
    top: 50%;
    left: 20%;
}

.radio .cr .cr-icon {
    margin-left: 0.04em;
}

.checkbox2 label input[type="checkbox"],
.radio label input[type="radio"] {
    display: none;
}

.checkbox2 label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
    transform: scale(3) rotateZ(-20deg);
    opacity: 0;
    transition: all .3s ease-in;
}

.checkbox2 label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
    opacity: .5;
}
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><strong>Subir Inventario</strong></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content"> 
                        
                        
                         <form   method="POST" action="<?php echo base_url('Catalogo/operacion'); ?>">
                             <div class="table-responsive">
                        <table class="table table-striped responsive-utilities jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th>
                                        <div class="checkbox2">
                                            <label>
                                                <input type="checkbox" id="select_all">
                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok" style="color:green"></i></span>
                                            </label>
                                        </div>
                                    </th>
                                     <th>
                                        <div class="checkbox2">
                                            <label>
                                                <input type="checkbox" id="select_all_delete">
                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok" style="color:red"></i></span>
                                            </label>
                                        </div>
                                    </th>
                                    <th class="column-title">Parte <i class="fa fa-sort" aria-hidden="true"></i> </th>
                                    <th class="column-title" style="width: 20px;">Modelo <i class="fa fa-sort" aria-hidden="true"></i> </th>
                                    <th class="column-title">Revisión <i class="fa fa-sort" aria-hidden="true"></i> </th>
                                    <th class="column-title">Cajas <i class="fa fa-sort" aria-hidden="true"></i> </th>
                                    <th class="column-title">Pallet <i class="fa fa-sort" aria-hidden="true"></i> </th>
                                    <th class="column-title">Cliente <i class="fa fa-sort" aria-hidden="true"></i> </th>
                                    <th class="column-title">Proveedor <i class="fa fa-sort" aria-hidden="true"></i> </th>
                                    <th class="column-title">Locación <i class="fa fa-sort" aria-hidden="true"></i> </th>
                                    <th class="column-title">Categoria <i class="fa fa-sort" aria-hidden="true"></i> </th>
                                    <th></th>
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>                 
                                <?php
                                if (isset($datos) && !empty($datos)) { 
                                 foreach ($datos as $value) { 
                                    ?>
                           
                                    <tr class="odd pointer">
                                        <td class="a-center ">
                                            <?php if($value->existenciacliente == "Okey" && $value->existencialocacion == "Okey" && $value->existencategoria == "Okey" && $value->existennumeropartecliente == "Okey" &&  $value->subido == "0"){ ?>
                                            <div class="checkbox2">
                                                    <label>
                                                        <input type="checkbox" class="checkbox" name="table_records[]" value="<?php echo $value->iddocumento ?>">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok" style="color:green"></i></span>
                                                    </label>
                                                </div>
                                <?php } ?>
                                        </td>
                                        <td>
                                             <div class="checkbox2">
                                                    <label>
                                                        <input type="checkbox" class="checkboxdelete" name="table_records_delete[]" value="<?php echo $value->iddocumento ?>">
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok" style="color:red"></i></span>
                                                    </label>
                                                </div>
                                        </td>
                                        <td class="">
                                            <?php
                                                if($value->subido == "1"){
                                                    echo '<label><strong>'.$value->numeroparte.'</strong></label>';
                                                }else {
                                                    # code...
                                                    echo '<label><strong>'.$value->numeroparte.'</strong></label>';
                                                }
                                            ?>
                                        </td>
                                        <td ><?php echo $value->modelo   ?></td>
                                        <td class=" "><?= $value->revision ?></td>
                                        <td class=" "><?= $value->cantidadcajas ?></td>
                                        <td class=" "><?= $value->cantidadpallet ?></td>
                                        <td><?= $value->cliente ?></td>
                                        <td ><?= $value->proveedor ?></td>
                                        <td><?= $value->locacion ?></td>
                                        <td><?= $value->categoria ?></td>
                                        <td>
                                            <?php 
                                            if($value->subido == "1"){
                                                echo '<span class="label label-success">SUBIDO</span>';
                                            }else{
                                            if($value->existenciacliente!="Okey"){
                                                echo '<span class="label label-danger">'.$value->existenciacliente.'</span></br>'; 
                                            }
                                            if($value->existencialocacion!="Okey"){ 
                                                 echo '<span class="label label-danger">'.$value->existencialocacion.'</span></br>'; 
                                            }
                                            if($value->existencategoria!="Okey"){ 
                                                 echo '<span class="label label-danger">'.$value->existencategoria.'</span></br>'; 
                                            }
                                            if($value->existennumeroparte=="No existe el numero parte."){ 
                                                 echo '<span class="label label-warning">'.$value->existennumeroparte.'</span></br>'; 
                                            }else{
                                                 echo '<span class="label label-danger">'.$value->existennumeroparte.'</span></br>'; 
                                            }
                                             if($value->existennumeropartecliente!="Okey"){ 
                                                 echo '<span class="label label-danger">'.$value->existennumeropartecliente.'</span></br>'; 
                                            }
                                        }
                                            ?>
                                        </td>
                                        <td>
                                            <?php   if($value->subido == "0") { ?>
                                                <a href="javascript:;"
                                               data-id="<?= $value->iddocumento ?>"
                                               data-numeroparte="<?= $value->numeroparte ?>"
                                               data-modelo="<?= $value->modelo ?>"
                                               data-revision="<?= $value->revision ?>"
                                               data-cantidadcajas="<?= $value->cantidadcajas ?>"
                                               data-cantidadpallet="<?= $value->cantidadpallet ?>"
                                               data-cliente="<?= $value->cliente ?>"
                                               data-proveedor="<?= $value->proveedor ?>"
                                               data-locacion="<?= $value->locacion ?>"
                                               data-categoria="<?= $value->categoria ?>"
                                               data-toggle="modal" data-target="#edit-data">
                                                <button  data-toggle="modal" data-target="#ubah-data"  class="btn btn-primary btn-xs">Modificar</button>
                                            </a>
                                             <?php   }
                                            ?>
                                          
                                        </td>

                                    </tr> 
                                   
                                <?php } } ?>
                            </tbody>
                        </table>
                             </div>
                             <input type="hidden" name="ididentificador" value="<?php echo $ididentificador; ?>"/>
                             <button type="submit" id="subir" name="subir" class="btn btn-success btn-sm">Subir registro(s)</button>
                             <button type="submit" id="eliminar" name="eliminar" class="btn btn-danger btn-sm">Eliminar registro(s)</button>
                         </form>
                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        <h4 class="modal-title"><strong>Modificar</strong></h4>
                                    </div>
                                    <form class="form-horizontal" action="<?php echo base_url('catalogo/modificar') ?>" method="post" enctype="multipart/form-data" role="form">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Parte</label>
                                                <div class="col-lg-10">
                                                    <input type="hidden" id="id" name="id">
                                                    <input type="hidden" id="ididentificador" name="ididentificador" value="<?php echo $ididentificador; ?>" >
                                                    <input type="text" class="form-control" id="numeroparte" name="numeroparte" required="" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Modelo</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="modelo" name="modelo" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Revisión</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="revision" name="revision" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">C. Cajas</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="cantidadcajas" name="cantidadcajas" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">C. Pallet</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="cantidadpallet" name="cantidadpallet" required="">
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Cliente</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="cliente" name="cliente" required="">
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Proveedor</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="proveedor" name="proveedor" required="">
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Locación</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="locacion" name="locacion" required="">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Categoria</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="categoria" name="categoria" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit"> Modificar</button>
                                            <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    
</div>

</div> 

<script>
    $(document).ready(function() {
    $("#subir").click(function(event) {
        if( !confirm('Esta seguro de subir los registros?') ){
            event.preventDefault();
        } 

    });
     $("#eliminar").click(function(event) {
        if( !confirm('Esta seguro de eliminar los registros?') ){
            event.preventDefault();
        } 

    });
});
</script>
</div> 
	<script>
	    $(document).ready(function() {
	        // Untuk sunting
	        $('#edit-data').on('show.bs.modal', function (event) {
	            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
	            var modal          = $(this)
 
	            // Isi nilai pada field
	            modal.find('#id').attr("value",div.data('id'));
                    modal.find('#numeroparte').attr("value",div.data('numeroparte'));
	            modal.find('#modelo').attr("value",div.data('modelo'));
                    modal.find('#revision').attr("value",div.data('revision'));
                    modal.find('#cantidadcajas').attr("value",div.data('cantidadcajas'));
                    modal.find('#cantidadpallet').attr("value",div.data('cantidadpallet'));
                    modal.find('#cliente').attr("value",div.data('cliente'));
                    modal.find('#proveedor').attr("value",div.data('proveedor'));
                    modal.find('#locacion').attr("value",div.data('locacion'));
                    modal.find('#categoria').attr("value",div.data('categoria')); 
	        });
	    });
	</script>
<script>
    $(document).ready(function () {
        $(document).ready(function () {
            $('th').each(function (col) {
                $(this).hover(
                        function () {
                            $(this).addClass('focus');
                        },
                        function () {
                            $(this).removeClass('focus');
                        }
                );
                $(this).click(function () {
                    if ($(this).is('.asc')) {
                        $(this).removeClass('asc');
                        $(this).addClass('desc selected');
                        sortOrder = -1;
                    } else {
                        $(this).addClass('asc selected');
                        $(this).removeClass('desc');
                        sortOrder = 1;
                    }
                    $(this).siblings().removeClass('asc selected');
                    $(this).siblings().removeClass('desc selected');
                    var arrData = $('table').find('tbody >tr:has(td)').get();
                    arrData.sort(function (a, b) {
                        var val1 = $(a).children('td').eq(col).text().toUpperCase();
                        var val2 = $(b).children('td').eq(col).text().toUpperCase();
                        if ($.isNumeric(val1) && $.isNumeric(val2))
                            return sortOrder == 1 ? val1 - val2 : val2 - val1;
                        else
                            return (val1 < val2) ? -sortOrder : (val1 > val2) ? sortOrder : 0;
                    });
                    $.each(arrData, function (index, row) {
                        $('tbody').append(row);
                    });
                });
            });
        });
    });
</script>
<script>
var select_all = document.getElementById("select_all"); //select all checkbox
var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
	for (i = 0; i < checkboxes.length; i++) { 
		checkboxes[i].checked = select_all.checked;
	}
});


for (var i = 0; i < checkboxes.length; i++) {
	checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
		//uncheck "select all", if one of the listed checkbox item is unchecked
		if(this.checked == false){
			select_all.checked = false;
		}
		//check "select all" if all checkbox items are checked
		if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
			select_all.checked = true;
		}
	});
}
</script>

<script>
var select_all = document.getElementById("select_all_delete"); //select all checkbox
var checkboxes = document.getElementsByClassName("checkboxdelete"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
    for (i = 0; i < checkboxes.length; i++) { 
        checkboxes[i].checked = select_all.checked;
    }
});


for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){
            select_all.checked = false;
        }
        //check "select all" if all checkbox items are checked
        if(document.querySelectorAll('.checkboxdelete:checked').length == checkboxes.length){
            select_all.checked = true;
        }
    });
}
</script>
