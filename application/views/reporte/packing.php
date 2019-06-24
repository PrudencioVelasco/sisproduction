<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Reporte de Transferencias</h3>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <form method="POST" action="<?= base_url('reporte/buscar') ?>"> 
                        <div class="row">  

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> De</label>
                                    <input type="date" name="fechainicio" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> a</label>
                                    <input type="date" name="fechafin" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label><font color="red">*</font> Modulo</label>
                                    <select class="form-control" required> 
                                        <option value="">Seleccionar</option>
                                        <option value="1">PACKING</option>
                                        <option value="2">CALIDAD</option>
                                        <option value="3">ALMACEN</option>
                                    </select>
                                </div>
                            </div>
 <div class="col-md-3 col-sm-12 col-xs-12">
     <div class="form-group"  >
         <button type="submit"  style="margin-top: 25px" class="btn btn-primary">Buscar</button>
                                </div>
                            </div>
                        </div> 
                    </form>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12"> 
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Transferencia</th>
                                            <th>N. Parte</th>
                                            <th>Modelo</th>
                                            <th>Revision</th>
                                            <th>Pallet</th>
                                            <th>C. por pallet</th>
                                            <th>Cantidad</th>
                                            <th>Linea</th>
                                            <th>Fecha</th> 
                                            <th>Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>  
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td> 
                                                <td></td> 
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                 
                                            </tr> 
                                    </tbody>
                                </table> 
 
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




