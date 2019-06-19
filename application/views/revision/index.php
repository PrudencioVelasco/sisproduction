<!-- page content -->
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Módulo de Revisión</h3>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="app">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12" align="left">
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</button>

                                        <!-- Modal -->
                                        <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">


                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title"><strong>Agregar Revisión</strong></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form  id="register_form">
                                                            <center><div   class="loading2"></div></center>
                                                            <center>  <div style="color:green; font-weight: bolder;" class="message"></div></center>
                                                            <center> <div style="color:red; font-weight: bolder;" class="messageerror"></div></center>
                                                            <div class="form-group">
                                                                <label for="email">Revisión:</label>
                                                                <input type="text" class="form-control" id="revisionr">
                                                            </div>
                                                            <input type="hidden" id="idmodelo" value="<?php echo $idmodelo; ?>">
                                                            <button id="registrar" type="submit" class="btn btn-info">Guardar</button>
                                                        </form> 
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row"> 
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>

                                                    <th>Modelo</th> 
                                                    <th>Revisión</th>
                                                    <th></th> 
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                if (isset($datarevision) && !empty($datarevision)) {
                                                    foreach ($datarevision as $row) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row->descripcion ?></td>
                                                            <td><?php echo $row->descrevision ?></td>  
                                                            <td align='right'>
                                                                <button type="button" id="<?php echo $row->idrevision; ?>" class="btn btn-info btn-sm edit_data"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                                <a href="../cantidad/<?php echo $row->idrevision ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> 
                                                            </td> 
                                                        </tr>
                                                    <?php }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div id="dataModal" class="modal fade">  
                                    <div class="modal-dialog">  
                                        <div class="modal-content">  
                                            <div class="modal-header">  
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>  
                                                <h4 class="modal-title">Modificar Revisión</h4>  
                                            </div>  
                                            <div class="modal-body" id="employee_detail">  
                                            </div>  
                                            <div class="modal-footer">  
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                            </div>  
                                        </div>  
                                    </div>  
                                </div>  

                                <div id="add_data_Modal" class="modal fade">  
                                    <div class="modal-dialog">  
                                        <div class="modal-content">  
                                            <div class="modal-header">  
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>  
                                                <h4 class="modal-title">Modificar Revisión</h4>  
                                            </div>  
                                            <div class="modal-body">  
                                                <form method="post" id="modificar_form">  
                                                    <center><div   class="loading2"></div></center>
                                                    <center>  <div style="color:green; font-weight: bolder;" class="message"></div></center>
                                                    <center> <div style="color:red; font-weight: bolder;" class="messageerror"></div></center>

                                                    <div class="form-group">
                                                        <label>Modelo</label>  
                                                        <input type="text" name="revision" id="revision" class="form-control" />  
                                                    </div>
                                                    <input type="hidden" name="employee_id" id="employee_id" />  
                                                    <input type="submit"   id="modificar" value="Modificar" class="btn btn-success" />  
                                                </form>  
                                            </div>  
                                            <div class="modal-footer">  
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
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


</div>
<script>
    $(document).ready(function () {
$('#myModal').on('hidden.bs.modal', function () {
 location.reload();
});
$('#add_data_Modal').on('hidden.bs.modal', function () {
 location.reload();
});
        $(document).on('click', '.edit_data', function () {
            var employee_id = $(this).attr("id");
            $('#add_data_Modal').modal('show');
            $.ajax({
                url: "<?php echo site_url('revision/detalleRevision'); ?>",
                method: "POST",
                data: {employee_id: employee_id},
                dataType: "json",
                success: function (data) {
                    $('#revision').val(data.descripcion);
                    $('#employee_id').val(data.idrevision);
                    $('#add_data_Modal').modal('show');
                }
            });
        });


    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var loader = '<img src="<?php echo base_url(); ?>/assets/images/30.gif" />';

        //if submit button is clicked

        $('#modificar').click(function () {
            //show the loader
            $('.loading2').html(loader).fadeIn();

            $('.text').attr('disabled', 'true');

            //start the ajax
            $.ajax({
                //this is the php file that processes the data and send mail
                url: "<?php echo site_url('revision/modificar'); ?>",
                //POST method is used
                type: "POST",
                //pass the data        
                data: $('#modificar_form').serialize(),
                //success
                success: function (html) {
                    //if process.php returned 1/true (send mail success)
                    console.log(html);
                    if (html == 1) {
                        location.reload();
                        //hide the form
                        //$('#register_form').fadeOut('slow');

                        //hide the loader 
                        //show the success message
                        $('.message').html('Exito! ').fadeIn('slow');

                        //if process.php returned 0/false
                    } else {
                        $('.messageerror').html('Ya esta registrado! ').fadeIn('slow');
                    }
                }
            });

            //cancel the submit button default behaviours
            return false;
        });
    });


</script>

<script type="text/javascript">
    $(document).ready(function () {
        var loader = '<img src="<?php echo base_url(); ?>/assets/images/30.gif" />';

        //if submit button is clicked

        $('#registrar').click(function () {
            //show the loader
            $('.loading2').html(loader).fadeIn();
            var revision = $('#revisionr').val();
            var idmodelo = $('#idmodelo').val();
            //organize the data properly
            var form_data =
                    'revision=' + revision +
                    '&idmodelo=' + idmodelo;
            //disabled all the text fields
            $('.text').attr('disabled', 'true');

            //start the ajax
            $.ajax({
                //this is the php file that processes the data and send mail
                url: "<?php echo site_url('revision/registrar'); ?>",
                //POST method is used
                type: "POST",
                //pass the data        
                data: form_data,
                //success
                success: function (html) {
                    //if process.php returned 1/true (send mail success)
                    console.log(html);
                    if (html == 1) {
                        location.reload();
                        //hide the form
                        //$('#register_form').fadeOut('slow');

                        //hide the loader 
                        //show the success message
                        $('.message').html('Exito! ').fadeIn('slow');

                        //if process.php returned 0/false
                    } else {
                        $('.messageerror').html('Ya esta registrado! ').fadeIn('slow');
                    }
                }
            });

            //cancel the submit button default behaviours
            return false;
        });
    });


</script>
<!-- /page content --> 
