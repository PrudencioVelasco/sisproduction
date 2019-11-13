<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Subir Inventario</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content"> 
                         <form   method="POST" action="<?php echo base_url('Catalogo/operacion'); ?>">
                        <table class="table table-striped responsive-utilities jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th>
                                        <input type="checkbox" id="check-all" class="flat">
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
                                    <th class="bulk-actions" colspan="9">
                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>                 
                                <?php foreach ($datos as $value) { ?>
                           
                                    <tr class="odd pointer">
                                        <td class="a-center ">
                                            <?php //if($value->existenciacliente == "Okey" && $value->existencialocacion == "Okey" && $value->existencategoria == "Okey"){ ?>
                                            <input type="checkbox" class="flat" name="table_records[]" value="<?php echo $value->iddocumento ?>">
                                <?php //} ?>
                                        </td>
                                        <td class=" "><?= $value->numeroparte ?></td>
                                        <td  class="col-md-1"><?php //echo $value->modelo   ?></td>
                                        <td class=" "><?= $value->revision ?></td>
                                        <td class=" "><?= $value->cantidadcajas ?></td>
                                        <td class=" "><?= $value->cantidadpallet ?></td>
                                        <td><?= $value->cliente ?></td>
                                        <td ><?= $value->proveedor ?></td>
                                        <td><?= $value->locacion ?></td>
                                        <td><?= $value->categoria ?></td>
                                        <td>
                                            <?php 
                                            if($value->existenciacliente!="Okey"){
                                                echo '<span class="label label-danger">'.$value->existenciacliente.'</span></br>'; 
                                            }
                                            if($value->existencialocacion!="Okey"){ 
                                                 echo '<span class="label label-danger">'.$value->existencialocacion.'</span></br>'; 
                                            }
                                            if($value->existencategoria!="Okey"){ 
                                                 echo '<span class="label label-danger">'.$value->existencategoria.'</span></br>'; 
                                            }
                                            if($value->existennumeroparte!="Okey"){ 
                                                 echo '<span class="label label-warning">'.$value->existennumeroparte.'</span></br>'; 
                                            }
                                            ?>
                                        </td>
                                        <td>

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
                                        </td>

                                    </tr> 
                                   
                                <?php } ?>
                            </tbody>
                        </table>
                            
                             <input type="hidden" name="ididentificador" value="<?php echo $ididentificador; ?>"/>
                              <button type="submit" name="subir" class="btn btn-success btn-sm">Subir registro(s)</button>
                               <button type="submit" name="eliminar" class="btn btn-danger btn-sm">Eliminar registro(s)</button>
                         </form>
                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        <h4 class="modal-title"><strong>Modificar</strong></h4>
                                    </div>
                                    <form class="form-horizontal" action="<?php echo base_url('admin/ubah') ?>" method="post" enctype="multipart/form-data" role="form">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Parte</label>
                                                <div class="col-lg-10">
                                                    <input type="hidden" id="id" name="id">
                                                    <input type="text" class="form-control" id="numeroparte" name="numeroparte" placeholder="Tuliskan Nama">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Modelo</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Tuliskan Nama">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Revisión</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="revision" name="revision" placeholder="Tuliskan Nama">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">C. Cajas</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="cantidadcajas" name="cantidadcajas" placeholder="Tuliskan Nama">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">C. Pallet</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="cantidadpallet" name="cantidadpallet" placeholder="Tuliskan Nama">
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Cliente</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Tuliskan Nama">
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Proveedor</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="proveedor" name="proveedor" placeholder="Tuliskan Nama">
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Locación</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="locacion" name="locacion" placeholder="Tuliskan Nama">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Categoria</label>
                                                <div class="col-lg-10"> 
                                                    <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Tuliskan Nama">
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
