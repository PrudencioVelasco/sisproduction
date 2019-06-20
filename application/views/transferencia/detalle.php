



<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-6" align="left">
                                <h2><strong>Agregar Número de Parte</strong></h2>
                            </div>
                            <div class="col-md-6" style="display: flex; justify-content: flex-end">
                                <h2><strong>Transferencia: # <?php echo $id; ?></strong></h2>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

                                        <div class="modal fade bd-example-modal-lg"   role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header"> 
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        Modal body..
                                                        <form>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Número de Parte</label>
                                                                        <input type="text" class="form-control"  id="numeroparte" autcomplete="off"> 
                                                                    </div> 
                                                                </div> 

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Seleccionar cliente</label> 
                                                                        <select  class="select2_single_cliente form-control ">
                                                                            <option value="AK">Alaska</option>
                                                                           
                                                                        </select>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Seleccionar Modelo</label> 
                                                                        <select class="select2_single_modelo form-control ">
                                                                            <option value="AK">Alaska</option>
                                                                           
                                                                        </select>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Seleccionar Revisión</label> 
                                                                        <select class="select2_single_revision form-control ">
                                                                            <option value="AK">Alaska</option>
                                                                       
                                                                        </select>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Seleccionar Linea</label> 
                                                                        <select class="select2_linea form-control ">
                                                                            <?php foreach ($datalinea as $row) { ?>
                                                                                <option value="<?php echo $row->idlinea ?>"><?php echo $row->nombrelinea ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Seleccionar Cajas por Pallet</label> 
                                                                        <select class="select2_single_cantidad form-control ">
                                                                            <option value="AK">Alaska</option>

                                                                        </select>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label><font color="red">*</font> Cantidad de Pallet</label> 
                                                                        <input type="text" class="form-control"  autcomplete="off">
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Cliente</th>
                                                <th scope="col">No. P.</th>
                                                <th scope="col">P.</th>
                                                <th scope="col">Cajas</th> 

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /page content -->
