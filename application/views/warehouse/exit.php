<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="row">  
                        <div class="col-md-11 col-sm-12 col-xs-12">
                            <h3>Reporte de Salidas</h3>
                        </div>
                        <div class="col-md-1 col-sm-12 col-xs-12">
                            <a href="<?php echo base_url('warehouse/index') ?>" class="btn btn-success"><i class="fa fa-home" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <form method="POST" action="<?= base_url('warehouse/exitWareHouse') ?>"> 
                        <label>Campos con <font color="red">*</font> son obligatorios.</label>
                        <div class="row"> 
                              <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>N° Salida</label>
                                    <input type="text" name="salida" class="form-control" placeholder="N° Salida" />
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>N° Parte</label>
                                    <input type="text" name="parte" class="form-control" placeholder="N° Parte" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> Fecha Inicial</label>
                                    <input type="date" name="fechainicio" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> Fecha Final</label>
                                    <input type="date" name="fechafin" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="tipo">Tipo</label>
                                    <select class="form-control" id="tipo" name="tipo" required>
                                        <option value="2" selected="">TODOS</option> 
                                        <option value="0">Pallet</option>
                                        <option value="1">Parciales</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="tipo">Categoria</label>
                                    <select class="form-control"  name="categoria">
                                        <option value="0" selected="">TODOS</option>
                                        <?php foreach ($categorias as $row) { ?>
                                        <option value="<?php echo $row->idcategoria; ?>" ><?php echo $row->nombrecategoria ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group"  >
                                    <button type="submit"  style="margin-top: 25px" class="btn btn-primary">BUSCAR</button>
                                </div>
                            </div>

                        </div> 
                    </form>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (!empty($exits)): ?>
                                    <?php echo $exits; ?>
                                <?php endif; ?>
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatableexit').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ],
            "order": [[0, "desc"]],
                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
        });
    });
</script>